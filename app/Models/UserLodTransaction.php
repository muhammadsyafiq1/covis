<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLodTransaction extends Model
{
    use HasFactory;

    protected $table = 'user_lod_transactions';

    protected $fillable = [
        'user_id',
        'company_id',
        'job_position_id',
        'project_id',
        'number',
        'start_date',
        'end_date',
        'note',
        'is_confirm',
        'created_by',
        'updated_by',
    ];
}
