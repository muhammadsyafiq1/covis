<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisClasses extends Model
{
    use HasFactory;

    protected $table = 'covis_classes';

    protected $fillable = [
        'code',
        'name',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
