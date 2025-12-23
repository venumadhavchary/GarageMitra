<?php

namespace App\Filament\Resources\Jobcards;

use App\Filament\Resources\Jobcards\Pages\CreateJobcard;
use App\Filament\Resources\Jobcards\Pages\EditJobcard;
use App\Filament\Resources\Jobcards\Pages\ListJobcards;
use App\Filament\Resources\Jobcards\Schemas\JobcardForm;
use App\Filament\Resources\Jobcards\Tables\JobcardsTable;
use App\Models\Jobcard;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobcardResource extends Resource
{
    protected static ?string $model = Jobcard::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Jobcards';

    public static function form(Schema $schema): Schema
    {
        return JobcardForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobcardsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJobcards::route('/'),
            'create' => CreateJobcard::route('/create'),
            'edit' => EditJobcard::route('/{record}/edit'),
        ];
    }
}
