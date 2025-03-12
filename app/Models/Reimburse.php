<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reimburse extends Model
{
    // protected $table = 'reimburses';
    protected $guarded = [];
    use HasFactory;

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function bbm()
    {
        return $this->belongsTo(Bbm::class, 'id_bbm');
    }

    public function souvenir()
    {
        return $this->hasMany(Souvenir::class, 'id_reimburses');
    }
}
