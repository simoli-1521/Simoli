<?php

test('halaman perpustakaan buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/perpustakaan');
    $response->assertStatus(302);
});

test('halaman buat perpustakaan buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/perpustakaan/create');
    $response->assertStatus(302);
});

test('halaman edit perpustakaan buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/perpustakaan/{record}/edit');
    $response->assertStatus(302);
});

test('halaman perpustakaan buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/perpustakaan');
    $response->assertStatus(302);
});

test('halaman buat perpustakaan buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/perpustakaan/create');
    $response->assertStatus(302);
});

test('halaman edit perpustakaan buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/perpustakaan/{record}/edit');
    $response->assertStatus(302);
});