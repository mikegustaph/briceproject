<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanSetting extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'loan_settings';

    protected $fillable = [
        'interest_rate',
        'service_charge',
        'periods'
    ];
}
