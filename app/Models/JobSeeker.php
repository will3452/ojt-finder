<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobSeeker extends User
{
    use HasFactory;
    protected $table = 'users';
    protected $guarded = [];


    public function profile()
    {
        return $this->hasOne(Profile::class, 'user_id');
    }


    protected static function booted()
    {
        static::addGlobalScope('employer', function (Builder $builder) {
            $builder->where('type', User::TYPE_JOB_SEEKER);
        });
    }
}
