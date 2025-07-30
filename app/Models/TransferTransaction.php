<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferTransaction extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'transfer_transactions';

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
