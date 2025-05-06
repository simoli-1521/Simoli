<?php

test('halaman mobil dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/mobils');
    $response->assertStatus(302);
});
