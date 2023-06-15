<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';

    protected $fillable = [
        'code',
        'name',
        'note',
        'is_active',
        'project_id',
        'created_by',
        'updated_by',
    ];

    public function regioncustomer()
    {
        return $this->hasOne(CovisCustomer::class, 'region_id', 'id');
    }

    public function region()
    {
        return $this->hasMany(Branch::class);
    }
}
