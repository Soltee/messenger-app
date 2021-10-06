<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory(99)->create();
        $u  = \App\Models\User::factory()->create([
            'name'      => 'Test',
            'email'     => 'test@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);
        $u2  = \App\Models\User::factory()->create([
            'name'      => 'Test2',
            'email'     => 'test2@example.com',
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
        ]);

        \App\Models\Room::factory(20)->create();
        \App\Models\Message::factory(200)->create();
        \App\Models\Message::factory(50)->create([
            'user_id'   => $u->id
        ]);
        \App\Models\Message::factory(50)->create([
            'user_id'   => $u2->id
        ]);

    }
}
