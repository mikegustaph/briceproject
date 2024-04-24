<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $primarykey = 'id';

    protected $table = 'tasks';

    protected $fillable = [
        'task_name',
        'assign_to',
        'task_date',
        'task_note'
    ];
    public function usertask()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
