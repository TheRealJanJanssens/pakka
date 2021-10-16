<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use TheRealJanJanssens\Pakka\Models\AttributeInput;
use TheRealJanJanssens\Pakka\Models\AttributeValue;
use TheRealJanJanssens\Pakka\Models\Images;
use TheRealJanJanssens\Pakka\Models\Item;
use TheRealJanJanssens\Pakka\Models\Setting;
use TheRealJanJanssens\Pakka\Models\Translation;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
    }

    public function setModule($moduleId)
    {
        Session::put('set_id', $moduleId);
    }

    public function index($moduleId)
    {
        $this->setModule($moduleId);

        $items = Item::getItems($moduleId);

        //dd($items);

        return view('pakka::admin.items.index', compact('items'));
    }

    public function show($moduleId, $id)
    {
        $this->setModule($moduleId);

        $item = Item::findOrFail($id);

        return view('pakka::admin.items.show', compact('item'));
    }

    public function createItem($moduleId)
    {
        $this->setModule($moduleId);

        $inputs = AttributeInput::getInputs();
        $newItemId = generateString(10);
        Session::put('new_item_id', $newItemId);
        Session::put('current_item_id', $newItemId);
        Session::forget('uploadImages');

        return view('pakka::admin.items.createitem', compact('inputs'));
    }

    public function storeItem(Request $request)
    {
        $request->request->add(['id' => Session::get('current_item_id')]);
        $result = slugControl($request->all()); //Fills in empty slugs
        $result = constructTranslations($result);

        $result["module_id"] = Session::get('set_id');
        $result["created_by"] = auth()->user()->id;

        //Safety so it always sets a zero when empty
        if ($result['status'] == null) {
            $result['status'] = 0;
        }

        Item::create($result);

        return redirect()->route(config('pakka.prefix.admin'). '.items.index', Session::get('set_id'))->withSuccess(trans('pakka::app.success_store'));
    }

    public function editItem($moduleId, $id)
    {
        $this->setModule($moduleId);

        $inputs = AttributeInput::getInputs();

        Session::put('new_item_id', '');
        Session::put('current_item_id', $id);
        Session::forget('uploadImages');

        $item = Item::getItem($id, 2);

        return view('pakka::admin.items.edititem', compact('item', 'inputs'));
    }

    public function updateItem(Request $request, $id)
    {
        $request->request->add(['id' => $id]);
        $result = slugControl($request->all()); //Fills in empty slugs
        $result = constructTranslations($result);

        $item = Item::findOrFail($id);

        $item->update($request->all());

        return redirect()->route(config('pakka.prefix.admin'). '.items.index', Session::get('set_id'))->withSuccess(trans('pakka::app.success_store'));
    }

    public function destroyItem($id)
    {
        $item = Item::findOrFail($id);

        Item::where('id', $id)->delete();
        Images::where('item_id', $id)->delete();
        AttributeValue::where('item_id', $id)->delete();
        Translation::where('translation_id', $item['slug'])->delete();

        return redirect()->route(config('pakka.prefix.admin'). '.items.index', Session::get('set_id'))->withSuccess(trans('pakka::app.success_store'));
    }

    public function layoutSwitch($id)
    {
        Setting::updateOrCreate(['user_id' => auth()->user()->id, 'name' => 'item_layout'], ['value' => $id]);
        Session::forget('settings');

        return redirect()->route(config('pakka.prefix.admin'). '.items.index', Session::get('set_id'))->withSuccess(trans('pakka::app.success_store'));
    }
}
