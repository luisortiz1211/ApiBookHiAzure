<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Vaciar la tabla books.
        Book::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear libros en su nombre
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Y ahora con este usuario creamos algunos libros
            $num_books = 5;
            for ($j = 0; $j < $num_books; $j++) {
                Book::create([
                    'title' => $faker->sentence,
                    'author' => $faker->name,
                    'editorial' => $faker->sentence,
                    'year_edition' => $faker->numberBetween(1700, 2020),
                    'price' => $faker->randomFloat(2, 1, 10),
                    'pages' => $faker->numberBetween(10, 1000),
                    'synopsis' => $faker->paragraph,
                    'cover_page' => $faker->imageUrl(400,300, null, false),
                    'back_cover' => $faker->imageUrl(400,300, null, false),
                    'available' => $faker->boolean,
                    'new' => $faker->boolean,
                    'category_id' => $faker->numberBetween(1,5)
                ]);
            }
        }

    }
}
