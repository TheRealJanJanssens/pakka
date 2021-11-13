<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\SectionItem;

class SectionManagerController extends Controller
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
        $items = SectionItem::orderBy('id')->get();

        return view('pakka::admin.sectionmanager.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.sectionmanager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, SectionItem::rules());

        SectionItem::create($request->all());

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
        $item = SectionItem::findOrFail($id);

        return view('pakka::admin.sectionmanager.edit', compact('item'));
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
        $this->validate($request, SectionItem::rules(true, $id));

        $item = SectionItem::findOrFail($id);

        $item->update($request->all());

        return redirect()->route(config('pakka.prefix.admin'). '.sectionmanager.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SectionItem::destroy($id);

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
}
