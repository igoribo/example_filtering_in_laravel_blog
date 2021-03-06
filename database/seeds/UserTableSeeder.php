<?php

use App\User;
use Illuminate\Database\Seeder;


class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => '$2y$10$OXTY9lEpQ.qh/Ogi2MRGge0T.UIy7h7xajS2.kv9zIYnqyJZk25kC',
        ]);
    }
}
