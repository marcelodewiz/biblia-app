<?php

namespace Tests\Feature;

use App\Models\Testamento;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestamentoTest extends TestCase
{

    use RefreshDatabase;

    public function test_testamentoGetOne()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);
        Testamento::factory()->create(['nome' => 'Antigo Testamento']);

        $response = $this->withToken($token)
            ->getJson('api/testamento/1')
            ->assertOk();

        $this->assertArrayHasKey('nome', $response->json());
        $this->assertEquals('Antigo Testamento', $response->json('nome'));
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
    }

    public function teste_testamentoUpdate()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        Testamento::factory()->create();

        $this->withToken($token)
            ->putJson('api/testamento/1',
            ['nome' => 'Teste Update'])
            ->assertOk();

        $this->assertDatabaseHas('testamentos',['nome' => 'Teste Update']);
    }

    public function teste_testamentoDelete()
    {
        $this->withoutExceptionHandling();

        $operator = new FeatureOperator();
        $token = $operator->loginUser($this);

        Testamento::factory()->create();

        $this->withToken($token)
            ->deleteJson('api/testamento/1')
            ->assertOk();
    }
}
