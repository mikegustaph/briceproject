<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanHistory extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'loan_histories';

    protected $fillable = [
        'loan_id',
        'repayment_amount',
    ];


    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
