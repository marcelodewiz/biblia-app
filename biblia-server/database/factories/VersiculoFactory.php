<?php

namespace Database\Factories;

use App\Models\Livro;
use App\Models\Versiculo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Versiculo>
 */
class VersiculoFactory extends Factory
{
    protected $model = Versiculo::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'capitulo' => $this->faker->randomDigitNotZero(),
            'versiculo' => $this->faker->randomDigitNotZero(),
            'texto' => $this->faker->sentence,
            'livro_id' => Livro::factory()->create()->id
        ];
    }
}
