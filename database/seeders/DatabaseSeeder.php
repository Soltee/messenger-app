<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use DB;

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

        \App\Models\User::factory(70)->create();
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

        \App\Models\Room::factory(100)->create();
        \App\Models\Message::factory(200)->create();
        \App\Models\Message::factory(50)->create([
            'user_id'   => $u->id
        ]);
        \App\Models\Message::factory(50)->create([
            'user_id'   => $u2->id
        ]);

        //Rooms & Users
        // for ($i=1; $i < 100; $i++) { 
         
        //     $user = \App\Models\User::where('id', '!=', $u->id)
        //                                 ->inRandomOrder()
        //                                 ->pluck('id')->toArray();
        //     $room = \App\Models\Room::inRandomOrder()->pluck('id')->toArray();
        //     DB::table('room_user')->insert(
        //         [
        //             'user_id'  => Arr::random($user),
        //             'room_id'  => Arr::random($room),
        //         ]);
        //     // code...
        // }
        // for ($i=1; $i < 10; $i++) { 
        //     // code...
        //     $room = \App\Models\Room::inRandomOrder()->pluck('id')->toArray();
        //     DB::table('room_user')->insert(
        //         [
        //             'user_id'  => $u->id,
        //             'room_id'  => Arr::random($room),
        //         ]);
        // }
        for ($i=1; $i < 10; $i++) { 
            // code...
            $room = \App\Models\Room::inRandomOrder()->pluck('id')->toArray();
            DB::table('room_user')->insert(
                [
                    // 'user_id'  => Arr::random([$u->id, $u2->id]),
                    'user_id'  => $u->id,
                    'room_id'  => Arr::random($room),
                ]);
        }
        for ($i=1; $i < 10; $i++) { 
            // code...
            $room = \App\Models\Room::inRandomOrder()->pluck('id')->toArray();
            DB::table('room_user')->insert(
                [
                    // 'user_id'  => Arr::random([$u->id, $u2->id]),
                    'user_id'  => $u2->id,
                    'room_id'  => Arr::random($room),
                ]);
        }


        for ($i=1; $i < 50; $i++) { 
            // code...
            $user = \App\Models\User::where('user_id', '!=', [$u->id, $u2->id])->inRandomOrder()->pluck('id')->toArray();
            $room = \App\Models\Room::inRandomOrder()->pluck('id')->toArray();
            DB::table('room_user')->insert(
                [
                    'user_id'  => Arr::random($user),
                    'room_id'  => Arr::random($room),
                ]);
        }

    }
}
