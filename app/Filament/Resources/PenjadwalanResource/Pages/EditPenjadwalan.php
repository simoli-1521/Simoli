<?php

namespace App\Filament\Resources\PenjadwalanResource\Pages;

use App\Filament\Resources\PenjadwalanResource;
use Filament\Actions;
use App\Models\Kehadiran;
use Filament\Resources\Pages\EditRecord;

class EditPenjadwalan extends EditRecord
{
    protected static string $resource = PenjadwalanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Runs after the form fields are saved to the database.
        Kehadiran::updateOrCreate([
            'id_user'=> $this->record->id_user,
            'id_penjadwalan'=> $this->record->id,
        ],
        [
            'updated_at' => now(), // Update timestamp or other fields if needed
        ]);
    }
}
