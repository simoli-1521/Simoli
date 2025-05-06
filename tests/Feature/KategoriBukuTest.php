<?php

test('halaman kategori buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/kategori-buku');
    $response->assertStatus(302);
});

test('halaman buat kategori buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/kategori-buku/create');
    $response->assertStatus(302);
});

test('halaman edit kategori buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/kategori-buku/{record}/edit');
    $response->assertStatus(302);
});

test('halaman kategori buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/kategori-buku/create');
    $response->assertStatus(302);
});

test('halaman buat kategori buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/kategori-buku');
    $response->assertStatus(302);
});

test('halaman edit kategori buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/kategori-buku/{record}/edit');
    $response->assertStatus(302);
});
