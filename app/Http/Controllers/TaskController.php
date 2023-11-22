<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Models\Task;
use Illuminate\Support\Facades\Session ;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Test;
use Toastr;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::orderBy('id','desc')->paginate(5);
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

    public function changeStatus($id){
        $task = Task::select('status')->where('id',$id)->first();
        if($task->status==1){
            $status = 0;
        }else{
            $status = 1;
        }
        Task::where('id',$id)->update(['status'=>$status]);
        // Session::flash('status', 'Task Status Successfully Changed');
        // Toastr::success('Status Successfully Changed', 'Success', ["positionClass" => "toast-top-right","closeButton"=> "true","progressBar"=> "true"]);
        return redirect()->back();
    }
}
