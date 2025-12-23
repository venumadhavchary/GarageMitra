<?php

namespace App\Filament\Resources\Jobcards\Pages;

use App\Filament\Resources\Jobcards\JobcardResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditJobcard extends EditRecord
{
    protected static string $resource = JobcardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
