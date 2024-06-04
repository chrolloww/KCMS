<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class Collaboration extends Model
{
    use HasFactory;
    protected $table = 'collaborations';
    protected $fillable = [
        'c_name',
        'c_focal_person',
        'c_type',
        'c_benefit',
        'c_start_date',
        'c_end_date',
        'c_image',
        'c_status',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class, 'c_focal_person', 's_name');
    }
}
