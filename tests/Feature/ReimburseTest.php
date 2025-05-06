<?php

test('halaman reimburse dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/reimburses');
    $response->assertStatus(302);
});

test('halaman buat reimburse dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/reimburses/create');
    $response->assertStatus(302);
});

test('halaman edit reimburse dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/reimburses/{record}/edit');
    $response->assertStatus(302);
});

test('halaman laporan reimburse dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/reimburses/{record}/laporan');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/reimburses');
    $response->assertStatus(302);
});

test('halaman buat reimburse dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/reimburses/create');
    $response->assertStatus(302);
});

test('halaman edit reimburse dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/reimburses/{record}/edit');
    $response->assertStatus(302);
});

test('halaman laporan reimburse dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/reimburses/{record}/laporan');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/reimburses');
    $response->assertStatus(302);
});

test('halaman buat reimburse dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/reimburses/create');
    $response->assertStatus(302);
});

test('halaman edit reimburse dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/reimburses/{record}/edit');
    $response->assertStatus(302);
});

test('halaman laporan reimburse dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/reimburses/{record}/laporan');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/reimburses');
    $response->assertStatus(302);
});

test('halaman buat reimburse dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/reimburses/create');
    $response->assertStatus(302);
});

test('halaman edit reimburse dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/reimburses/{record}/edit');
    $response->assertStatus(302);
});

test('halaman laporan reimburse dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/reimburses/{record}/laporan');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Keuangan', function () {
    $response = $this->get('/keuangan/reimburses');
    $response->assertStatus(302);
});

test('halaman buat reimburse dapat diakses oleh Keuangan', function () {
    $response = $this->get('/keuangan/reimburses/create');
    $response->assertStatus(302);
});

test('halaman edit reimburse dapat diakses oleh Keuangan', function () {
    $response = $this->get('/keuangan/reimburses/{record}/edit');
    $response->assertStatus(302);
});

test('halaman laporan reimburse dapat diakses oleh Keuangan', function () {
    $response = $this->get('/keuangan/reimburses/{record}/laporan');
    $response->assertStatus(302);
});
