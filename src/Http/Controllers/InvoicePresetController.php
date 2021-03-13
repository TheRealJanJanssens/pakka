<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\InvoicePreset;

class InvoicePresetController extends Controller
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
        $items = InvoicePreset::orderBy('position')->get();
        return view('pakka::admin.invoice_presets.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.invoice_presets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    //create user
        $this->validate($request, InvoicePreset::rules());
        $inputs = $request->all();
        $inputs['price'] = str_replace(',', '.', $inputs['price']); //makes sure float values are stored correctly
        
        $preset = InvoicePreset::create($inputs);
		
        return back()->withSuccess(trans('app.success_store'));
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
        $item = InvoicePreset::findOrFail($id);
        $item['price'] = str_replace('.', ',', $item['price']);
        
		//dd($item);
        return view('pakka::admin.invoice_presets.edit', compact('item'));
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
		//update user
		$this->validate($request, InvoicePreset::rules(true, $id));
        $preset = InvoicePreset::findOrFail($id);
        
        $inputs = $request->all();
        $inputs['price'] = str_replace(',', '.', $inputs['price']); //makes sure float values are stored correctly
        
        $preset->update($inputs);
		
        return redirect()->route(config('pakka.prefix.admin'). '.invoice_presets.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InvoicePreset::destroy($id);
		
        return back()->withSuccess(trans('app.success_destroy')); 
    }
}

