<?php

namespace App\Filament\Resources\Mechanics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MechanicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('specialization')
                    ->default(null),
                TextInput::make('phone')
                    ->tel()
                    ->default(null),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
            ]);
    }
}
