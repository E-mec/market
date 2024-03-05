<?php

namespace App\Filament\Admin\Resources\ProductImageResource\Pages;

use App\Filament\Admin\Resources\ProductImageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProductImage extends CreateRecord
{
    protected static string $resource = ProductImageResource::class;
}
