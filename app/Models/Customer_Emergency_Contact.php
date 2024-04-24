<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Emergency_Contact extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'emergency_contacts';

    protected $fillable = [
        'user_id',
        'name',
        'relationship',
        'phone'
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
