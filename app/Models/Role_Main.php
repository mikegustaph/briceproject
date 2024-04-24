<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role_Main extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'roles';

    protected $fillable = [
        'name',
        'guard_name',
    ];
}
