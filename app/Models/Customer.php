<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    // protected $guarded = ['id'];
    protected $fillable = ['customer_Name','customer_Email','customer_Message'];
}
