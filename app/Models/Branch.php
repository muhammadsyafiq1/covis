<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $table = 'branchs';

    protected $fillable =[
        'code', 
        'company_id',
        'project_id',
        'region_id',
        'name',
        'alias',
        'address',
        'phone',
        'email',
        'ao_name',
        'ao_no',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function branchCustomer()
    {
        return $this->belongsTo(CovisCustomer::class, 'branch_id', 'id');
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
