<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function TaskList()
    {
        return view('pages.tasks_list');
    }
    public function TaskCreate()
    {
        return view('pages.tasks_create');
    }
    public function TaskCreateStore()
    {
    }
}
