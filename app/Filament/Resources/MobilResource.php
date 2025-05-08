<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MobilResource\Pages;
use App\Filament\Resources\MobilResource\RelationManagers;
use App\Models\Mobil;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;


class MobilResource extends Resource
{
    protected static ?string $model = Mobil::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';
    protected static ?string $navigationGroup = 'Surat';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nama')->required(),
                TextInput::make('nopol')->required(),
                TextInput::make('merk')->required(),
                TextInput::make('tipe')->required(),
                TextInput::make('thn_pembuatan')->required(),
                TextInput::make('warna')->required(),
                Select::make('books') // Use the relationship method
                ->relationship('books', 'judul') 
                ->label('Books')
                ->multiple(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('nopol'),
                TextColumn::make('merk'),
                TextColumn::make('tipe'),
                TextColumn::make('thn_pembuatan'),
                TextColumn::make('warna'),
                TextColumn::make('bookTitles') // Add this line
                ->label('Books Assigned')
                ->getStateUsing(fn (Mobil $record) => $record->bookTitles),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListMobils::route('/'),
            'create' => Pages\CreateMobil::route('/create'),
            'edit' => Pages\EditMobil::route('/{record}/edit'),
        ];
    }
}
