<?php

namespace App\Models;

use App\Models\Kehadiran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Izin extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'izins';

    public function kehadiran()
    {
        return $this->hasOne(Kehadiran::class, 'izin_id', 'id');
    }
}
