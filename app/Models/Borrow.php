<?php

namespace App\Models;

use Filament\Forms\Components\HasManyRepeater;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Carbon;
class Borrow extends Model
{
    use HasFactory;
    protected $table = 'peminjamans';
    protected $guarded = [];

    public function buku()
    {
        return $this->belongsTo(BookModel::class);
    }

    public static function borrowBook($buku_id, $nama_peminjam, $tgl_tenggat)
    {
        $book = BookModel::find($buku_id);

        if ($book && $book->stok > 0) {
            // Decrease the stock
            $book->stok -= 1;
            $book->save();
            

            // Create a borrow record
            return self::create([
                'buku_id' => $buku_id,
                'nama_peminjam' => $nama_peminjam,
                'tgl_peminjaman' => now(),
                'tgl_tenggat' => $tgl_tenggat,
                
                'status' => 'aktif',
            ]);
        }

        return null; // No stock available
        
    }
    /**
     * Return a book and update the stock.
     */
    public function returnBook($tgl_pengembalian, $kondisi = null)
{
    $book = $this->buku;
    
    if ($book) {
        // Calculate fine based on the condition of the book
        $denda = 0;

        if ($kondisi === 'rusak') {
            // If the book is returned in a damaged state, set the fine to the full price of the book
            $denda = $book->harga_buku;
        } else {
            // Calculate fine if the book is returned late
            $tgl_tenggat = $this->tgl_tenggat;

            if ($tgl_pengembalian > $tgl_tenggat) {
                // Calculate the number of hours late
                $hoursLate = $tgl_pengembalian->diffInHours($tgl_tenggat);
                // Calculate fine: 10% of the book price + 1% for each hour late
                $denda = ($book->harga_buku * 0.10) + ($hoursLate * ($book->harga_buku * 0.01));
            }
        }

        // Increase the stock
        $book->stok += 1;
        
        $book->save();
        $book->increment('jumlah_pinjam');
        

        // Update the borrow record
        $this->update([
            'tgl_pengembalian' => $tgl_pengembalian,
            'status' => 'returned',
            'denda' => $denda,
            'kondisi' => $kondisi,
        ]);
        
    }
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($borrow) {
            // Set the status to 'active' when creating a new borrowing record
            $borrow->status = 'aktif';
            
        

        if (empty($borrow->tgl_peminjaman)) {
            $borrow->tgl_peminjaman = now();
        }
    });

        

        static::retrieved(function ($borrow) {
            $borrow->checkOverdue();
        });

        static::saving(function ($borrow) {
            $borrow->checkOverdue();
        });
    }

    

    public function checkOverdue()
    {
        if ($this->status !== 'returned' && Carbon::now()->greaterThan($this->tgl_tenggat)) {
            $this->status = 'overdue';
            $this->saveQuietly(); // Menghindari infinite loop
        }
    }
}