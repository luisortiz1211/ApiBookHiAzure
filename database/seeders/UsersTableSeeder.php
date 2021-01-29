<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla
        User::truncate();
        $faker = \Faker\Factory::create();
        // Crear la misma clave para todos los usuarios
        // conviene hacerlo antes del for para que el seeder
        // no se vuelva lento.
        $password = Hash::make('123123');
        User::create([
            'name' => 'Administrador',
            'last_name' => 'Admin',
            'nickname' => 'Admin',
            'email' => 'admin@prueba.com',
            'password' => $password,
            'image'=> 'hi',
            'ruc' => '1234567890',
            'bussiness_name' => 'Negocio prueba',
            'bussiness_address' => 'Dirección',
            'bussiness_description' => 'Ejemplo de descripción'
        ]);


        // Generar algunos usuarios para nuestra aplicacion
        $num_user=4;
        for ($i = 0; $i < $num_user; $i++) {
            User::create([
                'name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'nickname' => $faker->userName,
                'email' => $faker->email,
                'password' => $password,
                'image'=> $faker->imageUrl(400,300, null, false),
                'ruc' => $faker->ean8,
                'bussiness_name' => $faker->name,
                'bussiness_address' => $faker->address,
                'bussiness_description' => $faker->text
            ]);
        }
    }
}
