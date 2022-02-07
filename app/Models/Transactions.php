<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $table = 'wb_transactions';
    protected $guarded = ['id'];

    public function members()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }

    public function outlets()
    {
        return $this->belongsTo(Outlets::class, 'outlet_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transaction_details()
    {
        return $this->hasOne(TransactionDetails::class, 'transaction_id');
    }
}
