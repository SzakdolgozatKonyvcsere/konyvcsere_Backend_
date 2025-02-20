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
        'role' => 1,
        'online_status' => 0,
        'img_url' => "https://img.freepik.com/premium-vector/user-icons-includes-user-icons-people-icons-symbols-premiumquality-graphic-design-elements_981536-526.jpg?semt=ais_hybrid",
    ]);

    $this->assertAuthenticated();
    $response->assertNoContent();
});
