<?php

namespace TheRealJanJanssens\Pakka\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\Pakka\Models\User;

class MenuFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name
        ];
    }
}
