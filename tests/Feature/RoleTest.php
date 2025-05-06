<?php

test('halaman manajemen izin dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/roles');
    $response->assertStatus(302);
});

test('halaman buat manajemen izin dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/roles/create');
    $response->assertStatus(302);
});

test('halaman lihat manajemen izin dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/roles/{record}');
    $response->assertStatus(302);
});

test('halaman edit manajemen izin dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/roles/{record}/edit');
    $response->assertStatus(302);
});
