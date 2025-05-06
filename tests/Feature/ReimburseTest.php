<?php

test('halaman reimburse dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/reimburses');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/reimburses');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/reimburses');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/reimburses');
    $response->assertStatus(302);
});

test('halaman reimburse dapat diakses oleh Keuangan', function () {
    $response = $this->get('/keuangan/reimburses');
    $response->assertStatus(302);
});