<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditScoreRange extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'credit_score_ranges';

    protected $fillable =
    [
        'min_score',
        'max_score',
    ];
}
