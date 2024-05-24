<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collaboration;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'email', 
        'phone_number'
    ];

    public function Collaboration()
    {
        return $this->hasMany(collaboration::class);
    }

}
