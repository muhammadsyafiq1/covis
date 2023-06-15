<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyImage extends Model
{
    use HasFactory;

    protected $table = 'company_images';

    protected $fillable = [
        'company_id',
        'name',
        'created_by',
        'updated_by',
    ];

    public function company_image()
    {
        return $this->belongsTo(Company::class);
    }
}
