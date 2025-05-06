<?php

test('halaman mobil dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/mobils');
    $response->assertStatus(302);
});

test('halaman buat mobil dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/mobils/create');
    $response->assertStatus(302);
});

test('halaman edit mobil dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/mobils/{record}/edit');
    $response->assertStatus(302);
});
