<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyChooseUs extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'why_choose_us';

    protected $fillable = [
        'created_by',
        'title',
        'interest_rate',
        'service_charge',
    ];
}
