<?php

namespace TheRealJanJanssens\Pakka\Models;

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
        'required',
        'attributes',
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

    // public static function prepareAttributes($array)
    // {
    //     $attributeInputs = ["input_width"];

    //     foreach ($attributeInputs as $attributeInput) {
    //         if (isset($array[$attributeInput])) {
    //             $array['attributes'][$attributeInput] = $array[$attributeInput];
    //             unset($array[$attributeInput]);
    //         }
    //     }

    //     if (isset($array['attributes'])) {
    //         $array['attributes'] = json_encode($array['attributes']);
    //     }

    //     return $array;
    // }

    public static function input($id)
    {
        return AttributeInput::query()
            ->where('id', $id)
            ->orderBy('position')
            ->first();
    }

    public static function inputs()
    {
        $id = isset($id) ? $id : Session::get('set_id');

        return AttributeInput::query()
            ->where('set_id', $id)
            ->orderBy('position')
            ->get();
    }

    public function constructAttributes($array)
    {
        $array['attributes'] = json_decode($array['attributes']);

        if (! empty($array['attributes'])) {
            foreach ($array['attributes'] as $key => $value) {
                $array[$key] = $value;
            }
        }

        return $array;
    }

    public function toArray()
    {
        $array = constructTranslatableValues([$this], ['label']); // temporary solution

        //$array = parent::toArray();
        $array = $this->constructAttributes($array);
        //dd($array);
        return $array;
    }

    public function getLabelAttribute($value)
    {
        return Translation::getTranslation($value) ?? $value;
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
