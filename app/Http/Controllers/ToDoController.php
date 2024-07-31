<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Mail\TaskUpdated;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
class ToDoController extends Controller
{
  public function index()
  {
      $userId = Auth::id();
      $tasks = Task::where('user_id', $userId)
                   ->orderBy('created_at', 'desc')
                   ->get();

      return view('home', [
          'tasks' => $tasks,
      ]);
  }



public function create()
    {
        return view('Tasks.createTask');
    }

public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    if ($validator->fails()) {
        $errorMessages = implode(', ', $validator->errors()->all());
        activity()->log('Validation errors: ' . $errorMessages . ' by user ' . Auth::user()->name);
        return redirect()->back()->withErrors($validator)->withInput();
    }


    $task = Task::create([
        'title' => $request->title,
        'description' => $request->description,
        'is_completed' => null,
        'user_id' => Auth::id(),
        'created_at' => now()
    ]);

    activity()->log("Task '{$task->title}' created successfully by user '" . Auth::user()->name . "'.");

    $request->session()->flash('alert-success', 'Task Created Successfully');
    return redirect()->route('tasks.list');
}


public function markAsComplete(Task $task)
{
    $task->status = 'Completed';
    $task->is_completed = now();
    $task->save();
    activity()->log("Task '{$task->title}' completed successfully by user '" . Auth::user()->name . "'.");
    return redirect()->route('tasks.list')->with('success', 'Task marked as complete.');
}


public function markAsUncomplete(Task $task)
    {
        $task->status = 'In progress';
        $task->is_completed = null;
        $task->save();
        activity()->log("Task '{$task->title}' uncompleted  by user '" . Auth::user()->name . "'.");
        return redirect()->route('tasks.list')->with('alert-success', 'Task marked as uncompleted.');
    }

  public function edit($id){
        $task = Task::find($id);
        if(! $task){
            return to_route('tasks.index')->withErros([
                'error' => 'unable to locate the todo']);
        }
        return view('tasks.editTask', ['task'=>$task]);
  }

    public function update(TaskRequest $request){

        $validator = Validator::make($request->all(), [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

         if ($validator->fails()) {
                $errorMessages = implode(', ', $validator->errors()->all());
                activity()->log('Validation errors: ' . $errorMessages . ' by user ' . Auth::user()->name);
                return redirect()->back()->withErrors($validator)->withInput();
            }


        $task = Task::find($request->task_id);
        if(! $task){
            return to_route('tasks.index')->withErros([
                'error' => 'unable to locate the todo']);
        }
        $task->update([
            'title'=>$request->title,
            'description' => $request->description,
            'is_completed'=> $request->is_completed,
            'updated_at' => now()
        ]);


         $user = Auth::user();
                    $userName = $user->name;
                    $taskName = $task->title;
                    $updateDate = now()->toDateString();
                    $userEmail = $user->email;
                    Mail::to($userEmail)->send(new TaskUpdated($userName, $taskName, $updateDate));


        activity()->log("Task '{$task->title}' updated successfully by user '" . Auth::user()->name . "'.");
        $request->session()->flash('alert-success','Task Updated Successfully');
        return to_route('tasks.list');
    }

    public function destroy(Request $request, $id)
    {
        $task = Task::find($id);

        if (!$task) {
            return redirect()->route('tasks.index')->withErrors([
                'error' => 'Unable to locate the task'
            ]);
        }

        $task->delete();
        activity()->log("Task '{$task->title}' deleted successfully by user '" . Auth::user()->name . "'.");
        $request->session()->flash('alert-success', 'Task Deleted Successfully');
        return redirect()->route('tasks.list');
    }


}
