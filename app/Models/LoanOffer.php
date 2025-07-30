<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanOffer extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'loan_offers';

    protected $fillable =
    [
        'credit_score_range_id',
        'loan_amount',
        'loan_term_days',
    ];
}
