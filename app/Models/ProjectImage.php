<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;

    protected $table = 'project_images';

    protected $fillable = [
        'project_id',
        'name',
        'created_by',
        'updated_by',
    ];

    public function project_image()
    {
        return $this->belongsTo(Project::class);
    }
}
