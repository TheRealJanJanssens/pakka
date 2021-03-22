<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Session;
use Spatie\Sitemap\SitemapGenerator;

use Storage;
use TheRealJanJanssens\Pakka\Models\AttributeInput;
use TheRealJanJanssens\Pakka\Models\AttributeOption;
use TheRealJanJanssens\Pakka\Models\AttributeValue;
use TheRealJanJanssens\Pakka\Models\Component;
use TheRealJanJanssens\Pakka\Models\Images;
use TheRealJanJanssens\Pakka\Models\Item;
use TheRealJanJanssens\Pakka\Models\Menu;
use TheRealJanJanssens\Pakka\Models\MenuItem;
use TheRealJanJanssens\Pakka\Models\Page;
use TheRealJanJanssens\Pakka\Models\Section;
use TheRealJanJanssens\Pakka\Models\SectionItem;
use TheRealJanJanssens\Pakka\Models\Template;
use TheRealJanJanssens\Pakka\Models\Translation;

class ContentController extends Controller
{
    public function __construct()
    {
        Cache::tags('content')->flush(); //uncomment this
        $this->middleware('auth');
        constructGlobVars();

        //genereert teveel en verkeerde links
        //SitemapGenerator::create(getBaseUrl())->getSitemap()->writeToDisk('public', 'sitemap.xml');
    }
    
    public function index()
    {
        $pages = Page::getPages();
        
        $iP = 0;
        foreach ($pages as $page) {
            $sections = Section::where('page_id', $page->id)->orderBy('position', 'asc')->get();
            $pages[$iP]['sections'] = $sections;
  
            $iS = 0;
            foreach ($sections as $section) {
                $components = Component::where('section_id', $section->id)->orderBy('position', 'asc')->get();
                $pages[$iP]["sections"][$iS]['components'] = $components;
                $iS++;
            }
            
            $iP++;
        }
        
        return view('pakka::admin.content.index', compact('pages'));
    }
    
    public function createPage()
    {
        $templates = getBladeList("templates");
        $sections = getBladeList("sections");
        $jsonTemplates = Template::getSelect();

        return view('pakka::admin.content.createpage', compact('templates', 'sections', 'jsonTemplates'));
    }
    
    public function storePage(Request $request)
    {
        $post = $request->all();
        $result = slugControl($request->all());
        $result = constructTranslations($result);
        
        //Safety so it always sets a zero when empty
        if ($result['status'] == null) {
            $result['status'] = 0;
        }

        $page = Page::create($result);
        $langs = Session::get('lang');

        if (isset($post['json'])) {
            $json = file_get_contents(storage_path() . "/app/public/templates/".$post['json']);
            constructPageStructure($json, $page->id);
        }
        
        if ($result['status'] !== 0) {
            //Automaticly generates a menu item for this new page
            $menu = DB::table('menus')->where('id', '!=', 1)->first();
            
            //generates menu if there is none
            if (! $menu) {
                $insert = ['name' => 'Navigatie'];
                $menu = Menu::create($insert);
            }
            
            //takes last position value
            $lastMenuItem = DB::table('menu_items')->where('menu', $menu->id)->orderBy('position', 'desc')->first();
            
            if (! empty($lastMenuItem)) {
                $position = intval($lastMenuItem->position) + 1;
            } else {
                $position = 1;
            }
            
            $insert = [
                "menu" => $menu->id,
                "position" => $position,
                "name" => $page->name,
                "link" => $page->slug,
                "permission" => 0,
            ];
            
            $menuItem = MenuItem::create($insert);
            
            //resets menu
            Session::forget('menus');
            Session::forget('pages_select');
        }
        
        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_update'));
    }
    
    public function editPage($id)
    {
        $page = Page::getPage($id, 2);
        $templates = getBladeList("templates");
        $sections = getBladeList("sections");
        
        return view('pakka::admin.content.editpage', compact('page', 'templates', 'sections'));
    }
    
    public function updatePage(Request $request, $id)
    {
        $item = Page::findOrFail($id);
        
        $post = $request->all();
        $result = slugControl($request->all());
        $result = constructTranslations($result);
        
        if (isset($post['json'])) {
            constructPageStructure($post['json'], $id);
        }

        $item->update($result);
        
        //resets menu
        Session::forget('menus');
        Session::forget('pages_select');
        
        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_update'));
    }
    
    public function createSection($page)
    {
        $sections = getBladeList("sections", true);
        
        return view('pakka::admin.content.createsection', compact('page', 'sections'));
    }
    
    public function storeSection(Request $request)
    {
        Section::create(array_merge($request->all() + ['type' => '2'])); //sets type to 2 f manually added

        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_update'));
    }
    
    public function editSection($id, $page)
    {
        //$section = Section::getSection($id,2);
        $section = Section::findOrFail($id);
        //$sections = getBladeList("sections");
        $sectionItems = SectionItem::orderBy('section')->get();
        
        foreach ($sectionItems as $sectionItem) {
            $sections[$sectionItem['id']] = $sectionItem['section'];
        }
        
        return view('pakka::admin.content.editsection', compact('page', 'section', 'sections'));
    }
    
