<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $guarded = [];

    const SETUP_WFH = 'work from home';
    const SETUP_ON_SITE = 'on site';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAttachmentLinkAttribute()
    {
        $array = explode('/', $this->attachment);
        $endOfArray = end($array);
        return $endOfArray;
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
