<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use TheRealJanJanssens\Pakka\Models\Template;

class TemplateController extends Controller
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
        $templates = Template::all();

        return view('pakka::admin.templates.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Template::rules());
        $template = Template::store($request);

        return redirect()->route(config('pakka.prefix.admin'). '.templates.index')->withSuccess(trans('pakka::app.success_store'));
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
        $template = Template::findOrFail($id);

        return view('pakka::admin.templates.edit', compact('template'));
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
        // $this->validate($request, Template::rules());

        // //Remove before editing
        // $template = Template::findOrFail($id);
        // Template::destroy($id);
        // Storage::disk('public')->delete('templates/'.$template->file);


        // $template = Template::store($request);

        // return redirect()->route(config('pakka.prefix.admin'). '.templates.index')->withSuccess(trans('pakka::app.success_update'));
    }

    public function download($id)
    {
        $template = Template::findOrFail($id);

        return Storage::disk('public')->download('templates/'.$template->file);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = Template::findOrFail($id);
        Template::destroy($id);
        Storage::disk('public')->delete('templates/'.$template->file);

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
}
