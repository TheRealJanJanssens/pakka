<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\CartService;
use TheRealJanJanssens\Pakka\Models\Translation;

class CartServiceController extends Controller
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
        $services = CartService::getCartServices();

        return view('pakka::admin.cart_services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.cart_services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($result, CartService::rules());
        $array = $request->all();
        $result = constructTranslations($request->all());
        $service = CartService::create($result);
        /*
                if(isset($result['value']) && is_array($result['value']) ){
                    for ($i = 0; $i < count($result['value']); $i++){
                        $conditions[$i] = array("operator" => $result['operator'][$i], "value" => $result['value'][$i], "type" => $result['type'][$i]);
                    }
                    ShipmentCondition::storeCondition($service['id'], $conditions);
                }
        */
        
        return redirect()->route(config('pakka.prefix.admin'). '.cart_services.index')->withSuccess(trans('app.success_store'));
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
        $service = CartService::getCartService($id, 2);
        
        return view('pakka::admin.cart_services.edit', compact('service'));
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
        //$this->validate($request, CartService::rules(true, $id));

        $array = $request->all();
        
        $result = constructTranslations($request->all());
        
        $service = CartService::findOrFail($id);
        $service->update($result);
        
        /*
                if(isset($result['value']) && is_array($result['value']) ){
                    for ($i = 0; $i < count($result['value']); $i++){
                        $conditions[$i] = array("operator" => $result['operator'][$i], "value" => $result['value'][$i], "type" => $result['type'][$i]);
                    }
                    ShipmentCondition::storeCondition($service['id'], $conditions);
                }
        */
        
        return redirect()->route(config('pakka.prefix.admin'). '.cart_services.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = CartService::where('id', $id)->get()->toArray();
        
        foreach ($items as $item) {
            $transName = $item['name'];
            $transDescription = $item['description'];
            
            Translation::where('translation_id', $transName)->delete();
            Translation::where('translation_id', $transDescription)->delete();
        }
        
        CartService::destroy($id);
        //ShipmentCondition::where('shipment_option_id',$id)->delete();
        
        return back()->withSuccess(trans('app.success_destroy'));
    }
}
