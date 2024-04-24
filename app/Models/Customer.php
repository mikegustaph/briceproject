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
        'date_of_birth',
        'gender',
        'nida',
        'email',
        'Education',
        'Marital_status',
        'Address',
        'district',
        'Region',
        'Exist_loan',
        'Occupation',
        'Work_status',
        'Company_name',
        'Work_years',
        'Frequency_of_salary_payment',
        'Monthly_income',
        'customer_image',
        'customer_id_card',
    ];
}
