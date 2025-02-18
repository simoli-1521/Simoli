<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reimburse extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function bbm()
    {
        return $this->belongsTo(BBM::class);
    }

    public function souvenir()
    {
        return $this->belongsTo(Souvenir::class);
    }
}
