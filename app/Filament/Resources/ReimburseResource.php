<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReimburseResource\Pages;
use App\Filament\Resources\ReimburseResource\RelationManagers;
use App\Models\Reimburse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Tables\Columns\TextColumn;



class ReimburseResource extends Resource
{
    protected static ?string $model = Reimburse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_user')
                    ->relationship('users', 'name'),
                // Select::make('id_bbm')
                //     ->relationship('bbm', 'tgl_pengisian'),
                // Select::make('id_souvenir')
                //     ->relationship('souvenir', 'nama'),
                Radio::make('jenis_reimburse')
                ->options([
                    'bbm' => 'BBM',
                    'souvenir' => 'Souvenir',
                ])
                ->reactive(),

                // Fields for Option 1
                Section::make('BBM')
                ->schema([
                    Group::make()->relationship('bbm')
                    ->schema([
                        // Hidden::make('bbm.id'),
                        DateTimePicker::make('tgl_pengisian'),
                        TextInput::make('jml_liter')->numeric(),
                        TextInput::make('harga')->numeric(),
                    ]),
                ])
                ->hidden(fn (callable $get) => $get('jenis_reimburse') !== 'bbm'),

                // Fields for Option 2
                Section::make('Souvenir')
                ->schema([
                    Group::make()->relationship('souvenir')
                    ->schema([
                        // Hidden::make('souvenir.id'),
                        TextInput::make('nama'),
                        TextInput::make('jenis'),
                        TextInput::make('merk'),
                        TextInput::make('stok')->numeric(),
                        TextInput::make('harga')->numeric(),
                    ]),
                ])
                ->hidden(fn (callable $get) => $get('jenis_reimburse') !== 'souvenir'),
                DateTimePicker::make('tgl_pengajuan'),
                DateTimePicker::make('tgl_diterima'),
                DateTimePicker::make('tgl_ditolak'),
                Select::make('status')
                ->options([
                    'diterima' => 'Diterima',
                    'ditolak' => 'Dtolak',
                ]),
                TextInput::make('biaya')->numeric(),
                
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('users.name'),
                TextColumn::make('jenis_reimburse'),
                TextColumn::make('tgl_pengajuan'),
                TextColumn::make('status'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReimburses::route('/'),
            'create' => Pages\CreateReimburse::route('/create'),
            'edit' => Pages\EditReimburse::route('/{record}/edit'),
        ];
    }
}
