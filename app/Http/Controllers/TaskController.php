<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('pages.tasks', compact('tasks'));
    }
    public function create()
    {
        $users = User::all();
        return view('pages.tasks_create', compact('users'));
    }
    public function taskcreateStore(Request $request)
    {
        $newtask = new Task();
        $newtask->task_name = $request->taskname;
        $newtask->user_id   = $request->assignto;
        $newtask->task_date = $request->taskdate;
        $newtask->task_note = $request->tasknote;
        $newtask->save();
        return redirect()->back()->with('success', 'Success add new task!');
    }
    public function taskEdit($id)
    {
        $task = Task::find($id);
        $users = User::all();
        return view('pages.tasks_edit', compact(['task', 'users']));
    }
    public function taskEditStore($id)
    {
        $data = Task::find($id);
    }
    public function update(Request $request, $id)
    {
        // Validate request data
        // $validatedData = $request->
    }
    public function taskDestroy($id)
    {
        $deleteTask = Task::findOrFail($id)->delete();
        if ($deleteTask) {
            return response()->json([
                "status" => true,
                "message" => "Delete Successfully",
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => "Server Error ! Please Try Again ",
            ]);
        }
    }
}
