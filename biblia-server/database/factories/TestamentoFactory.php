<?php

namespace Database\Factories;

use App\Models\Testamento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Testamento>
 */
class TestamentoFactory extends Factory
{
    protected $model = Testamento::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->sentence
        ];
    }
}
