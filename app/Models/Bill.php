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
        'labour_charges',
        'total_amount',
        'paid_amount',
        'discount',
        'status',

    ];

    public function jobcard()
    {
        return $this->belongsTo(Jobcards::class, 'id', 'jobcard_id');
    }
}
