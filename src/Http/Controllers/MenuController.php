<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
//querybuilder used in sort
use Cache;
use Illuminate\Http\Request;
use Session;
use TheRealJanJanssens\Pakka\Models\Menu;
use TheRealJanJanssens\Pakka\Models\MenuItem;

use TheRealJanJanssens\Pakka\Models\Page;
use TheRealJanJanssens\Pakka\Models\Translation;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Session::get('menus');
        if (! checkAcces("permission_edit_app_menu")) {
            unset($menus[1]);
        }

        return view('pakka::admin.menu.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createMenu()
    {
        if (checkAcces("permission_add_menus")) {
            return view('pakka::admin.menu.createmenu');
        } else {
            return back();
        }
    }

    public function createMenuItem()
    {
        if (checkAcces("permission_edit_app_menu")) {
            $menuResults = Menu::get();
        } else {
            $menuResults = Menu::get()->where('id', '!=', 1);
        }


        foreach ($menuResults as $menu) {
            $menus[$menu['id']] = $menu['name'];
        }

        $pages = Page::getPagesLinks();

        return view('pakka::admin.menu.createmenuitem', compact('menus', 'pages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Menu::rules());

        Menu::create($request->all());
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_store'));
    }

    public function storeMenu(Request $request)
    {
        $this->validate($request, Menu::rules());

        Menu::create($request->all());
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_store'));
    }

    public function storeMenuItem(Request $request)
    {
        $this->validate($request, MenuItem::rules());

        //converts lang inputs
        $result = constructTranslations($request->all());

        $result['position'] = 10;
        if (! $result['permission']) {
            $result['permission'] = 0;
        }

        $menu = MenuItem::create($result);
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Menu::findOrFail($id);

        return view('pakka::admin.menu.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editMenu($id)
    {
        $item = Menu::findOrFail($id);
        $items = Menu::latest('updated_at')->get();

        if (checkAcces("permission_add_menus")) {
            return view('pakka::admin.menu.editmenu', compact('item', 'items'));
        } else {
            return back();
        }
    }

    public function editMenuItem($id)
    {
        $menuResults = Menu::get();

        foreach ($menuResults as $menu) {
            $menus[$menu['id']] = $menu['name'];
        }

        $pages = Page::getPagesLinks();

        $menuItem = MenuItem::getMenuItem($id);

        return view('pakka::admin.menu.editmenuitem', compact('menus', 'menuItem', 'pages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateMenu(Request $request, $id)
    {
        $this->validate($request, Menu::rules(true, $id));

        $item = Menu::findOrFail($id);

        $item->update($request->all());
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return redirect()->route(config('pakka.prefix.admin').'.menu.index')->withSuccess(trans('pakka::app.success_update'));
    }

    public function updateMenuItem(Request $request, $id)
    {
        $this->validate($request, MenuItem::rules(true, $id));

        $item = MenuItem::findOrFail($id);

        //converts lang inputs
        $result = constructTranslations($request->all());

        $item->update($result);
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return redirect()->route(config('pakka.prefix.admin').'.menu.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMenu($id)
    {
        Menu::destroy($id);

        $items = MenuItem::where('menu', $id)->get()->toArray();

        foreach ($items as $item) {
            $transId = $item['name'];
            Translation::where('translation_id', $transId)->delete();
            MenuItem::where('menu', $id)->delete();
        }
        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }

    public function destroyMenuItem($id)
    {
        $item = MenuItem::findOrFail($id)->toArray();
        $transId = $item['name'];

        MenuItem::destroy($id);

        //only deletes the admin menu translations
        if ($item['menu'] == 1) {
            Translation::where('translation_id', $transId)->delete(); //ALSO deletes page name translation
        }

        Session::forget('menus');
        Cache::tags('translations')->flush();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }

    public function sortMenu(Request $request)
    {
        if ($request->isMethod('post')) {
            $items = $request->all();
            $items = json_decode($items['data'], true);

            $query = "";
            foreach ($items as $item) {
                if (empty($item[0]['parent'])) {
                    $item[0]['parent'] = 'NULL';
                }

                MenuItem::find($item[0]['id'])->update(['position' => $item[0]['position'], 'parent' => $item[0]['parent'], 'menu' => $item[0]['menu']]);
            }

            Session::forget('menus');
        }
    }
}
