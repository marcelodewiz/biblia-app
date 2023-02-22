<?php

namespace Tests\Feature;

use App\Models\Livro;
use App\Models\Testamento;
use App\Models\Versiculo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VersiculoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_versiculoGetOne()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $versiculo = Versiculo::factory()->create();

        $response = $this->withToken($token)
            ->getJson(route('versiculo.show',$versiculo->id))
            ->assertOk();
        $versiculoArray = $response->json();
        $this->assertArrayHasKey('texto', $versiculoArray);
        $this->assertEquals($versiculo->texto, $versiculoArray['texto']);

        $this->refreshDatabase();
    }

    public function test_versiculoGetAll()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        Versiculo::factory()->count(80)->create();

        $response = $this->withToken($token)
            ->getJson(route('versiculo.index'))
            ->assertOk();

        $this->assertEquals(80, count($response->json()));

        $this->refreshDatabase();
    }

    public function test_versiculoPost()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $livro = Livro::factory()->create();

        $this->withToken($token)
            ->postJson(route('versiculo.store'),
                [
                    'capitulo' => 1,
                    'versiculo' => 1,
                    'texto' => 'TESTE TESTE',
                    'livro_id' => $livro->id])
            ->assertCreated();

        $this->assertDatabaseHas('versiculos',['texto' => 'TESTE TESTE']);

        $this->refreshDatabase();
    }

    public function teste_versiculoUpdate()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $versiculo = Versiculo::factory()->create();

        $this->withToken($token)
            ->putJson(route('versiculo.update', $versiculo->id),
                ['texto' => 'Teste Update'])
            ->assertOk();

        $this->assertDatabaseHas('versiculos',['texto' => 'Teste Update']);

        $this->refreshDatabase();
    }

    public function teste_versiculoDelete()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $versiculo = Versiculo::factory()->create();

        $this->withToken($token)
            ->deleteJson(route('versiculo.destroy', $versiculo->id))
            ->assertOk();

        $this->refreshDatabase();
    }
}
