<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountOtherCost extends Model
{
    protected $fillable = [
        'date',
        'amount',
        'description',
        'image',
    ];
}
