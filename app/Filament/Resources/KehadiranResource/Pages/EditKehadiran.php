<?php

namespace App\Filament\Resources\KehadiranResource\Pages;

use App\Filament\Resources\KehadiranResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Livewire\TemporaryUploadedFile;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;

class EditKehadiran extends EditRecord
{
    protected static string $resource = KehadiranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function beforeValidate(): void
    {
        $data = $this->data;

        $attendanceLat = $data['jadwal_lokasi_peta_latitude'];
        $attendanceLng = $data['jadwal_lokasi_peta_longtitude'];
        $userLat = $data['lokasi_peta_latitude'];
        $userLng = $data['lokasi_peta_longtitude'];
        $radius = $data['jadwal_lokasi_peta_radius'];

        $jadwalMulai = strtotime($data['jadwal_waktu_mulai']);
        $jadwalSelesai = strtotime($data['jadwal_waktu_selesai']);
        $waktuMulaiStatus = $data['waktu_mulai_status'];

        $isWithinArea = self::haversineDistance(
            $attendanceLat, $attendanceLng,
            $userLat, $userLng, $radius
        );

        if (!$waktuMulaiStatus) {
            if (time() < $jadwalMulai - 3600) {
                return; // Too early, do nothing
            }        
    
            if ($isWithinArea) {
                $this->data['waktu_mulai'] = now()->format('Y-m-d H:i:s');
                $this->data['waktu_mulai_status'] =
                    time() >= strtotime($jadwalMulai) ? 'Telat' : 'Hadir';
            }else {
                Notification::make()
                    ->title('Tidak bisa presensi karena diluar area kehadiran!')
                    ->danger()
                    ->send();
    
                // Optionally stop save by throwing:
                $this->halt(); // stop save process
            }
        }else{
            if (time() < $jadwalSelesai) {
                return; // Too early, do nothing
            }        
    
            if ($isWithinArea) {
                $this->data['waktu_selesai'] = now()->format('Y-m-d H:i:s');
                $this->data['waktu_selesai_status'] =
                    time() > strtotime($jadwalSelesai) + 3600 ? 'Telat' : 'Hadir';
            }else {
                Notification::make()
                    ->title('Tidak bisa presensi karena diluar area kehadiran!')
                    ->danger()
                    ->send();
    
                // Optionally stop save by throwing:
                $this->halt(); // stop save process
            }
        }

        
    }

    public static function haversineDistance($lat1, $lng1, $lat2, $lng2, $radius)
    {
        $earthRadius = 6371000; // Radius of Earth in meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLng / 2) * sin($dLng / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c; // Distance in meters
        return $distance <= $radius;
    }
}
