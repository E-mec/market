<?php

namespace App\Filament\Admin\Resources\ProductImageResource\Pages;

use App\Filament\Admin\Resources\ProductImageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProductImage extends EditRecord
{
    protected static string $resource = ProductImageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
