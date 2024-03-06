<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadData extends Model
{
    use HasFactory;
    protected $table = 'clientdatas';
    protected $fillable = [
        'campaign',
        'customer_name',
        'phone',
        'customer_email',
        'model',
        'dealer_name',
        'state',
        'purchase_date',
        'chasis_no',
        'model_colour',
        'vehicle_registration_date'
    ];
}
