<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPosition extends Model
{
    protected $table = 'job_positions';

    protected $fillable = [
        'code',
        'company_id',
        'department_id',
        'name',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function userJobPosition()
    {
        return $this->hasMany(User::class, 'job_position_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
