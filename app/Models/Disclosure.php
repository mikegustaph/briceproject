<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disclosure extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'disclosure';

    protected $fillable = [
        'title',
        'description',
    ];
}
