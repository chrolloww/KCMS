<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Staff;

class Collaboration extends Model
{
    use HasFactory;
    protected $table = 'collaborations';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 
        'type',
        'benefit',
        'image', 
        'focal_person'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
