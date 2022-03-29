<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUsages extends Model
{
    use HasFactory;

    protected $table = 'data_usages';
    protected $guarded = ['id'];
}
