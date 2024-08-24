<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyPolicy extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'privacy_policy';

    protected $fillable = [
        'title',
        'description',
    ];

    public function user()
    {
        //return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
