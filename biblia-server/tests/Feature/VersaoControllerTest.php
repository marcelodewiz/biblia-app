<?php

namespace Tests\Feature;

use App\Models\Idioma;
use App\Models\Versao;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VersaoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_versaoGetOne()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $versao = Versao::factory()->create();

        $response = $this->withToken($token)
            ->getJson(route('versao.show',$versao->id))
            ->assertOk();
        $versaoArray = $response->json('versao');
        $this->assertArrayHasKey('nome', $versaoArray);
        $this->assertEquals($versao->nome, $versaoArray['nome']);

        $this->refreshDatabase();
    }

    public function test_versaoGetAll()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        Versao::factory()->count(55)->create();

        $response = $this->withToken($token)
            ->getJson(route('versao.index'))
            ->assertOk();

        $this->assertEquals(55, count($response->json()));

        $this->refreshDatabase();
    }

    public function test_versaoPost()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $idioma = Idioma::factory()->create();

        $this->withToken($token)
            ->postJson(route('versao.store'),
                [
                    'nome' => 'TESTE TESTE',
                    'abreviacao' => 'TT',
                    'idioma_id' => $idioma->id])
            ->assertCreated();

        $this->assertDatabaseHas('versoes',['nome' => 'TESTE TESTE']);

        $this->refreshDatabase();
    }

    public function teste_versaoUpdate()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $versao = Versao::factory()->create();

        $this->withToken($token)
            ->putJson(route('versao.update', $versao->id),
                ['nome' => 'Teste Update'])
            ->assertOk();

        $this->assertDatabaseHas('versoes',['nome' => 'Teste Update']);

        $this->refreshDatabase();
    }

    public function teste_versaoDelete()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $versao = Versao::factory()->create();

        $this->withToken($token)
            ->deleteJson(route('versao.destroy', $versao->id))
            ->assertOk();

        $this->refreshDatabase();
    }
}
