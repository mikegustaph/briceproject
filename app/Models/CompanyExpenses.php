<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyExpenses extends Model
{
    use HasFactory;
    protected $primarykey = 'id';

    protected $table = 'company_expenses';

    protected $fillable = [
        'user_id',
        'date',
        'account',
        'description',
        'method_of_payment',
        'paid_to',
        'amount',
        'attachment'
    ];
}
