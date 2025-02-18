<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $guarded = [];

    public function jam_kerja()
    {
        return $this->belongsTo(JamKerja::class);
    }
}
