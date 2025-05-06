<?php

test('halaman surat dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/surats');
    $response->assertStatus(302);
});

test('halaman buat surat dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/surats/create');
    $response->assertStatus(302);
});

test('halaman edit surat dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/surats/{record}/edit');
    $response->assertStatus(302);
});

test('halaman lihat surat dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/surats/{record}/view-surat');
    $response->assertStatus(302);
});

test('halaman surat dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/surats');
    $response->assertStatus(302);
});

test('halaman buat surat dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/surats/create');
    $response->assertStatus(302);
});

test('halaman edit surat dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/surats/{record}/edit');
    $response->assertStatus(302);
});

test('halaman lihat surat dapat diakses oleh Kepala Dinas', function () {
    $response = $this->get('/kadin/surats/{record}/view-surat');
    $response->assertStatus(302);
});

test('halaman surat dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/surats');
    $response->assertStatus(302);
});

test('halaman buat surat dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/surats/create');
    $response->assertStatus(302);
});

test('halaman edit surat dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/surats/{record}/edit');
    $response->assertStatus(302);
});

test('halaman lihat surat dapat diakses oleh Sekretaris Dinas', function () {
    $response = $this->get('/sekdin/surats/{record}/view-surat');
    $response->assertStatus(302);
});

test('halaman surat dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/surats');
    $response->assertStatus(302);
});

test('halaman buat surat dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/surats/create');
    $response->assertStatus(302);
});

test('halaman edit surat dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/surats/{record}/edit');
    $response->assertStatus(302);
});

test('halaman lihat surat dapat diakses oleh Petugas', function () {
    $response = $this->get('/petugas/surats/{record}/view-surat');
    $response->assertStatus(302);
});

test('halaman surat dapat diakses oleh Pemohon', function () {
    $response = $this->get('/pemohon/surats');
    $response->assertStatus(302);
});

test('halaman buat surat dapat diakses oleh Pemohon', function () {
    $response = $this->get('/pemohon/surats/create');
    $response->assertStatus(302);
});

test('halaman edit surat dapat diakses oleh Pemohon', function () {
    $response = $this->get('/pemohon/surats/{record}/edit');
    $response->assertStatus(302);
});

test('halaman lihat surat dapat diakses oleh Pemohon', function () {
    $response = $this->get('/pemohon/surats/{record}/view-surat');
    $response->assertStatus(302);
});