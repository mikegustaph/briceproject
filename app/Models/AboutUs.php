<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'about_us';

    protected $fillable = [
        'created_by',
        'title',
        'about_text',
    ];
}
