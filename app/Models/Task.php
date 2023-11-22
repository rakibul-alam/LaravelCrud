<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'title',
        'release_date',
        'status',
        'description'
    ];

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
}
