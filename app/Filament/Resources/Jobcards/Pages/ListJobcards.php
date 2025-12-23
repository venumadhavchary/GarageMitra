<?php

namespace App\Filament\Resources\Jobcards\Pages;

use App\Filament\Resources\Jobcards\JobcardResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListJobcards extends ListRecords
{
    protected static string $resource = JobcardResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
