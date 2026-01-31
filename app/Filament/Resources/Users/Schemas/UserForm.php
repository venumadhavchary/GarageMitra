<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('number')
                    ->default(null),
                FileUpload::make('profile_image')
                    ->image(),
                TextInput::make('shop_name')
                    ->default(null),
                TextInput::make('state')
                    ->default(null),
                TextInput::make('shop_address')
                    ->default(null),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required(),
                TextInput::make('gst_number')
                    ->default(null),
                TextInput::make('password')
                    ->password()
                    ->default(null),
                Select::make('role')
                    ->options([
                        'user' => 'User',
                        'admin' => 'Admin',
                    ])
                    ->default('user')
                    ->required(),
            ]);
    }
}
