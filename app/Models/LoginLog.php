<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginLog extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'login_logs';

    protected $fillable =
    [
        'user_id',
        //'email',
        'ip_address',
        'user_agent',
        'logged_in_at',
        'is_suspicious',

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
