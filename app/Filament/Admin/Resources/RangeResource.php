<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Range;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\RangeResource\Pages;
use App\Filament\Admin\Resources\RangeResource\RelationManagers;
use Filament\Forms\Components\TextInput;

class RangeResource extends Resource
{
    protected static ?string $model = Range::class;

    protected static ?string $navigationIcon = 'heroicon-o-banknotes';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Product Settings';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('price_range')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('price_range'),
                TextColumn::make('created_at')
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
            'index' => Pages\ListRanges::route('/'),
            'create' => Pages\CreateRange::route('/create'),
            'edit' => Pages\EditRange::route('/{record}/edit'),
        ];
    }
}
