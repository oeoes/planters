<?php

namespace Database\Factories;

use App\Models\Subforeman;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'afdelling_id' => 1,
            'jobtype_id' => $this->faker->numberBetween(1, 3) //sprayig
        ];
    }
}
