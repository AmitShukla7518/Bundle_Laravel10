<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Callbackonabandonedstandard extends Model
{
    use HasFactory;
    protected $table = 'stand_callbackabandoned';
    protected $guarded = [''];
}
