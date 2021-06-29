<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\Forms;
use TheRealJanJanssens\Pakka\Models\AttributeInput;
use TheRealJanJanssens\Pakka\Models\AttributeOption;
use TheRealJanJanssens\Pakka\Models\AttributeValue;


class FormController extends Controller
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
        $items = Forms::all();

        return view('pakka::admin.forms.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.forms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['set_id' => generateString(10)]);
        
        //create Form
        $this->validate($request, Forms::rules());
        Forms::create($request->all());
    
        return redirect()->route(config('pakka.prefix.admin'). '.forms.index')->withSuccess(trans('pakka::app.success_store'));
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
        $item = Forms::findOrFail($id);
        return view('pakka::admin.forms.edit', compact('item'));
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
        //update Form
        //$this->validate($request, Forms::rules());
        $form = Forms::findOrFail($id);
        $form->update($request->all());
        
        return redirect()->route(config('pakka.prefix.admin'). '.forms.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $form = Forms::findOrFail($id);
        Forms::destroy($id);
        AttributeInput::where('input_id', $form['set_id'])->delete();
        AttributeOption::where('input_id', $form['set_id'])->delete();
        AttributeValue::where('input_id', $form['set_id'])->delete();

        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
}
