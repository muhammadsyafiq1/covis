<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'code',
        'company_id',
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

    public function project_image()
    {
        return $this->hasOne(ProjectImage::class);
    }

    public function projectCustomer()
    {
        return $this->hasOne(Customer::class, 'project_id', 'id');
    }

    public function project()
    {
        return $this->hasMany(Region::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
