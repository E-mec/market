<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProductResource\RelationManagers\ColorRelationManager;
use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\ProductResource\Pages;
use App\Filament\Admin\Resources\ProductResource\RelationManagers;
use App\Filament\Admin\Resources\ProductResource\RelationManagers\SizeRelationManager;
use Filament\Forms\Components\Section;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-folder-arrow-down';

    protected static ?string $navigationGroup = 'Product';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('Product')
                            ->schema([
                                TextInput::make('name')
                                    // ->live()
                                    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                                    ->required(),
                                TextInput::make('slug'),
                                Select::make('category_id')
                                    ->relationship(name: 'category', titleAttribute: 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Select::make('sub_category_id')
                                    ->relationship(name: 'sub_category', titleAttribute: 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Select::make('brand_id')
                                    ->relationship(name: 'brand', titleAttribute: 'name')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                Textarea::make('description')
                                    ->rows(2)
                                    ->cols(3),

                            ]),
                        Tabs\Tab::make('Product Details')
                            ->schema([
                                // Select::make('color_id')
                                //     ->relationship(name: 'color', titleAttribute: 'name')
                                //     ->searchable()
                                //     ->preload()
                                //     ->multiple()
                                //     ->required(),
                                Select::make('range_id')
                                    ->relationship(name: 'range', titleAttribute: 'price_range')
                                    ->searchable()
                                    ->preload()
                                    ->required(),
                                TextInput::make('old_price'),
                                TextInput::make('new_price')->required(),
                                TextInput::make('discount')->disabled(true),
                                TextInput::make('quantity'),
                                Checkbox::make('hot'),
                                Checkbox::make('is_available'),
                                Checkbox::make('trending')
                            ])
                            // ->configure(function () {
                            //     $this->calculateDiscount();
                            // })
                            ,


                        Tabs\Tab::make('Product Image')
                            ->schema([
                                Section::make('Image')
                                    ->relationship('image')
                                    ->schema([

                                        FileUpload::make('image')
                                            ->multiple()
                                            ,
                                    ])
                            ]),
                        Tabs\Tab::make('SEO Tags')
                            ->schema([
                                TextInput::make('meta_title')->required(),
                                TextInput::make('meta_keyword')->required(),
                                Textarea::make('meta_description')
                                    ->rows(2)
                                    ->cols(3)
                                    ->required()
                            ]),
                    ])


                        // TextInput::make('name')
                        //     // ->live()
                        //     ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                        //     ->required(),
                        // TextInput::make('slug'),
                        // Select::make('category_id')
                        //     ->relationship(name: 'category', titleAttribute: 'name')
                        //     ->searchable()
                        //     ->preload()
                        //     ->required(),
                        // Select::make('sub_category_id')
                        //     ->relationship(name: 'sub_category', titleAttribute: 'name')
                        //     ->searchable()
                        //     ->preload()
                        //     ->required(),
                        // Select::make('brand_id')
                        //     ->relationship(name: 'brand', titleAttribute: 'name')
                        //     ->searchable()
                        //     ->preload()
                        //     ->required(),
                        // Textarea::make('description')
                        //     ->rows(2)
                        //     ->cols(3),

                        //     Select::make('range_id')
                        //             ->relationship(name: 'range', titleAttribute: 'price_range')
                        //             ->searchable()
                        //             ->preload()
                        //             ->required(),
                        //         TextInput::make('old_price'),
                        //         TextInput::make('new_price')->required(),
                        //         TextInput::make('discount')->disabled(true),
                        //         TextInput::make('quantity'),
                        //         Checkbox::make('hot'),
                        //         Checkbox::make('is_available'),
                        //         Checkbox::make('trending'),

                        //         // Fieldset::make('ProductImage')
                        //         // ->relationship('image')
                        //         // ->schema([

                        //         //     FileUpload::make('image')
                        //         //         ->multiple(),
                        //         // ]),

                        //                 TextInput::make('meta_title')->required(),
                        //         TextInput::make('meta_keyword')->required(),
                        //         Textarea::make('meta_description')
                        //             ->rows(2)
                        //             ->cols(3)
                        //             ->required()


            ]);
    }

    // protected function calculateDiscount()
    // {
    //     $this->on('new_price.updated', function (Form $form) {
    //         $oldPrice = $form->getRecord()->old_price ?? 0;
    //         $newPrice = $form->getRecord()->new_price ?? 0;

    //         if (!is_numeric($oldPrice) || !is_numeric($newPrice) || $oldPrice <= 0) {
    //             return;
    //         }

    //         $discount = (($oldPrice - $newPrice) / $oldPrice) * 100;
    //         $form->getField('discount')->setValue(number_format($discount, 2) . '%');
    //     });

    //     $this->on('old_price.updated', function (Form $form) {
    //         $oldPrice = $form->getRecord()->old_price ?? 0;
    //         $newPrice = $form->getRecord()->new_price ?? 0;

    //         if (!is_numeric($oldPrice) || !is_numeric($newPrice) || $oldPrice <= 0) {
    //             return;
    //         }

    //         $discount = (($oldPrice - $newPrice) / $oldPrice) * 100;
    //         $form->getField('discount')->setValue(number_format($discount, 2) . '%');
    //     });
    // }

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
            ColorRelationManager::class,
            SizeRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