    public function updateSection(Request $request, $id)
    {
        $item = Section::findOrFail($id);
        $item->update($request->all());

        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_update'));
    }
    
    public function insertSection(Request $request)
    {
        //This method is used to add sections in the live section editor
        
        $post = $request->all();
        $langs = Session::get('lang');
        $sectionTemplate = SectionItem::findOrFail($post['id']);
        
        $assets = getCompMeta($sectionTemplate['section'], 'assets');
                
        $section = Section::create([
            'page_id' => $post['page'],
            'type' => $post['type'],
            'name' => $post['name'],
            'section' => $post['id'],
            'classes' => $assets['classes'],
            'attributes' => $assets['attributes'],
            'extras' => $assets['extras'],
        ]);
     
        $components = getCompMeta($sectionTemplate['section'], 'component');
        $iC = 1;
        if ($components) {
            foreach ($components as $component) {
                $compResult = Component::create([
                    'id' => generateString(8),
                    'page_id' => $post['page'],
                    'section_id' => $section->id,
                    'position' => $iC,
                    'slug' => $component['slug'],
                    'name' => $component['name'],
                ]);
                
                $iI = 1;
                foreach ($component['inputs'] as $input) {
                    $types = ["select","checkbox","radio"]; //illegal inputs
                    
                    if (contains($input['type'], $types) && isset($input['options'])) {
                        //inputs with options
                    } else {
                        $inputInsert = AttributeInput::create([
                            'input_id' => generateString(8),
                            'set_id' => $compResult->id,
                            'position' => $iI,
                            'label' => $input['label'],
                            'name' => $input['name'],
                            'type' => $input['type'],
                        ]);

                        foreach ($langs as $lang) {
                            if (isset($input['default']) && ! empty($input['default'])) {
                                $inputValue = AttributeValue::create([
                                    'input_id' => $inputInsert->input_id,
                                    'item_id' => $compResult->id,
                                    'language_code' => $lang["language_code"],
                                    'value' => $input['default'],
                                ]);
                            }
                        }
                    }
                    $iI++;
                }
                
                $iC++;
            }
        }
        
        //before sorting the sections the new ID has to be set
        $i = 0;
        $list = json_decode($post['list'], true);
        foreach ($list as $item) {
            if ($item[0]['id'] == 0) {
                $list[$i][0]['id'] = $section->id;

                break;
            }
            $i++;
        }

        $this->processOrderSections($list);
        
        return $section->id; //so js knows which section to reload
    }
    
    public function updateSectionAttributes(Request $request, $id)
    {
        $data = json_decode($_POST['data'], true);
        $result['classes'] = [];
        $result['attributes'] = [];
        $result['extras'] = [];
        
        foreach ($data as $attr) {
            //maje sure the value isset
            if (isset($attr['value'])) {
                $type = $attr['type'];
                $element = $attr['element'];
                $value = $attr['value'];
                
                switch ($attr['type']) {
                    case "class":
                        $key = "classes";

                        break;
                    case "attribute":
                        $key = "attributes";

                        break;
                    case "extra":
                        $key = "extras";

                        break;
                }
                
                if (isset($result[$key][$element])) {
                    $result[$key][$element] = $result[$key][$element].' '.$attr['value'];
                } else {
                    $result[$key][$element] = $attr['value'];
                }
            }
        }
        
        $result['classes'] = serialize($result['classes']);
        $result['attributes'] = serialize($result['attributes']);
        $result['extras'] = serialize($result['extras']);

        $item = Section::findOrFail($id);
        
        $item->update($result);
    }
    
    public function processOrderSections($items)
    {
        foreach ($items as $item) {
            if (isset($item[0]['id'])) {
                Section::find($item[0]['id'])->update(['position' => $item[0]['position']]);
            }
        }
    }

    public function orderSections(Request $request)
    {
        if ($request->isMethod('post')) {
            $items = $request->all();
            $this->processOrderSections(json_decode($items['data'], true));

            Session::forget('menus');
        }
    }
    
    /*
        public function switchSections($switch,$id){
            $section = Section::find($id)->decrement('position', 1);
            //get position from item above or below and change it
        }
    */
    
    public function statusSection(Request $request)
    {
        if ($request->isMethod('post')) {
            $item = $request->all();
            $item = json_decode($item['data'], true);
            Section::find($item['id'])->update(['status' => $item['status']]);
        }
    }
      
    public function createComponent($page, $section)
    {
        /*
                $pages = Page::getPages(2);
                $sections = Section::getSections(2);
        */
        
        return view('pakka::admin.content.createcomponent', compact('page', 'section'));
    }
    
    public function storeComponent(Request $request)
    {
        Component::create(array_merge($request->all() + ['id' => generateString(8)]));

        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_update'));
    }
    
    public function editComponent($id, $page, $section)
    {
        $component = Component::findOrFail($id);
        /*
                $pages = Page::getPages(2);
                $sections = Section::getSections(2);
        */
        
        return view('pakka::admin.content.editcomponent', compact('component', 'page', 'section'));
    }
    
