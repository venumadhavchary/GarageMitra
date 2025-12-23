<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use App\Models\Mechanics;

class Jobcard extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'jobcard_id',
        'user_id',
        'mechanic_name',
        'vehicle_id',
        'vehicle_number',
        'services',
        'vehicle_type',
        'remarks',
        'paid_amount',
        'odometer_reading',
        'fuel_level',
        'vehicle_received_from',
        'vehicle_collected_by',
        'vehicle_returned_to',
        'assigned_date',
        'estimated_completion_date',
        'vehicle_condition',
        'vehicle_images',
        'status',
        'bill_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_number', 'vehicle_number');
    }
    public function bill(){
        return $this->hasOne(Bill::class, 'jobcard_id', 'id');
    }
}

