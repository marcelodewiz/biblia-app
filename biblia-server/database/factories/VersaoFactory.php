<?php

namespace Database\Factories;

use App\Models\Idioma;
use App\Models\Versao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Versao>
 */
class VersaoFactory extends Factory
{
    protected $model = Versao::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'nome' => $this->faker->sentence,
            'abreviacao' => $this->faker->sentence,
            'idioma_id' => Idioma::factory()->create()->id
        ];
    }
}
