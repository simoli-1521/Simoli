<?php

namespace App\Filament\Resources\PenjadwalanResource\Pages;

use App\Filament\Resources\PenjadwalanResource;
use Filament\Actions;
use App\Models\Kehadiran;
use Filament\Resources\Pages\CreateRecord;

class CreatePenjadwalan extends CreateRecord
{
    protected static string $resource = PenjadwalanResource::class;

    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        Kehadiran::create([
            'id_user'=> $this->record->id_user,
            'id_penjadwalan'=> $this->record->id,
        ]);
    }
}
