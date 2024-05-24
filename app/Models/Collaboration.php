<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class Collaboration extends Model
{
    use HasFactory;
    //protected $table = 'collaborations';
    //protected $primaryKey = 'id';
    protected $fillable = [
        'c_name', 
        'c_type',
        'c_benefit',
        'c_image', 
        'c_focal_person'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
