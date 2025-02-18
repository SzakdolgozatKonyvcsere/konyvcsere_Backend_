<?php

test('new users can register', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'full_name' => 'Test User',
        'city' => 'Test city',
        'tel' => '+1(202)500',
        'role' => 1
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});
