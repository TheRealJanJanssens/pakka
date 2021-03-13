<?php

namespace TheRealJanJanssens\Pakka\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Session;

use TheRealJanJanssens\Pakka\Models\Item;
use TheRealJanJanssens\Pakka\Models\Images;
use TheRealJanJanssens\Pakka\Models\AttributeInput;
use TheRealJanJanssens\Pakka\Models\AttributeOption;
use TheRealJanJanssens\Pakka\Models\AttributeValue;
use TheRealJanJanssens\Pakka\Models\Language;
use TheRealJanJanssens\Pakka\Models\MenuItem;
use TheRealJanJanssens\Pakka\Models\Setting;

class InputController extends Controller
{
	public function __construct()
    {
	    $this->middleware('auth');
        constructGlobVars();
    }
    
	public function constructSetId($setId)
	{	
		Session::put('set_id', $setId);
/*
		if(!empty($setId)){
			$storedModuleId = Session::get('set_id');
			
			if($storedModuleId !== $setId){
				Session::put('set_id', $setId);
				$locale = Session::get('locale');
				$module = MenuItem::getMenuItem($setId,$locale);
				Session::put('module_name', $module['name']);
			}
	    }
*/
	}
	
    public function index($setId)
    {
	    $this->constructSetId($setId);
	    
	    $inputs = AttributeInput::getInputs();
	    
	    if(empty($inputs)){
		    $inputId = constructTransId();
		    
		    $result = array(
			    'input_id' => $inputId,
			    'set_id' => Session::get('set_id'),
			    'position' => 1,
			    'label' => 'Titel',
			    'name' => 'title',
			    'type' => 'text',
		    );
		    AttributeInput::create($result);
		    
		    $inputs = AttributeInput::getInputs();
	    }
	    
        return view('pakka::admin.inputs.index', compact('inputs'));
    }
    
    public function create($setId)
    {
	    $this->constructSetId($setId);
	    
        return view('pakka::admin.inputs.create');
    }
    
    public function store(Request $request)
    {
	    $setId = Session::get('set_id');
	    $request->request->add(['set_id' => $setId]); //add to request
	    
        $this->validate($request, AttributeInput::rules());
        
        $result = AttributeOption::constructOptions($request->all());
        
        AttributeInput::create($result);

        return redirect()->route(config('pakka.prefix.admin'). '.inputs.index', Session::get('set_id'))->withSuccess(trans('app.success_store'));
    }
    
    public function edit($setId, $id)
    {
	    $this->constructSetId($setId);
	    
	    $input = AttributeInput::getInput($id);
	    //return $input;
        return view('pakka::admin.inputs.edit', compact('input'));
    }
    
    public function update(Request $request, $id)
    {
	    $setId = Session::get('set_id');
	    
	    $this->constructSetId($setId);
	    
	    $request->request->add(['set_id' => $setId]); //add to request
	    
        $this->validate($request, AttributeInput::rules());

        $input = AttributeInput::findOrFail($id);

        $result = AttributeOption::constructOptions($request->all());
        
        $input->update($result);
		
        return redirect()->route(config('pakka.prefix.admin'). '.inputs.index', Session::get('set_id'))->withSuccess(trans('app.success_store'));     
    }
    
    public function destroy($id)
    {
	    AttributeInput::where('input_id',$id)->delete();
	    AttributeOption::where('input_id',$id)->delete();
	    AttributeValue::where('input_id',$id)->delete();
        return redirect()->route(config('pakka.prefix.admin'). '.inputs.index', Session::get('set_id'))->withSuccess(trans('app.success_store')); 
    }
    
    public function destroyOption($id)
    {
	    $optionIds = explode(',', $id);
	    
	    foreach($optionIds as $optionId){
		    if(!empty($optionId)){
			    AttributeOption::where('option_id',$optionId)->delete();
		    }
	    }
    }
    
    public function sortInputs(Request $request)
    {
        if($request->isMethod('post')){
		    
		    $items = $request->all();
		    $items = json_decode($items['data'], true);

			$query = "";
			foreach($items as $item){				
				$query .= "UPDATE attribute_inputs SET position = ".htmlspecialchars($item[0]['position']).", updated_at = '".date('Y-m-d H:i:s')."' WHERE id =".htmlspecialchars($item[0]['id'])."; ";
				
			}
			
		    DB::unprepared($query); //execute query Unprepared.. only use this in controlpanel
		    
		}
    }
}
