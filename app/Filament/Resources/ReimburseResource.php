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
                Select::make('id_bbm')
                    ->relationship('bbm', 'tgl_pengisian'),
                Select::make('id_souvenir')
                    ->relationship('souvenir', 'nama'),
                DateTimePicker::make('tgl_pengajuan'),
                DateTimePicker::make('tgl_diterima'),
                DateTimePicker::make('tgl_ditolak'),
                TextInput::make('status'),
                TextInput::make('biaya')->numeric(),
                Radio::make('jenis_reimburse')
                    ->options([
                        'bbm' => 'BBM',
                        'souvenir' => 'Souvenir',
                    ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
