<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function penjadwalan()
    {
        return $this->belongsTo(Penjadwalan::class);
    }
}
