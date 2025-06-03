<?php

namespace App\Filament\Resources;

use App\Models\LogBuku;
use App\Models\KategoriBuku;
use Filament\Forms\Components\Textarea;
use App\Filament\Resources\BookResource\Pages\PopularBooks;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\BookResource\RelationManagers\LogBukuRelationManager;
use App\Filament\Resources\BookResource\RelationManagers\BookRequestsRelationManager;
use App\Filament\Resources\BookResource\Pages;
use App\Filament\Resources\BookResource\RelationManagers;
use App\Models\Book;
use App\Models\BookModel;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Forms\Components\CheckboxList;
use DesignTheBox\BarcodeField\Forms\Components\BarcodeInput;
use App\Filament\Forms\Components\IsbnScannerField;
use Filament\Forms\Components\Section;
use Illuminate\Support\Facades\Auth;

class BookResource extends Resource
{
    protected static ?string $model = BookModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationLabel = 'Buku yang Ada';
    protected static ?string $navigationGroup = 'Perpustakaan Keliling';
    protected static ?string $slug = 'perpustakaan';

    public static ?string $label = 'Buku Yang Ada';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('ISBN Scanner')
                    ->description('Scan or search for a book by ISBN')
                    ->schema([
                        IsbnScannerField::make('scanner')
                            ->label('Scan ISBN')
                            ->columnSpan(2),
                    ])
                    ->collapsible(),

                
                Section::make('Informasi Buku')
                ->schema([
                Hidden::make('id_permintaan'),

                TextInput::make('judul')
                ->required()
                ->label('Judul Buku')
                ->placeholder('Masukkan Judul Buku....'),
                TextInput::make('penulis')
                ->required()
                ->label('Penulis/Author Buku')
                ->placeholder('Masukkan Nama Penulis....'),
                FileUpload::make('sampul_buku')
                    ->label('Cover Buku')
                    ->helperText('Unggah foto cover buku')
                    ->image()
                    ->imageResizeMode('cover')
                    
                    ->directory('fotocover')
                    ->visibility('public')
                    ->maxSize(5120) // 5MB
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/jpg', 'image/webp']),
                TextInput::make('kode_buku')
                ->required()
                ->numeric()
                ->label('Kode ISBN')
                ->placeholder('Masukkan Kode Buku....'),
                Select::make('kategori') 
                ->label('Kategori Buku')
                ->multiple()
                ->relationship('kategori', 'nama_kategori')
                ->preload(),
                TextInput::make('penerbit')
                ->required()
                ->label('Nama Penerbit')
                ->placeholder('Masukkan Nama Penerbit...'),
                TextInput::make('tahun_terbit')
                ->required()
                ->numeric()
                ->minValue(1850)
                ->maxValue(2100)
                ->label('Tahun Terbit')
                ->placeholder('Masukkan Tahun Terbit Buku...'),
                TextInput::make('stok')
                ->required()
                ->numeric()
                ->label('Stok Buku')
                ->placeholder('Masukkan Jumlah Stok....'),
                TextInput::make('harga_buku') 
                ->required()
                ->numeric()
                ->label('Harga Buku')
                ->placeholder('Masukkan Harga Buku....')
                ->prefix('IDR'),

            ]),
            CheckboxList::make('mobil') 
                ->relationship('mobil', 'nopol') 
                ->label('Mobil yang diregistrasikan'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('judul')
                ->label('Judul Buku')
                ->searchable()
                ->copyable()
                ->sortable(),

                ImageColumn::make('sampul_buku')
                    ->disk('public')
                    ->label('Cover Buku')
                    ->defaultImageUrl(url('/storage/copanya.jpg')) 
                    ->extraImgAttributes(['loading' => 'lazy'])
                    ->visibility('public'),

                TextColumn::make('penulis')
                ->searchable()
                ->copyable()
                ->sortable(),
                TextColumn::make('kode_buku')
                ->label('ISBN')
                ->searchable()
                ->copyable()
                ->sortable(),
                TextColumn::make('kategori.nama_kategori') // Display the category names
                ->label('Kategori')
                ->badge()
                ->searchable()
                ->sortable(),
                TextColumn::make('penerbit')
                ->searchable()
                ->copyable()
                ->sortable(),
                TextColumn::make('tahun_terbit')
                ->searchable()
                ->copyable()
                ->sortable(),
                TextColumn::make('stok')
                ->searchable()
                ->sortable(),

                TextColumn::make('harga_buku') 
                ->label('Harga Buku')
                ->money('IDR') // Format as currency
                ->sortable(),
                
                TextColumn::make('logBukuCount') // New column for log count
                ->label('Log Count')
                ->sortable()
                ->formatStateUsing(fn ($state) => $state ?? 0) // Format to show 0 if null
                ->getStateUsing(function (BookModel $record) {
                    return $record->logBuku()->count();
                }),

                TextColumn::make('from_request')
                    ->label('Dari Request')
                    ->getStateUsing(fn (BookModel $record) => $record->id_permintaan ? 'Yes' : 'No')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => $state === 'Yes' ? 'success' : 'gray'),
                
            ])
            ->filters([
                SelectFilter::make('kategori')
                ->label('Kategori Buku')
                ->relationship('kategori', 'nama_kategori'),
                TernaryFilter::make('from_request')
                    ->label('From Request')
                    ->queries(
                        true: fn (Builder $query) => $query->whereNotNull('id_permintaan'),
                        false: fn (Builder $query) => $query->whereNull('id_permintaan'),
                    ),
            ])
            ->headerActions([
                Action::make('add_genre')
                    ->label('Tambah Genre Baru')
                    ->icon('heroicon-o-plus-circle')
                    ->color('success')
                    ->slideOver()
                    ->modalHeading('Tambah Genre Buku Baru')
                    ->modalDescription('Tambahkan genre/kategori buku baru yang akan tersedia untuk semua buku.')
                    ->form([
                        TextInput::make('nama_kategori')
                            ->label('Nama Genre')
                            ->required()
                            ->maxLength(30),
                        Textarea::make('deskripsi_kategori')
                            ->label('Deskripsi')
                            ->required(),
                    ])
                    ->action(function (array $data): void {
                        $kategori = KategoriBuku::create([
                            'nama_kategori' => $data['nama_kategori'],
                            'deskripsi_kategori' => $data['deskripsi_kategori'],
                        ]);

                        Notification::make()
                            ->title('Genre buku berhasil ditambahkan')
                            ->success()
                            ->body('Genre "' . $kategori->nama_kategori . '" telah berhasil ditambahkan ke database.')
                            ->send();
                    })
                    ->hidden(fn () => !Auth::user()->hasAnyRole(['Admin', 'Petugas']))
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Action::make('decreaseStock')
                ->label('Kurangi Stok')
                ->color('danger')
                ->icon('heroicon-o-minus')
                ->form([
                    Forms\Components\TextInput::make('alasan')
                        ->label('Alasan Pengurangan Stok')
                        ->required(),
                ])
                ->action(function (BookModel $record, array $data) {
                    if ($record->stok <= 0) {
                        Notification::make()
                            ->title('Buku tidak tersedia')
                            ->danger()
                            ->send();
                        return;
                    }

                    // Decrease the stock
                    $record->stok -= 1;
                    $record->save();

                    // Log the reason using the LogBuku model
                    LogBuku::create([
                        'buku_id' => $record->id,
                        'alasan' => $data['alasan'],
                    ]);

                    Notification::make()
                        ->title('Stok Berhasil Dikurangkan')
                        ->success()
                        ->send();
                })
                ->requiresConfirmation()
                ->modalHeading('Kurangi Stok')
                ->modalDescription('Apakah anda yakin?')
                ->modalSubmitActionLabel('Iya, kurangi stok.'),

                Action::make('viewRequest')
                    ->label('View Request')
                    ->icon('heroicon-o-eye')
                    ->url(fn (BookModel $record) => $record->id_permintaan
                        ? BookRequestResource::getUrl('edit', ['record' => $record->id_permintaan]) 
                        : null)
                    ->openUrlInNewTab()
                    ->visible(fn (BookModel $record) => !empty($record->id_permintaan)),
            ])
            
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            LogBukuRelationManager::class,
            BookRequestsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBooks::route('/'),
            'create' => Pages\CreateBook::route(path: '/create'),
            'edit' => Pages\EditBook::route('/{record}/edit'),
            
        ];
    }
}