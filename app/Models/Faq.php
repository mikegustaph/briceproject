<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'faqs';

    protected $fillable = [
        'created_by',
        'title',
        'faqs_text',
    ];
}
