<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveries extends Model
{
    use HasFactory;

    protected $table = 'deliveries';
    protected $guarded = ['id'];

    public function members()
    {
        return $this->belongsTo(Members::class, 'member_id');
    }
}
