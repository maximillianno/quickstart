<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;


class TaskController extends Controller
{
    //
   // protected $tasks; TaskRepository $tasks

    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    public function index(Request $request){
        //$tasks = $request->user()->tasks()->get();
        //dump($request->all());
        return view('tasks.index', ['tasks' => $this->tasks->forUser($request->user()), 'request' => $request->all()]);
        //return view('tasks.index', ['tasks' => $tasks]);
    }
    public function store(Request $request){
        $this->validate($request, ['name' => 'required|max:255']);
        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);
        //dump($request->user());
        return redirect('/tasks');

    }

    public function destroy(Request $request, Task $task)
    {
        //
        //$task = Task::find($request->task);
        //dump($task);


        $this->authorize('destroy', $task);
        $task->delete();

        return redirect('/tasks');

    }

}
