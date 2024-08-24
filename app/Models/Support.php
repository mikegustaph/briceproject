<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'support';

    protected $fillable = [
        'title',
        'support_email',
        'support_phone',
    ];
}
