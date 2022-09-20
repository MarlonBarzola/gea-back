<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $title = $this->faker->unique()->word(30);

        return [
            'reason' => $title,
            'personal_history' => $this->faker->text(),
            'family_history' => $this->faker->text(),
            'vital_signs' => $this->faker->text(1000),
            'patient_id' => Patient::all()->random()->id,
        ];
    }
}
