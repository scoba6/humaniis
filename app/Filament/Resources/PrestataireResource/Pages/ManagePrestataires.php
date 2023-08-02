<?php

namespace App\Filament\Resources\PrestataireResource\Pages;

use App\Filament\Resources\PrestataireResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePrestataires extends ManageRecords
{
    protected static string $resource = PrestataireResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
