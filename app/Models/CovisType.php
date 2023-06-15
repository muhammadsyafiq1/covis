<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisType extends Model
{
    use HasFactory;

    protected $table = 'covis_types';

    protected $fillable = [
        'code',
        'name',
        'note',
        'is_active',
        'created_by',
        'updated_by',
    ];

    public function covisTypeCustomer()
    {
        return $this->hasOne(CovisCustomer::class, 'covis_type_id', 'id');
    }

    public function covis_type()
    {
        return $this->hasMany(CovisCustomer::class);
    }
}
