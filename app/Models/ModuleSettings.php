<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleSettings extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'module_settings';

    protected $fillable =
    [
        'loan_approval',
        'loan_request_limit'
    ];
}
