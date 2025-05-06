<?php

test('halaman profil dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/edit-profile');
    $response->assertStatus(302);
});

test('halaman profil dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/edit-profile');
    $response->assertStatus(302);
});

test('halaman profil dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/edit-profile');
    $response->assertStatus(302);
});

test('halaman profil dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/edit-profile');
    $response->assertStatus(302);
});

test('halaman profil dapat diakses oleh Bagian Keuangan', function () {
    $response = $this->get('/keuangan/edit-profile');
    $response->assertStatus(302);
});

test('halaman profil dapat diakses oleh Pemohon Kegiatan', function () {
    $response = $this->get('/pemohon/edit-profile');
    $response->assertStatus(302);
});

test('halaman profil dapat diakses oleh Peserta Kegiatan', function () {
    $response = $this->get('/peserta/edit-profile');
    $response->assertStatus(302);
});
