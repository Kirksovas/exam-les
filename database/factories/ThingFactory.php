<?php

namespace Database\Factories;

use App\Models\Thing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThingFactory extends Factory
{
    protected $model = Thing::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'wrnt' => $this->faker->date(),  // Исправлено на генерацию даты
            'master' => User::factory(),     // Используется корректное имя столбца
        ];
    }
}
