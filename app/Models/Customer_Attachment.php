<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_Attachment extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'emergency_contacts';

    protected $fillable = [
        'customer_id',
        'id_card_font',
        'id_card_back',
        'images',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
