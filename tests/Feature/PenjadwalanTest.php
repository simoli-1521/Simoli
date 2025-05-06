<?php

test('halaman penjadwalan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/penjadwalans');
    $response->assertStatus(302);
});

test('halaman buat penjadwalan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/penjadwalans/create');
    $response->assertStatus(302);
});

test('halaman edit penjadwalan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/penjadwalans/{record}/edit');
    $response->assertStatus(302);
});
