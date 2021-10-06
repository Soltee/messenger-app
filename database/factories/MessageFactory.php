<?php

namespace Database\Factories;

use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'   => function(){
                $ru   = User::inRandomOrder()->pluck('id')->toArray();
                return Arr::random($ru);
            },
            'room_id'   => function(){
                $room   = Room::inRandomOrder()->pluck('id')->toArray();
                return Arr::random($room);
            },
            'message'   => $this->faker->text(500)
        ];
    }
}
