<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'customer';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'sex',
        'Date_of_birth',
        'phone',
        'email',
        'nida_number',
        'region',
        'address',
        'current_location',
        'Education',
        'Marital_status',
        'Address',
        'district',
        'Region',
        'Exist_loan',
        'customer_image',
        'customer_id_card'
    ];
}
