<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCollectionGroup extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'loan_collection_groups';

    protected $fillable = [
        'days_overdue',
        'classification',
        'provision'
    ];
}
