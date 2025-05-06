<?php

test('halaman kehadiran dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/kehadirans');
    $response->assertStatus(302);
});

test('halaman kehadiran dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/kehadirans');
    $response->assertStatus(302);
});

test('halaman kehadiran dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/kehadirans');
    $response->assertStatus(302);
});

test('halaman kehadiran dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/kehadirans');
    $response->assertStatus(302);
});