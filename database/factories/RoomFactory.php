<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->name;
        $slug = Str::slug($name);
        return [
            'user_id'   => function(){
                $ru   = User::inRandomOrder()->pluck('id')->toArray();
                return Arr::random($ru);
            },
            'name'   => $name,
            'slug'   => $slug,
        ];
    }
}
