<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BorrowResource\Pages;
use App\Filament\Exports\BorrowExporter;
use Closure;
use App\Models\BookModel;
use App\Filament\Resources\BorrowResource\RelationManagers;
use App\Models\Borrow;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\ExportAction;

use Filament\Tables\Actions\BulkExportAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BorrowResource extends Resource
{
    protected static ?string $model = Borrow::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $navigationLabel = 'Peminjaman';
    protected static ?string $navigationGroup = 'Perpustakaan Keliling';
    protected static ?string $slug = 'peminjaman-pengembalian';

    

    public static ?string $label = 'Peminjaman Buku';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('buku_id')
                ->label('Buku yang Dipinjam')
                ->relationship('buku', 'judul')
                ->required()
                ->preload()
                ->searchable()
                ->rules([
                    function () {
                        return function (string $attribute, $value, Closure $fail) {
                            $book = BookModel::find($value);
                            if ($book && $book->stok <= 0) {
                                $fail('Buku tidak tersedia untuk dipinjam.');
                            }
                        };
                    },
                ]),
                TextInput::make('nama_peminjam')
                ->required()
                ->label('Nama Peminjam')
                ->placeholder('Masukkan Nama Penulis....'),
                //DateTimePicker::make('tgl_peminjaman')
                //->label('Tanggal Peminjaman')
                //->displayFormat('d/m/Y')
                //->required()
                //->seconds(false),
                DateTimePicker::make('tgl_tenggat')
                ->label('Tanggal Tenggat')
                ->required()
                ->seconds(false),
                

                
            ]);
    }

public static function table(Table $table): Table
{
    return $table
        ->columns([
            TextColumn::make('nama_peminjam')
            ->label('Nama Peminjam')
            ->searchable()
            ->copyable()
            ->sortable(),

            TextColumn::make('buku.judul')
            ->label('Judul Buku')
            ->searchable()
            ->copyable()
            ->sortable(),
            
            TextColumn::make('tgl_peminjaman')
            ->label('Tanggal Peminjaman')
            ->searchable()
            ->copyable()
            ->sortable(),
            TextColumn::make('tgl_tenggat')
            ->label('Tenggat Waktu')
            ->searchable()
            ->copyable()
            ->sortable(),
            TextColumn::make('tgl_pengembalian')
            ->label('Waktu Pengembalian')
            ->searchable()
            ->copyable()
            ->sortable(),
            TextColumn::make('status')
            ->label('Status')
            ->badge()
            ->searchable()
            ->sortable(),

            TextColumn::make('buku.harga_buku')
            ->label('Harga Buku')
            ->money('IDR') // Format as currency
            ->sortable(),
            
            TextColumn::make('denda')
            ->label('Denda')
            ->money('IDR') // Format as currency
            ->sortable(),
        ])
        ->filters([
            //
        ])
        ->actions([
            Tables\Actions\EditAction::make()
            ->disabled(fn (Borrow $record) => $record->status === 'returned')
            ->visible(fn (Borrow $record) => $record->status !== 'returned')
            ->hidden(fn () => !Auth::user()->hasRole('Petugas'))
            ->slideOver(), // Mengubah edit menjadi modal slide over
            Tables\Actions\DeleteAction::make(),
            Tables\Actions\Action::make('return')
            ->label('Pengembalian Buku')
            ->color('success')
            ->visible(fn ($record) => in_array($record->status, ['aktif', 'overdue']))
            ->form([
                Select::make('kondisi')
                    ->label('Kondisi Buku')
                    ->options([
                        'good' => 'Baik',
                        'rusak' => 'Rusak',
                    ])
                    ->required()
                    ->rules('required'),
            ])
            ->action(function ($record, $data) {
                $record->returnBook(now(), $data['kondisi']);
            }),
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ])
        ->headerActions([
            CreateAction::make()
                ->slideOver()
                ->label('Tambah Peminjaman')
                ->mutateFormDataUsing(function (array $data): array {
                    $data['tgl_peminjaman'] = now();
                    return $data;
                }),
            ]);
        
}

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBorrows::route('/'),
            //'create' => Pages\CreateBorrow::route('/create'),
            'edit' => Pages\EditBorrow::route('/{record}/edit'),
        ];
    }
}
