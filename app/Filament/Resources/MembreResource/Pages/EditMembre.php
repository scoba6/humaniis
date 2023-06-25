<?php

namespace App\Filament\Resources\MembreResource\Pages;

use App\Filament\Resources\MembreResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMembre extends EditRecord
{
    protected static string $resource = MembreResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}