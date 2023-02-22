<?php

namespace Tests\Feature;

use App\Models\Livro;
use App\Models\Testamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LivroControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_livroGetOne()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $livro = Livro::factory()->create();

        $response = $this->withToken($token)
            ->getJson('api/livro/'.$livro->id)
            ->assertOk();
        $livroArray = $response->json('livro');
        $this->assertArrayHasKey('nome', $livroArray);
        $this->assertEquals($livro->nome, $livroArray['nome']);

        $this->refreshDatabase();
    }

    public function test_livroGetAll()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $testamento = Testamento::factory()->create(['nome' => 'Novo Testamento']);
        Livro::factory()->count(15)->create( ['testamento_id' => $testamento->id]);

        $response = $this->withToken($token)
            ->getJson(route('livro.index'))
            ->assertOk();

        $this->assertEquals(15, count($response->json()));

        $this->refreshDatabase();
    }

    public function test_livroPost()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $testamento = Testamento::factory()->create();

        $this->withToken($token)
            ->postJson(route('livro.store'),
                [
                    'nome' => 'GENESIS',
                    'posicao' => 1,
                    'abreviacao' => 'GE',
                    'testamento_id' => $testamento->id])
            ->assertCreated();

        $this->assertDatabaseHas('livros',['nome' => 'GENESIS']);

        $this->refreshDatabase();
    }

    public function teste_testamentoUpdate()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $livro = Livro::factory()->create();

        $this->withToken($token)
            ->putJson(route('livro.update', $livro->id),
                ['nome' => 'Teste Update'])
            ->assertOk();

        $this->assertDatabaseHas('livros',['nome' => 'Teste Update']);

        $this->refreshDatabase();
    }

    public function teste_livroDelete()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $livro = Livro::factory()->create();

        $this->withToken($token)
            ->deleteJson(route('livro.destroy', $livro->id))
            ->assertOk();

        $this->refreshDatabase();
    }
}
