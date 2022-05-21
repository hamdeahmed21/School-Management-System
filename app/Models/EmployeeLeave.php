<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeave extends Model
{
    protected $fillable = [
        'name',
        'employee_id',
        'leave_purpose_id',
        'start_date',
        'end_date',

    ];
    public function purpose(){
        return $this->belongsTo(LeavePurpose::class,'leave_purpose_id','id');
    }
    public function user(){
        return $this->belongsTo(User::class,'employee_id','id');
    }
}
