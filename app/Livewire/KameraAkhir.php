<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KameraAkhir extends Component
{
    use WithFileUploads;

    public $photo;
    public $cameraActive = false;
    public $selectedDeviceId = null;
    public $devices = [];
    public $flashActive = false;
    public $photoPath = null;
    public $photoDataUrl = null;

    public function mount()
    {
        // Initialize with any existing photo path
        if (request()->has('photo_path') && !empty(request()->get('photo_path'))) {
            $this->photoPath = request()->get('photo_path');
        }
    }

    public function toggleCamera()
    {
        $this->cameraActive = !$this->cameraActive;
    }

    public function toggleFlash()
    {
        $this->flashActive = !$this->flashActive;
    }

    public function switchCamera($deviceId)
    {
        $this->selectedDeviceId = $deviceId;
    }

    public function capturePhoto($dataUrl)
    {
        $this->photoDataUrl = $dataUrl;
        $this->cameraActive = false;
    }

    public function retakePhoto()
    {
        $this->photoDataUrl = null;
        $this->cameraActive = true;
    }

    public function savePhoto()
    {
        if (!$this->photoDataUrl) {
            return;
        }

        // Remove header from base64 data
        $base64_str = substr($this->photoDataUrl, strpos($this->photoDataUrl, ",") + 1);
        
        $decoded = base64_decode($base64_str);
        
        // Generate unique filename
        $filename = 'attendance_photos/' . Str::uuid() . '.jpg';
        
        // Store the image
        Storage::disk('public')->put($filename, $decoded);
        
        // Save the path to be used by the form
        $this->photoPath = $filename;
        
        // Emit event to update the hidden input in the Filament form
        $this->dispatch('photo-captured', path: $this->photoPath);
    }

    public function render()
    {
        return view('livewire.kamera-akhir');
    }
}