<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Cache;
use Illuminate\Http\Request;
use Session;
use TheRealJanJanssens\Pakka\Models\AttributeInput;
use TheRealJanJanssens\Pakka\Models\AttributeValue;
use TheRealJanJanssens\Pakka\Models\Collection;
use TheRealJanJanssens\Pakka\Models\Images;
use TheRealJanJanssens\Pakka\Models\Product;
use TheRealJanJanssens\Pakka\Models\Setting;
use TheRealJanJanssens\Pakka\Models\Stock;
use TheRealJanJanssens\Pakka\Models\Translation;
use TheRealJanJanssens\Pakka\Models\Variant;
use TheRealJanJanssens\Pakka\Models\VariantOption;
use TheRealJanJanssens\Pakka\Models\VariantValue;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        constructGlobVars();
    }

    public function index()
    {
        $products = Product::getProducts();

        return view('pakka::admin.products.index', compact('products'));
    }

    public function show($id)
    {
        $item = Product::findOrFail($id);

        return view('pakka::admin.products.show', compact('item'));
    }

    public function create()
    {
        $inputs = AttributeInput::getInputs();
        $collections = Collection::getCollectionsSelect();
        $newItemId = generateString(10);
        Session::put('new_item_id', $newItemId);
        Session::put('current_item_id', $newItemId);
        Session::forget('uploadImages');

        return view('pakka::admin.products.create', compact('inputs', 'collections'));
    }

    public function store(Request $request)
    {
        $productId = Session::get('current_item_id');
        $request->request->add(['id' => $productId]);
        $inputs = $request->all();
        $result = slugControl($inputs); //Fills in empty slugs
        $result = constructTranslations($result);
        constructVariants($productId, $result);

        $result["id"] = $productId;
        $result["created_by"] = auth()->user()->id;
        $result["updated_by"] = auth()->user()->id;

        //Safety so it always sets a zero when empty
        if ($result['status'] == null) {
            $result['status'] = 0;
        }

        Product::create($result);

        //sync collections
        $item = Product::find($productId);
        $item->collections()->sync($request->get('collections'));

        Cache::tags('collections')->flush();

        return redirect()->route(config('pakka.prefix.admin'). '.products.index')->withSuccess(trans('pakka::app.success_store'));
    }

    public function edit($id)
    {
        $inputs = AttributeInput::getInputs();

        Session::put('new_item_id', '');
        Session::put('current_item_id', $id);
        Session::forget('uploadImages');

        $product = Product::getProduct($id, 2);
        $collections = Collection::getCollectionsSelect();

        Cache::tags('collections')->flush();

        return view('pakka::admin.products.edit', compact('product', 'inputs', 'collections'));
    }

    public function update(Request $request, $id)
    {
        $request->request->add(['id' => $id]);
        $result = slugControl($request->all()); //Fills in empty slugs
        $result = constructTranslations($result);
        constructVariants($id, $result);

        $item = Product::findOrFail($id);

        $item->update($request->all());

        Cache::tags('collections')->flush();

        return redirect()->route(config('pakka.prefix.admin'). '.products.index')->withSuccess(trans('pakka::app.success_store'));
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        Product::where('id', $id)->delete();
        Images::where('item_id', $id)->delete();
        AttributeValue::where('item_id', $id)->delete();
        Translation::where('translation_id', $product['slug'])->delete();
        Variant::where('product_id', $id)->delete();
        VariantOption::where('product_id', $id)->delete();
        VariantValue::where('product_id', $id)->delete();
        Stock::where('product_id', $id)->delete();

        Cache::tags('collections')->flush();

        return redirect()->route(config('pakka.prefix.admin'). '.products.index')->withSuccess(trans('pakka::app.success_store'));
    }

    public function layoutSwitch($id)
    {
        Setting::updateOrCreate(['user_id' => auth()->user()->id, 'name' => 'item_layout'], ['value' => $id]);
        Session::forget('settings');

        return redirect()->route(config('pakka.prefix.admin'). '.products.index')->withSuccess(trans('pakka::app.success_store'));
    }
}
