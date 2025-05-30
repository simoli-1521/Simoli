<?php

namespace App\Filament\Resources\ReimburseResource\Pages;

use App\Filament\Resources\ReimburseResource;
use App\Models\PengajuanReimburse;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReimburse extends CreateRecord
{
    protected static string $resource = ReimburseResource::class;

    // public static function beforeCreate(): void
    // {
    //     $record->tgl_pengajuan = now()->format('Y-m-d H:i:s');
    // }
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['tgl_pengajuan'] = now()->format('Y-m-d H:i:s'); // Assign current timestamp
        return $data;
    }
    protected function afterCreate(): void
    {
        // Runs after the form fields are saved to the database.
        $pengajuanreimburse = PengajuanReimburse::create([
            'tgl_pengajuan'=> $this->record->created_at,
        ]);
        $this->record->update([
            'pengajuanreimburse_id' => $pengajuanreimburse->id,
        ]);
    }
}
