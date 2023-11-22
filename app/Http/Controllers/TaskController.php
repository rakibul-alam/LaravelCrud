<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Task;
use Illuminate\Support\Facades\Session ;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Test;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::orderBy('id','asc')->paginate(5);
        return view('task.index', compact('tasks'));
    }


    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',

        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success','Task has been created successfully.');
    }


    public function show(Task $task)
    {
        return view('tasks.show',compact('task'));
    }


    public function edit(Task $task)
    {
        return view('task.edit',compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',

        ]);

        $task->fill($request->post())->save();

        return redirect()->route('tasks.index')->with('success','Task Has Been updated successfully');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success','Task has been deleted successfully');
    }

    // public function taskStatus(Task $task)
    // {
    //     $task->update([
    //         'status' => $task->status == StatusEnum::Active->value ? StatusEnum::Inactive->value : StatusEnum::Active->value,
    //     ]);
    //     Session::flash('status', 'task Status Successfully Changed');

    //     return response()->json(['redirect' => true, 'route' => route('podcasts.index')]);
    // }

    public function updateStatus(Request $request, $id)
{
    // Retrieve the model by ID
    $task = Task::find($id);

    // Update the status
    $task->status = $request->status;
    $task->save();

    // Return a response (JSON, for example)
    return response()->json([
        'newStatus' => $task->status,
        'message' => 'Status updated successfully'
    ]);
}
}