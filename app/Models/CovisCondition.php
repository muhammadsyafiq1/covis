<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisCondition extends Model
{
    use HasFactory;

    protected $table = 'covis_conditions';

    protected $fillable = [
        'code',
        'name',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
