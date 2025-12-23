<?php

namespace App\Filament\Resources\Jobcards\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobcardForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jobcard_id')
                    ->required(),
                TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                TextInput::make('bill_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('vehicle_id')
                    ->numeric()
                    ->default(null),
                TextInput::make('mechanic_name')
                    ->required(),
                TextInput::make('vehicle_number')
                    ->required(),
                TextInput::make('vehicle_type')
                    ->required(),
                Textarea::make('services')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('remarks')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('paid_amount')
                    ->numeric()
                    ->default(null),
                TextInput::make('odometer_reading')
                    ->numeric()
                    ->default(null),
                TextInput::make('fuel_level')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('vehicle_received_from')
                    ->required()
                    ->default('customer'),
                TextInput::make('vehicle_collected_by')
                    ->default('owner'),
                TextInput::make('vehicle_returned_to')
                    ->required()
                    ->default('customer'),
                DatePicker::make('assigned_date')
                    ->required(),
                DatePicker::make('estimated_completion_date'),
                Textarea::make('vehicle_condition')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('vehicle_images')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('pending'),
            ]);
    }
}
