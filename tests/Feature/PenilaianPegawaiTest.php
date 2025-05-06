<?php

test('halaman penilaian pegawai dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/penilaian-pegawais');
    $response->assertStatus(302);
});

test('halaman penilaian pegawai dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/penilaian-pegawais');
    $response->assertStatus(302);
});

test('halaman penilaian pegawai dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/penilaian-pegawais');
    $response->assertStatus(302);
});

test('halaman penilaian pegawai dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/penilaian-pegawais');
    $response->assertStatus(302);
});

test('halaman penilaian pegawai dapat diakses oleh Pemohon Kegiatan', function () {
    $response = $this->get('/pemohon/penilaian-pegawais');
    $response->assertStatus(302);
});

test('halaman buat penilaian pegawai dapat diakses oleh Pemohon Kegiatan', function () {
    $response = $this->get('/pemohon/penilaian-pegawais/create');
    $response->assertStatus(302);
});

test('halaman edit penilaian pegawai dapat diakses oleh Pemohon Kegiatan', function () {
    $response = $this->get('/pemohon/penilaian-pegawais/{record}/edit');
    $response->assertStatus(302);
});

test('halaman penilaian pegawai dapat diakses oleh Peserta Kegiatan', function () {
    $response = $this->get('/peserta/penilaian-pegawais');
    $response->assertStatus(302);
});

test('halaman buat penilaian pegawai dapat diakses oleh Peserta Kegiatan', function () {
    $response = $this->get('/peserta/penilaian-pegawais/create');
    $response->assertStatus(302);
});

test('halaman edit penilaian pegawai dapat diakses oleh Peserta Kegiatan', function () {
    $response = $this->get('/peserta/penilaian-pegawais/{record}/edit');
    $response->assertStatus(302);
});
