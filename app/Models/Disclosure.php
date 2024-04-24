<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disclosure extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'disclosures';

    protected $fillable = [
        'created_by',
        'name',
        'disclosure_text',
    ];
}
