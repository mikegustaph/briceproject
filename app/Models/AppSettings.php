<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSettings extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'app_settings';

    protected $fillable = [
        'customer_id',
        'notif_update',
        'notif_promo',
    ];
}
