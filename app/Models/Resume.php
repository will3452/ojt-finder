<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileLinkAttribute()
    {
        $array = explode('/', $this->file);
        $endOfArray = end($array);
        return $endOfArray;
    }
}
