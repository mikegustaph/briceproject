<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'loan';

    protected $fillable = [
        'customer_id',
        'principal',
        'total_repay',
        'interest_rate',
        'number_of_days',
        'service_charge',
        'wallet_type',
        'status',
    ];

    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
    public function repayments()
    {
        return $this->hasMany(Repay_Loan::class, 'loan_id');
    }
}
