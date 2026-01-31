<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'number',
        'password',
        'shop_name',
        'state',
        'shop_address',
        'gstin',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [ 
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
        ];
    }
    
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
    
    public function mechanics()
    {
        return $this->hasMany(Mechanic::class, 'user_id');
    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'user_id');
    }
    public function jobcards()
    {
        return $this->hasMany(Jobcard::class, 'user_id');
    }
}
