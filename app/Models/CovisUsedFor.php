<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisUsedFor extends Model
{
    use HasFactory;

    protected $table = 'covis_used_fors';

    protected $fillable = [
        'code',
        'name',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];
}
