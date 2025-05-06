<?php

test('halaman penjadwalan dapat diakses oleh Admin', function () {
    $response = $this->get('/admin/penjadwalans');
    $response->assertStatus(302);
});
