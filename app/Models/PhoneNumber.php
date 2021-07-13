<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhoneNumber extends Model
{
    protected $table = 'customer';
    protected $guarded = ['id', 'name', 'phone'];
}
