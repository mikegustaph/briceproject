<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Console\View\Components\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function TaskList()
    {
        $tasks = Tasks::with('userAssigned')->get();
        return view('pages.tasks_list', compact('tasks'));
    }
    public function TaskCreate(Request $request)
    {
        $staffs = User::all();
        return view('pages.tasks_create', compact('staffs'));
    }
    public function TaskCreateStore(Request $request)
    {
        $newtask = new Tasks();
        $newtask->task_name = $request->task_name;
        $newtask->user_id   = $request->staffname;
        $newtask->task_note = $request->description;
        $newtask->save();
        return redirect()->back()->with('message', 'New task added successfully!');
    }

    public function TaskDelete($id)
    {
        $oldTask = Tasks::findOrFail($id);
        $oldTask->delete();
        return redirect()->back()->with('success', 'Task deleted successfully.');
    }
    public function TaskEditStore(Request $request, $id)
    {
        $newtask = new Tasks();
        $newtask->task_name = $request->task_name;
        $newtask->user_id   = $request->staffname;
        $newtask->task_note = $request->description;
        $newtask->save();
        return redirect()->back()->with('message', 'New task added successfully!');
    }
}
