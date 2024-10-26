<?php


test('Página inicial retorna versão e nome do APP', function () {

    $response = $this->get('/');
    $content = $response->json();
    $response->assertStatus(200);
    $this->assertArrayHasKey('Name', $content);
    $this->assertArrayHasKey('Laravel', $content);
    $this->assertEquals('BomBomBet', $content['Name']);
    $this->assertEquals('11.23.5', $content['Laravel']);
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertNoContent();
});
