<?php

namespace App\Filament\Resources\FormuleResource\Pages;

use App\Filament\Resources\FormuleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormule extends EditRecord
{
    protected static string $resource = FormuleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
