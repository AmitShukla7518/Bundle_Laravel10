<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callbackstandard extends Model
{
    use HasFactory;
    protected $table = 'stand_call_back_list';
    protected $guarded = [''];
}
