<?php

namespace App\Filament\Resources\KehadiranResource\Pages;

use App\Filament\Resources\KehadiranResource;
use Filament\Resources\Pages\Page;
use App\Models\Penjadwalan;
use App\Models\Surat;
use App\Models\JamKerja;
use App\Models\Lokasi;
use App\Models\Kehadiran;

class LaporanKehadiran extends Page
{
    protected static string $resource = KehadiranResource::class;

    protected static string $view = 'filament.resources.kehadiran-resource.pages.laporan-kehadiran';

    public $record;
    public $surat;
    public $findlokasi;
    public $findjamkerja;

    public function mount($record)
    {
        // $this->surat = Kehadiran::with(['penjadwalan.surat.lokasi', 'penjadwalan.surat.jamkerja'])->find($record);
        
        // $this->jamkerja = $surat->penjadwalan->surat->jamkerja ?? null;
        // $this->lokasi = $surat->penjadwalan->surat->lokasi ?? null;
        $findkehadiran = Kehadiran::find($record)?->id_penjadwalan;
        $findpenjadwalan = Penjadwalan::find($findkehadiran)?->id_surat;
        $findsurat = Surat::find($findpenjadwalan)?->id_lokasi;
        $this->surat = Surat::find($findpenjadwalan);
        $this->findlokasi = Lokasi::find($findsurat);
        $this->findjamkerja = JamKerja::find($findsurat);
        $this->record = Kehadiran::findOrFail($record);

    }

    public function getHeaderActions(): array
    {
        return [];
    }
}
