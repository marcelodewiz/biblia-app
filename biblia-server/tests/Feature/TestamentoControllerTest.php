<?php

namespace Tests\Feature;

use App\Models\Testamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestamentoControllerTest extends TestCase
{

    use RefreshDatabase;

    public function test_testamentoGetOne()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        $testamento = Testamento::factory()->create(['nome' => 'Antigo Testamento']);

        $response = $this->withToken($token)
            ->getJson('api/testamento/'.$testamento->id)
            ->assertOk();
        $testamento = $response->json('testamento');
        $this->assertArrayHasKey('nome', $testamento);
        $this->assertEquals('Antigo Testamento', $testamento['nome']);

        $this->refreshDatabase();
    }

    public function test_testamentoGetAll()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        Testamento::factory()->count(2)->create();

        $response = $this->withToken($token)
            ->getJson('api/testamento')
            ->assertOk();

        $this->assertEquals(2, count($response->json()));

        $this->refreshDatabase();
    }

    public function test_testamentoPost()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);


        $response = $this->withToken($token)
            ->postJson('api/testamento',
            ['nome' => 'Novo Testamento'])
            ->assertCreated();

        $this->assertDatabaseHas('testamentos',['nome' => 'Novo Testamento']);

        $this->refreshDatabase();
    }

    public function teste_testamentoUpdate()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $testamento = Testamento::factory()->create();

        $this->withToken($token)
            ->putJson('api/testamento/'.$testamento->id,
            ['nome' => 'Teste Update'])
            ->assertOk();

        $this->assertDatabaseHas('testamentos',['nome' => 'Teste Update']);

        $this->refreshDatabase();
    }

    public function teste_testamentoDelete()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        $testamento = Testamento::factory()->create();

        $this->withToken($token)
            ->deleteJson('api/testamento/'.$testamento->id)
            ->assertOk();

        $this->refreshDatabase();
    }
}
