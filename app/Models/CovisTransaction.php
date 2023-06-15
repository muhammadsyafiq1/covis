<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovisTransaction extends Model
{
    use HasFactory;

    protected $table = 'covis_transactions';

    protected $fillable = [
        'covis_customer_id',
        'termination_date',
        'covis_class_id',
        'covis_priority_id',
        'user_id',
        'scheduled_date',
        'covis_condition_id',
        'covis_used_for_id',
        'covis_access_type_id',
        'status',
        'is_revision',
        'admin_note',
        'note',
        'uuid',
        'created_by',
        'updated_by',
        'distance',
        'visited_at',
        'visit_status',
        'submited_at',
        'backdate',
    ];

    public function user_covis()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(CovisClasses::class, 'covis_class_id', 'id');
    }

    public function customer()
    {
        return $this->belongsTo(CovisCustomer::class, 'covis_customer_id');
    }

    public function surveyor()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function addendOn()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function covisPriority()
    {
        return $this->belongsTo(CovisPriority::class, 'covis_priority_id');
    }

    public function transactionImage()
    {
        return $this->hasOne(CovisTransactionImage::class, 'covis_transaction_id');
    }

    public function covisCondition()
    {
        return $this->belongsTo(CovisCondition::class, 'covis_condition_id');
    }

    public function covisUsedFor()
    {
        return $this->belongsTo(CovisUsedFor::class, 'covis_used_for_id');
    }

    public function covisRoadAccess()
    {
        return $this->belongsTo(CovisAccessType::class, 'covis_access_type_id');
    }
}
