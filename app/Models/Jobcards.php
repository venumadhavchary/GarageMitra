<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use App\Models\Mechanics;

class Jobcards extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'user_id',
        'mechanic_id',
        'vehicle_number',
        'services',
        'vehicle_type',
        'remarks',
        'paid_amount',
        'odometer_reading',
        'fuel_level',
        'vehicle_received_from',
        'vehicle_returned_to',
        'estimated_completion_date',
        'vehicle_condition',
        'vehicle_images',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function mechanic()
    {
        return $this->belongsTo(Mechanics::class, 'mechanic_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicles::class, 'vehicle_number', 'vehicle_number');
    }
}

