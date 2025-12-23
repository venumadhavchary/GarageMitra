<?php

namespace App\Filament\Resources\Mechanics\Pages;

use App\Filament\Resources\Mechanics\MechanicResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMechanic extends EditRecord
{
    protected static string $resource = MechanicResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
