<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'birth_date' => $this->faker->dateTimeBetween($startDate = '-70 years', $endDate = 'now', $timezone = null),
            'phone_number' => $this->faker->phoneNumber
        ];
    }
}
