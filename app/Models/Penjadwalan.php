<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjadwalan extends Model
{
    protected $guarded = [];
 
    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function mobils()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil');
    }

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'id_surat');
    }
}
