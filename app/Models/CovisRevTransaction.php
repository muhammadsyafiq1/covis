<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisRevTransaction extends Model
{
    use HasFactory;

    protected $table = 'covis_rev_transactions';

    protected $fillable = [
        'covis_customer_id',
        'user_id',
        'covis_condition_id',
        'covis_used_for_id',
        'covis_access_type_id',
        'is_confirm',
        'note',
        'uuid',
        'created_by',
        'updated_by',
    ];
}
