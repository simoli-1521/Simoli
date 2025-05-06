<?php

test('halaman manajemen akun dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/users');
    $response->assertStatus(302);
});

test('halaman buat manajemen akun dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/users/create');
    $response->assertStatus(302);
});

test('halaman edit manajemen akun dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/users/{record}/edit');
    $response->assertStatus(302);
});