    public function updateComponent(Request $request, $id)
    {
        $item = Component::findOrFail($id);
        
        $item->update($request->all());

        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_update'));
    }
    
    public function destroyPage($id)
    {
        $page = Page::findOrFail($id);
        
        Page::where('id', $id)->delete();
        Section::where('page_id', $id)->delete();
        
        $components = Component::where('page_id', $id)->get();
        foreach ($components as $component) {
            $inputs = AttributeInput::where('set_id', $component['id'])->get();
            foreach ($inputs as $input) {
                AttributeOption::where('input_id', $input['input_id'])->delete();
                AttributeValue::where('input_id', $input['input_id'])->delete();
            }
            AttributeInput::where('set_id', $component['id'])->delete();
            Images::where('item_id', $component['id'])->delete();
        }
        
        Component::where('page_id', $id)->delete();
        
        Translation::where('translation_id', $page['slug'])->delete();
        Translation::where('translation_id', $page['name'])->delete();
        
        //resets menu
        Session::forget('menus');
        Session::forget('pages_select');
        
        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_store'));
    }
    
    public function destroySection(Request $request, $id)
    {
        $section = Section::findOrFail($id);
       
        Section::where('id', $id)->delete();
        
        $components = Component::where('section_id', $id)->get();
        foreach ($components as $component) {
            $inputs = AttributeInput::where('set_id', $component['id'])->get();
            foreach ($inputs as $input) {
                AttributeOption::where('input_id', $input['input_id'])->delete();
                AttributeValue::where('input_id', $input['input_id'])->delete();
            }
            AttributeInput::where('set_id', $component['id'])->delete();
            Images::where('item_id', $component['id'])->delete();
        }
        
        Component::where('section_id', $id)->delete();
        
        if (! $request->ajax()) {
            //prevents the 405 error when calling this function in a ajax call
            return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_store'));
        }
    }
    
    public function destroyComponent($id)
    {
        $components = Component::where('id', $id)->get();
        foreach ($components as $component) {
            $inputs = AttributeInput::where('set_id', $component['id'])->get();
            foreach ($inputs as $input) {
                AttributeOption::where('input_id', $input['input_id'])->delete();
                AttributeValue::where('input_id', $input['input_id'])->delete();
            }
            AttributeInput::where('set_id', $component['id'])->delete();
            Images::where('item_id', $component['id'])->delete();
        }
        
        Component::where('id', $id)->delete();
        
        Translation::where('translation_id', $page['slug'])->delete();
        Translation::where('translation_id', $page['name'])->delete();
        
        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_store'));
    }
    
    public function editContent($id)
    {
        Session::put('set_id', $id);
        
        $inputs = AttributeInput::getInputs();
        
        Session::put('new_item_id', '');
        Session::put('current_item_id', $id);
        Session::forget('uploadImages');
        
        $item = Component::getContent($id, 2);
        
        return view('pakka::admin.content.editcontent', compact('item', 'inputs'));
    }
    
    public function updateContent(Request $request, $id)
    {
        $result = constructTranslations($request->all()); //Attributes Translations

        return redirect()->route(config('pakka.prefix.admin'). '.content.index')->withSuccess(trans('app.success_store'));
    }
    
    public function updateFields(Request $request)
    {
        //The call that is made out the live editor when fields are edited
        $data = json_decode($_POST['data'], true);

        //$query = "";
        foreach ($data as $item) {
            if (isset($item['module'])) {
                //Detects when the item has a module id. This means the element that needs editing is a item element
                //get the input detail in case the item is new and needs to be inserted
                $input = AttributeInput::where("name", $item['key'])->where('set_id', $item['module'])->get()->toArray();
            } else {
                //get the input detail in case the item is new and needs to be inserted
                $input = AttributeInput::where("name", $item['key'])->where('set_id', $item['id'])->get()->toArray();
            }
             
            AttributeValue::updateOrCreate(['input_id' => $input[0]['input_id'], 'item_id' => $item['id'], 'language_code' => $item['locale']], ['value' => htmlspecialchars($item['value'])]);
        }
    }
    
    public function updateImages(Request $request, $id)
    {
        //Handles the storage of images in live editor
    }
    
    public function loadSectionList($type)
    {
        $sections = SectionItem::getSectionItemsByType($type);
        
        $tags = [];
        foreach ($sections as $section) {
            $sectionTags = explode(',', $section['tags']);
            $tags = array_merge($tags, $sectionTags);
        }
        
        $tags = array_unique($tags);
        
        return view('pakka::admin.content.sectionlist', compact('sections', 'tags'));
    }

    public function generateTemplate($id)
    {
        $page = Page::getPage($id, 1);
        $template = Page::generateTemplate($id);

        $fileName = 'template_'.time().'.json';
        Storage::disk('public')->put('templates/'.$fileName, $template);
        Template::create(['name' => $page->name.' template', 'file' => $fileName]);

        //Download
        //Storage::disk('public')->download('templates/'.$fileName);

        return redirect('/admin/templates');
    }
}
