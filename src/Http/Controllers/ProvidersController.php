<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\Provider;
use TheRealJanJanssens\Pakka\Models\ProviderSchedule;

class ProvidersController extends Controller
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
        $providers = Provider::getProviders();

        return view('pakka::admin.providers.index', compact('providers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.providers.create')->with('warning', 'test');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, Provider::rules());
      
        $array = $request->all();

        $provider = Provider::create($array);
        if (isset($array['schedule'])) {
            ProviderSchedule::storeSchedule($provider['id'], $array['schedule']);
        }
    
        return redirect()->route(config('pakka.prefix.admin'). '.providers.index')->withSuccess(trans('app.success_store'));
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
        $provider = Provider::getProvider($id);

        return view('pakka::admin.providers.edit', compact('provider'));
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
        $this->validate($request, Provider::rules(true, $id));
        $array = $request->all();
    
        $provider = Provider::findOrFail($id);
        $provider->update($request->all());

        if (isset($array['schedule'])) {
            ProviderSchedule::storeSchedule($id, $array['schedule']);
        }

        return redirect()->route(config('pakka.prefix.admin'). '.providers.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Provider::destroy($id);
        ProviderSchedule::where('provider_id', $id)->delete();
        
        return back()->withSuccess(trans('app.success_destroy'));
    }
}
