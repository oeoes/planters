<?php

namespace Database\Factories;

use App\Models\Area;
use Illuminate\Database\Eloquent\Factories\Factory;

class AreaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Area::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'farm_id' => $this->faker->numberBetween(1, 3), // max 3
            'afdelling_id' => $this->faker->numberBetween(1, 15), // max 14
            'block_id' => $this->faker->numberBetween(1, 40) // max 40
        ];
    }
}
