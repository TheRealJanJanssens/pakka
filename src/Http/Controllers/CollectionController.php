<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

//use App\Http\Controllers\Controller;
use Cache;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\Collection;
use TheRealJanJanssens\Pakka\Models\CollectionCondition;

use TheRealJanJanssens\Pakka\Models\CollectionSet;

use TheRealJanJanssens\Pakka\Models\Translation;

class CollectionController extends Controller
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
        $collections = Collection::getCollections();

        return view('pakka::admin.collections.index', compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.collections.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($result, Collection::rules());
        $array = $request->all();
        $result = constructTranslations($request->all());
        $collection = Collection::create($result);
        if (isset($result['string']) && is_array($result['string'])) {
            //dd($result);
            for ($i = 0; $i < count($result['string']); $i++) {
                $conditions[$i] = ["input" => $result['input'][$i], "operator" => $result['operator'][$i], "string" => $result['string'][$i]];
            }
            CollectionCondition::storeCondition($collection['id'], $conditions);
        }

        Cache::tags('collections')->flush();

        return redirect()->route(config('pakka.prefix.admin'). '.collections.index')->withSuccess(trans('pakka::app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Collection::getCollection($id, 2);

        Cache::tags('collections')->flush();

        return view('pakka::admin.collections.edit', compact('collection'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //$this->validate($request, Collection::rules(true, $id));

        $array = $request->all();

        $result = constructTranslations($request->all());

        $collection = Collection::findOrFail($id);
        $collection->update($result);

        CollectionCondition::where('collection_id', $id)->delete();
        if (isset($result['string']) && is_array($result['string'])) {
            for ($i = 0; $i < count($result['string']); $i++) {
                $conditions[$i] = ["input" => $result['input'][$i], "operator" => $result['operator'][$i], "string" => $result['string'][$i]];
            }
            CollectionCondition::storeCondition($collection['id'], $conditions);
        }

        Cache::tags('collections')->flush();

        return redirect()->route(config('pakka.prefix.admin'). '.collections.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = Collection::where('id', $id)->get()->toArray();

        foreach ($items as $item) {
            $transName = $item['name'];
            $transSlug = $item['slug'];
            $transDescription = $item['description'];

            Translation::where('translation_id', $transName)->delete();
            Translation::where('translation_id', $transSlug)->delete();
            Translation::where('translation_id', $transDescription)->delete();
        }

        Collection::destroy($id);
        CollectionCondition::where('collection_id', $id)->delete();
        CollectionSet::where('collection_id', $id)->delete();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }

    public function sort(Request $request)
    {
        if ($request->isMethod('post')) {
            $items = $request->all();
            $items = json_decode($items['data'], true);

            foreach ($items as $item) {
                Collection::find($item[0]['id'])->update(['position' => $item[0]['position']]);
            }
        }
    }
}
