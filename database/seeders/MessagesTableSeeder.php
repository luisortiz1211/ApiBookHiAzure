<?php

namespace Database\Seeders;

use App\Models\Business;
use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class MessagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciamos la tabla message
        Message::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos todos los chats
        $chats = Chat::all();
        foreach ($chats as $chat) {
            $num_messages = 5;
            $arr = array($chat->user_id1,$chat->user_id2);
            for ($j = 0; $j < $num_messages; $j++) {
                $k = array_rand($arr);
                $v = $arr[$k];
                Message::create([
                    'message' => $faker->sentence,
                    'chat_id'=>$chat->id,
                    'user_id'=>$v,

                ]);
            }
        }
    }
}
