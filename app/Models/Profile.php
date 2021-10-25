<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    const STATUS_ACTIVE = 'active';
    const STATUS_NOT_ACTIVE = 'not_active';
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $guarded = [];

    public function getMoreInfoAttribute()
    {
        return json_decode($this->more ?? null);
    }

    public function getProfilePictureAttribute()
    {
        $array = explode('/', $this->picture);
        $endOfArray = end($array);
        return $endOfArray;
    }


    public function getInlineAddressAttribute()
    {
        return $this->more_info ? $this->more_info->inline_address : 'N/a';
    }

    public function getCityAttribute()
    {
        return $this->more_info ? $this->more_info->city : 'N/a';
    }

    public function getAboutAttribute()
    {
        return $this->more_info ? $this->more_info->about : 'N/a';
    }
}
