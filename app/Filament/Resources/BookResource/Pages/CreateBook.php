<?php

namespace App\Filament\Resources\BookResource\Pages;

use App\Filament\Resources\BookResource;
use App\Models\BookRequest;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Model;

class CreateBook extends CreateRecord
{
    protected static string $resource = BookResource::class;

    /**
     * Mount the component and pre-fill the form if request_id is provided
     */
    public function mount(): void
    {
        
        parent::mount();
        
        
        $requestId = request()->get('id_permintaan');
        
        if ($requestId) {
            $bookRequest = BookRequest::find($requestId);
            
            if ($bookRequest && $bookRequest->isApproved()) {
                // Fill the form with data from the request
                $this->form->fill([
                    'id_permintaan' => $requestId,
                    'judul' => $bookRequest->judul,
                    'penulis' => $bookRequest->penulis,
                    'kode_buku' => $bookRequest->kode_buku,
                    'penerbit' => $bookRequest->penerbit,
                    'tahun_terbit' => $bookRequest->tahun_terbit,
                    // Default values for required fields that may not be in the request
                    'stok' => 1,
                    'harga_buku' => 0, // Set a default or require user input
                ]);
            }
        }
    }

    /**
     * Handle after-creation logic, marking the request as processed
     */
    protected function afterCreate(): void
    {
        // Check if this book was created from a request
        $requestId = request()->get('id_permintaan');
        
        if ($requestId) {
            $bookRequest = BookRequest::find($requestId);
            
            if ($bookRequest) {
                // Connect the book to the request
                $this->record->id_permintaan = $requestId;
                $this->record->save();
                
                // Send notification
                Notification::make()
                    ->title('Book added to library from approved request')
                    ->success()
                    ->send();
            }
        }
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}