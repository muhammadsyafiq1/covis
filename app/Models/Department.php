<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'code',
        'company_id',
        'name',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function department()
    {
        return $this->hasMany(JobPosition::class);
    }
}
