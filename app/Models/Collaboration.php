<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class Collaboration extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
        'type',
        'benefit',
        'image', 
        'focal_person'
    ];

    public function staffs()
    {
        return $this->belongsTo(Staff::class);
    }
}
