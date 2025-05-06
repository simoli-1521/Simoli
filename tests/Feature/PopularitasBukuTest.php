<?php

test('halaman login dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/popularitas');
    $response->assertStatus(302);
});

test('halaman login dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/popularitas');
    $response->assertStatus(302);
});

test('halaman login dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/popularitas');
    $response->assertStatus(302);
});

test('halaman popularitas buku dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/popularitas');
    $response->assertStatus(302);
});
