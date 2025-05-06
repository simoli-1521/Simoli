<?php

test('halaman keterlambatan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/keterlambatans');
    $response->assertStatus(302);
});

test('halaman buat keterlambatan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/keterlambatans/create');
    $response->assertStatus(302);
});

test('halaman edit keterlambatan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/keterlambatans/{record}/edit');
    $response->assertStatus(302);
});

test('halaman keterlambatan dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/keterlambatans');
    $response->assertStatus(302);
});

test('halaman buat keterlambatan dapat diakses oleh Kepala DinasAdmin', function () {
    $response = $this->get('/kadin/keterlambatans/create');
    $response->assertStatus(302);
});

test('halaman edit keterlambatan dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/keterlambatans/{record}/edit');
    $response->assertStatus(302);
});

test('halaman keterlambatan dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/keterlambatans');
    $response->assertStatus(302);
});

test('halaman buat keterlambatan dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/keterlambatans/create');
    $response->assertStatus(302);
});

test('halaman edit keterlambatan dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/keterlambatans/{record}/edit');
    $response->assertStatus(302);
});

test('halaman keterlambatan dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/keterlambatans');
    $response->assertStatus(302);
});

test('halaman buat keterlambatan dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/keterlambatans/create');
    $response->assertStatus(302);
});

test('halaman edit keterlambatan dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/keterlambatans/{record}/edit');
    $response->assertStatus(302);
});