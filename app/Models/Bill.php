<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Jobcards;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = [
        'jobcard_id',
        'spare_parts',
        'services_to_do',
        'estimated_delivery',
        'vehicle_images',
        'labour_charges',
        'total_amount',
        'paid_amount',
        'discount',
        'status',

    ];
 
    // protected $casts = [
    //     'spare_parts' => 'json',
    //     'services_to_do' => 'json',
    //     'labour_charges' => 'json',
    //     'vehicle_images' => 'json',
    // ];
    public function jobcard()
    {
        return $this->belongsTo(Jobcards::class, 'id', 'jobcard_id');
    }
}
