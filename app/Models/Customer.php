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
        'phone',
        'email',
        'nida_number',
        'Occupation',
        'Address',
        'District',
        'Region',
        'customer_image',
        'customer_id_card',
        'referee_one_name',
        'referee_one_phone',
        'referee_two_name',
        'referee_two_phone',
        'status'
    ];
    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
    public function loanHistories()
    {
        return $this->hasManyThrough(LoanHistory::class, Loan::class);
    }

    public function updateCreditScore()
    {
        // Logic to update user's credit score based on repayment history
    }
}
