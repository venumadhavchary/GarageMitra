<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Jobcards;
class Vehicle extends Model
{
    //
    protected $fillable = [
        'user_id',
        'vehicle_number',
        'make',
        'model',
        'fuel_type',
        'vehicle_type',
        'vehicle_image',
        'owner_name',
        'owner_contact',
        'secondary_contact',
        'owner_email',
        'address',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function jobcards()
    {
        return $this->hasMany(Jobcard::class, 'vehicle_number', 'vehicle_number');
    }
}
