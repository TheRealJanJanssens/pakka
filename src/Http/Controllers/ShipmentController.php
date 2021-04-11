<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use TheRealJanJanssens\Pakka\Models\ShipmentCondition;
use TheRealJanJanssens\Pakka\Models\ShipmentOption;

use TheRealJanJanssens\Pakka\Models\Translation;

class ShipmentController extends Controller
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
        $shipments = ShipmentOption::getShipments();

        return view('pakka::admin.shipments.index', compact('shipments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pakka::admin.shipments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->validate($result, ShipmentOption::rules());
        $array = $request->all();
        $result = constructTranslations($request->all());
        $shipment = ShipmentOption::create($result);
        if (isset($result['value']) && is_array($result['value'])) {
            for ($i = 0; $i < count($result['value']); $i++) {
                $conditions[$i] = ["operator" => $result['operator'][$i], "value" => $result['value'][$i], "type" => $result['type'][$i]];
            }
            ShipmentCondition::storeCondition($shipment['id'], $conditions);
        }
        
        return redirect()->route(config('pakka.prefix.admin'). '.shipments.index')->withSuccess(trans('pakka::app.success_store'));
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
        $shipment = ShipmentOption::getShipment($id, 2);
        
        return view('pakka::admin.shipments.edit', compact('shipment'));
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
        //$this->validate($request, ShipmentOption::rules(true, $id));

        $array = $request->all();
        
        $result = constructTranslations($request->all());
        
        $shipment = ShipmentOption::findOrFail($id);
        $shipment->update($result);
        
        if (isset($result['value']) && is_array($result['value'])) {
            for ($i = 0; $i < count($result['value']); $i++) {
                $conditions[$i] = ["operator" => $result['operator'][$i], "value" => $result['value'][$i], "type" => $result['type'][$i]];
            }
            ShipmentCondition::storeCondition($shipment['id'], $conditions);
        }
        
        
        return redirect()->route(config('pakka.prefix.admin'). '.shipments.index')->withSuccess(trans('pakka::app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $items = ShipmentOption::where('id', $id)->get()->toArray();
        
        foreach ($items as $item) {
            $transName = $item['name'];
            $transDescription = $item['description'];
            
            Translation::where('translation_id', $transName)->delete();
            Translation::where('translation_id', $transDescription)->delete();
        }
        
        ShipmentOption::destroy($id);
        ShipmentCondition::where('shipment_option_id', $id)->delete();
        
        return back()->withSuccess(trans('pakka::app.success_destroy'));
    }
}
