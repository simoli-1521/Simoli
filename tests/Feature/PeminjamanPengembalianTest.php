<?php

test('halaman peminjaman dan pengembalian dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/peminjaman-pengembalian');
    $response->assertStatus(302);
});

test('halaman buat peminjaman dan pengembalian dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/peminjaman-pengembalian/create');
    $response->assertStatus(302);
});

test('halaman edit peminjaman dan pengembalian dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/peminjaman-pengembalian/{record}/edit');
    $response->assertStatus(302);
});

test('halaman peminjaman dan pengembalian dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/peminjaman-pengembalian');
    $response->assertStatus(302);
});

test('halaman buat peminjaman dan pengembalian dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/peminjaman-pengembalian/create');
    $response->assertStatus(302);
});

test('halaman edit peminjaman dan pengembalian dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/peminjaman-pengembalian/{record}/edit');
    $response->assertStatus(302);
});
