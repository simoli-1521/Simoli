<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Surat;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TimePicker;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengajuan;
use App\Filament\Resources\SuratResource\Pages;
use Dotswan\MapPicker\Fields\Map;

class SuratResource extends Resource
{
    protected static ?string $model = Surat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Informasi Jam Kerja')
                    ->schema([
                        Group::make()->relationship('jamkerja')
                            ->schema([
                                DatePicker::make('tgl')->label('Tanggal'),
                                TimePicker::make('jam_mulai')->label('Jam Mulai'),
                                TimePicker::make('jam_akhir')->label('Jam Akhir'),
                            ]),
                    ]),

                Section::make('Detail Lokasi')
                    ->schema([
                        Group::make()->relationship('lokasi')
                            ->schema([
                                TextInput::make('nama_lokasi')->label('Nama Lokasi'),
                                Map::make('lokasi_peta')
                                ->disabled()
                                ->columnSpanFull()
                                ->defaultLocation(latitude: -7.0530, longitude: 110.4092)
                                ->rangeSelectField('radius')
                                ->showMarker(true)
                                // ->dehydrated(false)
                                ->showFullscreenControl(false)
                                ->afterStateHydrated(function ($state, $record, Forms\Set $set): void {
                                    $lats = $record?->latitude;
                                    $lngs = $record?->longtitude;
                                    $set('lokasi_peta', ['lat' => $lats, 'lng' => $lngs]);
                                })
                                ->afterStateUpdated(function (Forms\Set $set, $state): void {
                                    $set('latitude', $state['lat']);
                                    $set('longtitude', $state['lng']);
                                }),
                                TextInput::make('latitude')->numeric()->readonly()->label('Latitude'),
                                TextInput::make('longtitude')->numeric()->readonly()->label('Longtitude'),
                                TextInput::make('radius')->numeric()->label('Radius (Meter)'),
                            ]),
                    ]),

