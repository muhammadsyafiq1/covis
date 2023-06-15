<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $table = 'indonesia_districts';
    protected $fillable = [
        'code', 'city_code', 'name', 'meta'
    ];

    public function districtCustomer()
    {
        return $this->hasOne(CovisCustomer::class, 'district_code', 'code');
    }
}
