<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class FeatureOperator
{
    /**
     * @param TestCase $testCase
     * @return string $token
     */
    public function loginUser(TestCase $testCase){
        $user = User::factory()->create();

        $response = $testCase->postJson(route('auth.login'), [
            'email' => $user->email,
            'password' => 'password',
        ])
            ->assertOk();
        return $response->json('token');
    }

}
