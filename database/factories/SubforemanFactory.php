<?php

namespace Database\Factories;

use App\Models\Subforeman;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
class SubforemanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subforeman::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'), // password
            'afdelling_id' => 1,
            'jobtype_id' => $this->faker->numberBetween(1, 7) //sprayig
        ];
    }
}
