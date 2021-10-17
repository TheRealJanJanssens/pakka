<?php

namespace TheRealJanJanssens\Pakka\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use TheRealJanJanssens\Pakka\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'password' => $this->faker->password,
            'role' => 10
        ];
    }
}
