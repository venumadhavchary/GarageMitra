<?php

namespace App\Filament\Resources\Vehicles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VehicleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('user_id')
                    ->required(),
                TextInput::make('vehicle_number')
                    ->required(),
                TextInput::make('make')
                    ->required(),
                TextInput::make('model')
                    ->required(),
                TextInput::make('fuel_type')
                    ->required(),
                TextInput::make('vehicle_type')
                    ->required()
                    ->default('bike'),
                FileUpload::make('vehicle_image')
                    ->image(),
                TextInput::make('owner_name')
                    ->required(),
                TextInput::make('owner_contact')
                    ->required(),
                TextInput::make('secondary_contact')
                    ->default(null),
                TextInput::make('owner_email')
                    ->email()
                    ->default(null),
                TextInput::make('address')
                    ->default(null),
            ]);
    }
}
