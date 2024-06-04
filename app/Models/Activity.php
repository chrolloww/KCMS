<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $fillable = [
        'a_collaboration_name',
        'a_activity_name',
        'a_activity_description',
        'a_activity_PIC',
    ];
}
