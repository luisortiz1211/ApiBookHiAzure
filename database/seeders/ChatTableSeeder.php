<?php

namespace Database\Seeders;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ChatTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Vaciamos la tabla chat
        Chat::truncate();
        // Obtenemos todos los usuarios
        $users = User::all();
        $var = 5;
        foreach ($users as $user) {
            // iniciamos sesión con cada uno
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Creamos un chat para cada negocio con este usuario
                Chat::create([
                    'user_id1' => $user->id,
                    'user_id2' => $var,
                ]);
        }
    }
}
