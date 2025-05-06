<?php

test('halaman permintaan buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/permintaan');
    $response->assertStatus(302);
});

test('halaman buat permintaan buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/permintaan/create');
    $response->assertStatus(302);
});

test('halaman edit permintaan buku dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/permintaan/{record}/edit');
    $response->assertStatus(302);
});

test('halaman permintaan buku dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/permintaan');
    $response->assertStatus(302);
});

test('halaman buat permintaan buku dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/permintaan/create');
    $response->assertStatus(302);
});

test('halaman edit permintaan buku dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/permintaan/{record}/edit');
    $response->assertStatus(302);
});

test('halaman permintaan buku dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/permintaan');
    $response->assertStatus(302);
});

test('halaman buat permintaan buku dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/permintaan/create');
    $response->assertStatus(302);
});

test('halaman edit permintaan buku dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/permintaan/{record}/edit');
    $response->assertStatus(302);
});

test('halaman permintaan buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/permintaan');
    $response->assertStatus(302);
});

test('halaman buat permintaan buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/permintaan/create');
    $response->assertStatus(302);
});

test('halaman edit permintaan buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/permintaan/{record}/edit');
    $response->assertStatus(302);
});

test('halaman permintaan buku dapat diakses oleh Pemohon', function () {
    $response = $this->get('/pemohon/permintaan');
    $response->assertStatus(302);
});

test('halaman buat permintaan buku dapat diakses oleh Pemohon', function () {
    $response = $this->get('/pemohon/permintaan/create');
    $response->assertStatus(302);
});

test('halaman edit permintaan buku dapat diakses oleh Pemohon', function () {
    $response = $this->get('/pemohon/permintaan/{record}/edit');
    $response->assertStatus(302);
});

test('halaman permintaan buku dapat diakses oleh Peserta', function () {
    $response = $this->get('/peserta/permintaan');
    $response->assertStatus(302);
});

test('halaman buat permintaan buku dapat diakses oleh Peserta', function () {
    $response = $this->get('/peserta/permintaan/create');
    $response->assertStatus(302);
});

test('halaman edit permintaan buku dapat diakses oleh Peserta', function () {
    $response = $this->get('/peserta/permintaan/{record}/edit');
    $response->assertStatus(302);
});