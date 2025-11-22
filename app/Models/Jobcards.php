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
        'jobcard_number',
        'vehicle_number',
        'customer_name',
        'service_type',
        'user_id',
        'mechanic_id',
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
}

