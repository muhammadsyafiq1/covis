<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCovidCertificate extends Model
{
    use HasFactory;

    protected $table = 'user_covid_certificates';

    protected $fillable = [
        'user_id',
        'name',
        'created_by',
        'updated_by',
    ];

    public function user_covid_certificate()
    {
        return $this->hasMany(User::class);
    }
}
