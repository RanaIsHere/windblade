<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    use HasFactory;

    protected $table = 'wb_members';
    protected $guarded = ['id'];

    public function wb_transactions()
    {
        return $this->hasMany(Transactions::class, 'member_id');
    }
}
