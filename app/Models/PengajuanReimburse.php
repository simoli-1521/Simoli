<?php

namespace App\Models;

use App\Models\Reimburse;
use App\Models\PengajuanReimburse;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengajuanReimburse extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'pengajuan_reimburses';

    public function reimburse()
    {
        return $this->hasOne(Reimburse::class, 'reimburse_id', 'id');
    }
}
