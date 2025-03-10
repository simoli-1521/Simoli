<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Log;

class Kehadiran extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function penjadwalan()
    {
        return $this->belongsTo(Penjadwalan::class, 'id_penjadwalan');
    }

}
