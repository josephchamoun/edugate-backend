<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'parent_id', 'payment_date', 'total_amount', 'method'
    ];

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }

    public function details()
    {
        return $this->hasMany(PaymentDetail::class);
    }
}