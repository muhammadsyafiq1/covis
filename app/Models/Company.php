<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'code',
        'name',
        'alias',
        'address',
        'phone',
        'email',
        'website',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function userCompany()
    {
        return $this->hasOne(User::class, 'company_id', 'id');
    }

    public function company_image()
    {
        return $this->hasOne(CompanyImage::class);
    }

    public function company()
    {
        return $this->hasMany(Department::class);
    }
}
