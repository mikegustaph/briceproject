<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repay_Loan extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'loan_repay';

    protected $fillable = [
        'loan_id',
        'customer_id',
        'repay_amount',
        'available_amount',
        'wallet_type',
        'status'
    ];
    public function customers()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function loantaken()
    {
        return $this->belongsTo(Loan::class, 'loan_id');
    }
}
