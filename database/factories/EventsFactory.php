<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Events;

class EventsFactory extends Factory
{

     /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Events::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, true),
            'start_date' => $this->faker->dateTimeBetween('+0 days', '+1 week'),
            'end_date' => $this->faker->dateTimeBetween('+1 week', '+2 week'),
            'description' => $this->faker->text(230),
            'created_by' =>1,
        ];
    }
}
