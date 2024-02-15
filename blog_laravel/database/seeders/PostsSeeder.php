<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsSeeder extends Seeder
{

    public function run()
    {
        $usuarios = \App\Models\User::all();
        foreach ($usuarios as $usuario) {
            \App\Models\Post::factory()->count(3)->create(['usuario_id' => $usuario->id]);
        }
    }
}
