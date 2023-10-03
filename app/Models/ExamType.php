<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    use HasFactory;
    protected $fillable = [
        'fee_category_id',
        'class_id',
        'amount',
    ];
}
