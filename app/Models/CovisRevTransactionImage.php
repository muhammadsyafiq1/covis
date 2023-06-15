<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisRevTransactionImage extends Model
{
    use HasFactory;

    protected $table = 'covis_rev_transaction_images';

    protected $fillable = [
        'covis_customer_id',
        'photo_front1',
        'photo_front2',
        'photo_left',
        'photo_right',
        'created_by',
        'updated_by',
    ];
}
