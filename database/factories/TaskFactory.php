<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Task;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [

            'name' => $this->faker->name($nbSentences=0,  $variableNbSentences=true),
          // 'project_id'=>User::all()->random()->id,
            'project_id'=>rand(1, 19),
           // 'email' => $this->faker->unique()->safeEmail(),
            //'adress' => $this->faker->adress(),
            //
        ];
    }
}
