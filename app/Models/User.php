<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const TYPE_JOB_SEEKER = 'job_seeker';
    const TYPE_EMPLOYER = 'employer';
    const TYPE_ADMIN = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class, 'user_id');
    }

    public function resume()
    {
        return $this->hasOne(Resume::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }

    public function isApplied($offerId)
    {
        $result = $this->applications()->where('offer_id', $offerId)->get();
        if (count($result)) {
            return true;
        }

        return false;
    }
}
