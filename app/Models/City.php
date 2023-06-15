<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'indonesia_cities';
    protected $fillable = [
        'code', 'province_code', 'name', 'meta'
    ];

    public function cityCustomer()
    {
        return $this->hasOne(CovisCustomer::class, 'city_code', 'code');
    }
}