                Section::make('Detail Surat')
                    ->schema([
                        TextInput::make('nomor_surat')->label('Nomor Surat')->required(),
                        TextInput::make('nama_kegiatan')->label('Nama Kegiatan')->required(),
                        TextInput::make('nama_PJ')->label('Nama Penanggung Jawab')->required(),
                        TextInput::make('jabatan_PJ')->label('Jabatan Penanggung Jawab')->required(),
                        FileUpload::make('ttd_PJ')
                            ->label('Tanda Tangan PJ')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('ttd_PJ')
                            ->visibility('public'),
                        TextInput::make('narahubung')->label('Narahubung')->required(),
                        FileUpload::make('qr_validasi')
                            ->label('QR Validasi')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('qr_validasi')
                            ->visibility('public'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('jamkerja.tgl')->label('Tanggal'),
                TextColumn::make('jamkerja.jam_mulai')->label('Jam Mulai'),
                TextColumn::make('jamkerja.jam_akhir')->label('Jam Akhir'),
                TextColumn::make('lokasi.nama_lokasi')->label('Lokasi'),
                TextColumn::make('lokasi.latitude')->label('Latitude'),
                TextColumn::make('lokasi.longtitude')->label('Longtitude'),
                TextColumn::make('lokasi.radius')->label('Radius'),
                TextColumn::make('nomor_surat')->label('Nomor Surat'),
                TextColumn::make('nama_kegiatan')->label('Nama Kegiatan'),
                TextColumn::make('nama_PJ')->label('Penanggung Jawab'),
                TextColumn::make('jabatan_PJ')->label('Jabatan PJ'),
                ImageColumn::make('ttd_PJ')->disk('public')->label('Tanda Tangan PJ'),
                TextColumn::make('narahubung')->label('Narahubung'),
                ImageColumn::make('qr_validasi')->disk('public')->label('QR Validasi'),
                TextColumn::make('pengajuan.status_admin')->label('Status Pengajuan Admin'),
                TextColumn::make('pengajuan.status_sekdin')->label('Status Pengajuan Sekdin'),
                TextColumn::make('pengajuan.status_kadin')->label('Status Pengajuan Kadin'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('Pengajuan Admin')
                    ->form(fn ($record) =>[
                        Select::make('status')
                        ->reactive()
                        ->options([
                            'Diterima Admin' => 'Diterima',
                            'Ditolak Admin' => 'Ditolak',
                        ])->default(optional($record->pengajuan)->status_admin),
                        DateTimePicker::make('tgl_diterima')
                        ->readonly()
                        ->formatstateusing(fn ($state) => $state ?? now()->format('Y-m-d H:i:s'))
                        ->hidden(fn (callable $get) => $get('status') !== 'Diterima Admin')->default(optional($record->pengajuan)->tgl_diterima_admin),
                        DateTimePicker::make('tgl_ditolak')
                        ->readonly()
                        ->formatstateusing(fn ($state) => $state ?? now()->format('Y-m-d H:i:s'))
                        ->hidden(fn (callable $get) => $get('status') !== 'Ditolak Admin')->default(optional($record->pengajuan)->tgl_ditolak_admin),
                        TextInput::make('keterangan')->default(optional($record->pengajuan)->keterangan_admin),
                    ])
                    ->action(function ($record, $data) {
                        Pengajuan::updateOrCreate(
                            ['id' => $record->id_pengajuan],
                            [
                            'tgl_pengajuan'=> $record->created_at,
                            'status_admin'=> $data['status'],
                            'tgl_diterima_admin'=> $data['tgl_diterima']?? null,
                            'tgl_ditolak_admin'=> $data['tgl_ditolak']?? null,
                            'keterangan_admin'=> $data['keterangan']?? null,
                        ]);
                    })->hidden(fn ($record) => !Auth::user()->hasRole('Admin')),
                Tables\Actions\Action::make('Pengajuan Sekdin')
                ->form(fn ($record) =>[
                    Select::make('status')
                    ->reactive()
                    ->options([
                        'Diterima Sekdin' => 'Diterima',
                        'Ditolak Sekdin' => 'Ditolak',
                    ])->default(optional($record->pengajuan)->status_sekdin),
                    DateTimePicker::make('tgl_diterima')
                    ->readonly()
                    ->formatstateusing(fn ($state) => $state ?? now()->format('Y-m-d H:i:s'))
                    ->hidden(fn (callable $get) => $get('status') !== 'Diterima Sekdin')->default(optional($record->pengajuan)->tgl_diterima_sekdin),
                    DateTimePicker::make('tgl_ditolak')
                    ->readonly()
                    ->formatstateusing(fn ($state) => $state ?? now()->format('Y-m-d H:i:s'))
                    ->hidden(fn (callable $get) => $get('status') !== 'Ditolak Sekdin')->default(optional($record->pengajuan)->tgl_ditolak_sekdin),
                    TextInput::make('keterangan')->default(optional($record->pengajuan)->keterangan_sekdin),
                ])
                ->action(function ($record, $data) {
                    Pengajuan::updateOrCreate(
                        ['id' => $record->id_pengajuan],
                        [
                        'tgl_pengajuan'=> $record->created_at,
                        'status_sekdin'=> $data['status'],
                        'tgl_diterima_sekdin'=> $data['tgl_diterima']?? null,
                        'tgl_ditolak_sekdin'=> $data['tgl_ditolak']?? null,
                        'keterangan_sekdin'=> $data['keterangan']?? null,
                    ]);
                })->hidden(fn ($record) => !Auth::user()->hasRole('Sekretaris Dinas') || optional($record->pengajuan)->status_admin !== 'Diterima Admin'),
                Tables\Actions\Action::make('Pengajuan Kadin')
                ->form(fn ($record) =>[
                    Select::make('status')
                    ->reactive()
                    ->options([
                        'Diterima Kadin' => 'Diterima',
                        'Ditolak Kadin' => 'Ditolak',
                    ])->default(optional($record->pengajuan)->status_kadin),
                    DateTimePicker::make('tgl_diterima')
                    ->readonly()
                    ->formatstateusing(fn ($state) => $state ?? now()->format('Y-m-d H:i:s'))
                    ->hidden(fn (callable $get) => $get('status') !== 'Diterima Kadin')->default(optional($record->pengajuan)->tgl_diterima_kadin),
                    DateTimePicker::make('tgl_ditolak')
                    ->readonly()
                    ->formatstateusing(fn ($state) => $state ?? now()->format('Y-m-d H:i:s'))
                    ->hidden(fn (callable $get) => $get('status') !== 'Ditolak Kadin')->default(optional($record->pengajuan)->tgl_ditolak_kadin),
                    TextInput::make('keterangan')->default(optional($record->pengajuan)->keterangan_kadin),
                ])
                ->action(function ($record, $data) {
                    Pengajuan::updateOrCreate(
                        ['id' => $record->id_pengajuan],
                        [
                        'tgl_pengajuan'=> $record->created_at,
                        'status_kadin'=> $data['status'],
                        'tgl_diterima_kadin'=> $data['tgl_diterima']?? null,
                        'tgl_ditolak_kadin'=> $data['tgl_ditolak']?? null,
                        'keterangan_kadin'=> $data['keterangan']?? null,
                    ]);
                })->hidden(fn ($record) => !Auth::user()->hasRole('Kepala Dinas') || optional($record->pengajuan)->status_admin !== 'Diterima Admin'|| optional($record->pengajuan)->status_sekdin !== 'Diterima Sekdin'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
}
