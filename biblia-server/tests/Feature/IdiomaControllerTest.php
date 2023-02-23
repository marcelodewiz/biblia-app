<?php

namespace Tests\Feature;

use App\Models\Idioma;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IdiomaControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_idiomaGetOne()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $idioma = Idioma::factory()->create();

        $response = $this->withToken($token)
            ->getJson(route('idioma.show',$idioma->id))
            ->assertOk();
        $idiomaArray = $response->json('idioma');
        $this->assertArrayHasKey('nome', $idiomaArray);
        $this->assertEquals($idioma->nome, $idiomaArray['nome']);

        $this->refreshDatabase();
    }

    public function test_idiomaGetAll()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        Idioma::factory()->count(100)->create();

        $response = $this->withToken($token)
            ->getJson(route('idioma.index'))
            ->assertOk();

        $this->assertEquals(100, count($response->json()));

        $this->refreshDatabase();
    }

    public function test_idiomaPost()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $this->withToken($token)
            ->postJson(route('idioma.store'),
                [
                    'nome' => 'TESTE TESTE'
                ])
            ->assertCreated();

        $this->assertDatabaseHas('idiomas',['nome' => 'TESTE TESTE']);

        $this->refreshDatabase();
    }

    public function teste_idiomaUpdate()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $idioma = Idioma::factory()->create();

        $this->withToken($token)
            ->putJson(route('idioma.update', $idioma->id),
                ['nome' => 'Teste Update'])
            ->assertOk();

        $this->assertDatabaseHas('idiomas',['nome' => 'Teste Update']);

        $this->refreshDatabase();
    }

    public function teste_idiomaDelete()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $idioma = Idioma::factory()->create();

        $this->withToken($token)
            ->deleteJson(route('idioma.destroy', $idioma->id))
            ->assertOk();

        $this->refreshDatabase();
    }
}
