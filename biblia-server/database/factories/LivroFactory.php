<?php

namespace Database\Factories;

use App\Models\Livro;
use App\Models\Testamento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Livro>
 */
class LivroFactory extends Factory
{
    protected $model = Livro::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'posicao' => $this->faker->randomDigitNotZero(),
            'nome' => $this->faker->sentence,
            'abreviacao' => $this->faker->sentence,
            'testamento_id' => Testamento::factory()->create()->id
        ];
    }
}
