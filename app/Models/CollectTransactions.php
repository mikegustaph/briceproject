<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectTransactions extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'collect_transactions';

    protected $fillable =
    [
        'loan_id',
        'accountNumber',
        'amount',
        'currency',
        'externalId',
        'provider',
        'additional_properties',
        'status'
    ];
}
