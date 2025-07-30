<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyTarget extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'company_target';

    protected $fillable = [
        'user_id',
        'amount',
        'target_month',
        'target_year',
        'description'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
