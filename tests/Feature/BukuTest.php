<?php

test('halaman buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/buku');
    $response->assertStatus(302);
});

test('halaman buat buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/buku/create');
    $response->assertStatus(302);
});

test('halaman edit buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/buku/{record}/edit');
    $response->assertStatus(302);
});

test('halaman buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/buku');
    $response->assertStatus(302);
});

test('halaman buat buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/buku/create');
    $response->assertStatus(302);
});

test('halaman edit buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/buku/{record}/edit');
    $response->assertStatus(302);
});
