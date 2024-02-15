<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{

    public function definition()
    {
        return [
            'usuario_id' => User::inRandomOrder()->first()->id,
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ];
    }
}
