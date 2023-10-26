<?php

namespace TheRealJanJanssens\Pakka\Traits\Forms;

use Closure;

trait HasWireables
{
    protected string $constructAttributeKey;

    /**
     * Define the key of the data element used in the constructor method
     *
     * example: • Text::make('first_name') => constructor method name()
     *          • Step::make([ ... ]) => constructor method schema()
     */
    protected function setConstructAttributeKey($key)
    {
        $this->constructAttributeKey = $key;
    }

    /**
     * Generate a array of all attributes that exists in the object
     */
    protected function getObjectAttributes()
    {
        $result = [];
        foreach ($this as $property => $value){
            $result[$property] = $value;
        }
        return $result;
    }

    /**
     * Reconstructs the array into object attributes
     */
    protected function setObjectAttributes($array)
    {
        foreach($array as $key => $value){
            if($value instanceof Closure){
                $value = $this->evaluate($value);
            }

            $this->{$key} = $value;
        }
        return $this;
    }


    public function toLivewire()
    {
        return $this->getObjectAttributes();
    }

    /**
     * Returns the reconstucted class
     *
     * Uses constructAttributeKey to get the right constructor attribute for reconstruted object
     */
    public static function fromLivewire($data)
    {
        $key = $data['constructAttributeKey'];
        return (new static($data[$key]))->setObjectAttributes($data);
    }
}
