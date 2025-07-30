<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Current_Location extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'customer_current_location';

    protected $fillable = [
        'customer_id',
        'location_id',
    ];
}
