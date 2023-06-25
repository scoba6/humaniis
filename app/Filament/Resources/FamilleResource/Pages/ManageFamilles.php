<?php

namespace App\Filament\Resources\FamilleResource\Pages;

use App\Filament\Resources\FamilleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageFamilles extends ManageRecords
{
    protected static string $resource = FamilleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
