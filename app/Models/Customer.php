<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = ['name', 'email', 'phone', 'status', 'defaultCurrency'];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
