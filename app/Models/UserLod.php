<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLod extends Model
{
    use HasFactory;

    protected $table = 'user_lods';

    protected $fillable = [
        'company_id',
        'job_position_id',
        'project_id',
        'number',
        'start_date',
        'end_date',
        'created_by',
        'updated_by',
        'user_id'
    ];
}
