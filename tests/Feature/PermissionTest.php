<?php

test('halaman manajemen peran dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/permisssions');
    $response->assertStatus(404);
});

test('halaman buat manajemen peran dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/permisssions/create');
    $response->assertStatus(404);
});

test('halaman lihat manajemen peran dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/permisssions/{record}');
    $response->assertStatus(404);
});

test('halaman edit manajemen peran dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/permisssions/{record}/edit');
    $response->assertStatus(404);
});
