<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_validRegisterRequest(){
        $this->withoutExceptionHandling();

        $this->postJson(route('auth.register'), [
            'name' => 'Marcelo',
            'email' => 'marcelo@teste.com.br',
            'password' => '123456',
            'password_confirmation' => '123456',
            'nameToken' => 'teste_token'
        ])
            ->assertCreated();

        $this->assertDatabaseHas('users',['name' => 'Marcelo']);

    }

    public function test_aUserCanLoginWithEmailAndPassword(){
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $response = $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertOk();

        $this->assertArrayHasKey('token', $response->json());

    }

    public function test_ifUsertEmailIsNotAvailableTHenItReturnError(){
        $this->withoutExceptionHandling();

        $response = $this->postJson(route('auth.login'), [
            'email' => 'marcelo@teste.com.br',
            'password' => '123456',
        ])
            ->assertUnauthorized();

    }

    public function test_ifRaiseErrorWithPasswordIncorrect(){
        $this->withoutExceptionHandling();

        $user = User::factory()->create();

        $this->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'random',
        ])
            ->assertUnauthorized();
    }
}
