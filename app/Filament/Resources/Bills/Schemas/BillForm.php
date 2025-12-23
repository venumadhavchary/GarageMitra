<?php

namespace App\Filament\Resources\Bills\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BillForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jobcard_id')
                    ->required()
                    ->numeric(),
                Textarea::make('spare_parts')
                    ->default(null)
                    ->columnSpanFull(),
                Textarea::make('services_to_do')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('labour_charges')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
                TextInput::make('paid_amount')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('discount')
                    ->required()
                    ->numeric()
                    ->default(0),
                DatePicker::make('estimated_delivery'),
                Textarea::make('vehicle_images')
                    ->default(null)
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('unpaid'),
            ]);
    }
}
