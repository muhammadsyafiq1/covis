<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    protected $table = 'indonesia_provinces';
    protected $fillable = [
        'code', 'name', 'meta'
    ];

    public function provinceCustomer()
    {
        return $this->hasOne(CovisCustomer::class, 'province_code', 'code');
    }
}
