<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'tasks';

    protected $fillable = [
        'task_name',
        'user_id',
        'task_note',
    ];
    public function userAssigned()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
