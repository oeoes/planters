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
        $arr = [1,2,3,4];
        return [
            'name' => 'subforeman',
            'email' => 'subforeman@planters.com',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'afdelling_id' => 1,
            'jobtype_id' => $arr[array_rand($arr, 1)], //sprayig
        ];
    }
}
