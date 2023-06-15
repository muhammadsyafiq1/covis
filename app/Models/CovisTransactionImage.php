<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisTransactionImage extends Model
{
    use HasFactory;

    protected $table = 'covis_transaction_images';

    protected $fillable = [
        'covis_transaction_id',
        'photo_front1',
        'photo_front2',
        'photo_left',
        'photo_right',
        'created_by',
        'updated_by',
    ];

    /**
     * Get the user that owns the CovisTransactionImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transaction()
    {
        return $this->belongsTo(CovisTransaction::class, 'covis_transaction_id');
    }
}
