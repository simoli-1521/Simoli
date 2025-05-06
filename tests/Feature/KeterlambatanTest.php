<?php

test('halaman keterlambatan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/keterlambatans');
    $response->assertStatus(302);
});

test('halaman keterlambatan dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/keterlambatans');
    $response->assertStatus(302);
});

test('halaman keterlambatan dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/keterlambatans');
    $response->assertStatus(302);
});

test('halaman keterlambatan dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/keterlambatans');
    $response->assertStatus(302);
});