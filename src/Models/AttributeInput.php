<?php

namespace TheRealJanJanssens\Pakka\Models;

use TheRealJanJanssens\Pakka\Models\AttributeOption;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Session;

class AttributeInput extends Model
{
    use Notifiable;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'input_id',
        'set_id',
        'position',
        'label',
        'name',
        'type',
        'created_at',
        'updated_at',
    ];
    
    /*
    |------------------------------------------------------------------------------------
    | Validations
    |------------------------------------------------------------------------------------
    */
    public static function rules($update = false, $id = null)
    {
        $commun = [
            'set_id' => "required",
            'name' => "required",
            'type' => "required",
            
        ];

        if ($update) {
            return $commun;
        }

        return array_merge($commun, [
            'set_id' => "required",
            'name' => "required",
            'type' => "required",
        ]);
    }
    
    public function getOptions()
    {

        // Accessing comments posted by a user
    
        return $this->hasMany(\App\AttributeOption::class);
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Get Input
    | $id = select input with its id
    |------------------------------------------------------------------------------------
    */
    
    public static function getInput($id)
    {
        $queryResult = AttributeInput::select([
        'attribute_inputs.id',
        'attribute_inputs.input_id',
        'attribute_inputs.set_id',
        'attribute_inputs.position',
        'attribute_inputs.label',
        'attribute_inputs.name',
        'attribute_inputs.type',
        ])
        ->where('attribute_inputs.id', $id)
        ->orderBy('attribute_inputs.position')
        ->get()->toArray();
        
        $i = 0;
        foreach ($queryResult as $item) {
            if ($item["type"] == "select" || $item["type"] == "checkbox") {
                $options = AttributeOption::select([
                    'attribute_options.id',
                    'attribute_options.input_id',
                    'attribute_options.option_id',
                    'attribute_options.language_code',
                'attribute_options.value',
                'attribute_options.position',
                ])
                ->where('attribute_options.input_id', $item["input_id"])
                ->orderBy('attribute_options.position')
                ->get()->toArray();
                
                foreach ($options as $option) {
                    $name = $option['language_code'].":option";
                    
                    if (! isset($queryResult[$i][$name])) {
                        $queryResult[$i][$name] = [];
                    }
                    array_push($queryResult[$i][$name], $option);
                }
            }
            $i++;
        }

        return $queryResult[0]; //outputs array
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Get Inputs
    | selects all the inputs related to the moduleId stored in session
    |------------------------------------------------------------------------------------
    */
    
    public static function getInputs()
    {
        $queryResult = AttributeInput::select([
        'attribute_inputs.id',
        'attribute_inputs.input_id',
        'attribute_inputs.set_id',
        'attribute_inputs.position',
        'attribute_inputs.label',
        'attribute_inputs.name',
        'attribute_inputs.type',
        ])
        ->where('attribute_inputs.set_id', Session::get('set_id'))
        ->orderBy('attribute_inputs.position')
        ->get()->toArray();
        
        $i = 0;
        foreach ($queryResult as $item) {
            if ($item["type"] == "select" || $item["type"] == "checkbox") {
                $options = AttributeOption::select([
                    'attribute_options.id',
                    'attribute_options.input_id',
                    'attribute_options.option_id',
                    'attribute_options.language_code',
                'attribute_options.value',
                'attribute_options.position',
                ])
                ->where('attribute_options.input_id', $item["input_id"])
                ->where('attribute_options.language_code', Session::get("locale"))
                ->orderBy('attribute_options.position')
                ->get()->toArray();
                
                foreach ($options as $option) {
                    $name = $option['language_code'].":option";
                    
                    if (! isset($queryResult[$i][$name])) {
                        $queryResult[$i][$name] = [];
                    }
                    array_push($queryResult[$i][$name], $option);
                }
            }
            $i++;
        }

        return $queryResult; //outputs array
    }
    
    /*
    |------------------------------------------------------------------------------------
    | Gets a checklist for Inputs
    | selects all the inputs (name => input_id) related to the moduleId stored in session
    |------------------------------------------------------------------------------------
    */
    
    public static function getInputsChecklist()
    {
        $result = null;
        $queryResult = AttributeInput::select([
        'attribute_inputs.input_id',
        'attribute_inputs.name',
        ])
        ->where('attribute_inputs.set_id', Session::get('set_id'))
        ->orderBy('attribute_inputs.position')
        ->get();
        
        
        foreach ($queryResult as $item) {
            $result[$item->name] = $item->input_id;
        }

        return $result; //outputs array
    }
}
