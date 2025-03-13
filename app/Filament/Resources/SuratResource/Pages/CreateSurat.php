<?php

namespace App\Filament\Resources\SuratResource\Pages;

use App\Filament\Resources\SuratResource;
use Filament\Actions;
use App\Models\Pengajuan;
use Filament\Resources\Pages\CreateRecord;

class CreateSurat extends CreateRecord
{
    protected static string $resource = SuratResource::class;

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        $pengajuan = Pengajuan::create([
            'tgl_pengajuan'=> $this->record->created_at,
        ]);
        $this->record->update([
            'id_pengajuan' => $pengajuan->id,
        ]);
    }
}
