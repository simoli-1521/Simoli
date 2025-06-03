<?php
namespace App\Filament\Resources\BookResource\RelationManagers;

use App\Models\LogBuku;
use Filament\Forms;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Illuminate\Database\Eloquent\Builder;

class LogBukuRelationManager extends RelationManager
{
    protected static string $relationship = 'logBuku'; // Relationship method name in the BookModel

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('alasan')
                    ->label('Alasan')
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('alasan')
                    ->label('Alasan')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Tanggal')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
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
}