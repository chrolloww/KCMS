<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Collaboration;

class Staff extends Model
{
    use HasFactory;
    protected $fillable = [
        's_name', 
        's_email', 
        's_phone_number'
    ];

    public function collaborations()
    {
        return $this->hasMany(collaboration::class, 'c_focal_person', 's_name');
    }

}
