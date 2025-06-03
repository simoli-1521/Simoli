<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenilaianPegawai extends Model
{
    use HasFactory;

    protected $table = 'penilaian_pegawais';

    
    protected $fillable = [
        'pelapor_id',
        'nama_pegawai',
        'penilaian',
        'skor_penilaian',
        'jenis_insiden',
        'deskripsi',
        'lokasi',
        'anonim',
        'foto_kejadian',
    ];

    /**
     * Get the pelapor that submitted the assessment.
     */
    public function pelapor()
    {
        return $this->belongsTo(User::class, 'pelapor_id');
    }

    /**
     * Get the pegawai being assessed.
     */
   
}