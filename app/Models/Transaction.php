<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $guarded = [];

    public function sender(){
        return $this->belongsTo(Customer::class,"SenderId","id");
    }

    public function beneficiary(){
        return $this->belongsTo(Customer::class,"BeneficiaryId","id");
    }

    public function getCreatedAtAttribute($date){
        return date('F d, Y h:i A', strtotime($date));
    }
}
