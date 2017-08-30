<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $tasks) {
        $this->middleware('auth');
        $this->tasks = $tasks;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request) {

        //$tasks = Task::where('id', $request->user()->id)->get();

        // 아래와 같은 방법 사용
        $tasks = $this->tasks->forUser($request->user());
        //$tasks = Task::with('user')->where('user_id',$request->user()->id)->get();
        $tasks_model = Task::with('user');
        $tasks = $tasks_model->where('user_id',$request->user()->id)->get();


        //dd($tasks);

        // 블레이드 파일 , 변수
        return view('tasks', [
            'tasks' => $tasks,
            'task'  => '',
        ]);

    }

    public function show(Task $task) {

        $tasks = Auth::user()->tasks()->get();

        return view('tasks', ['task'=>$task, 'tasks'=>$tasks]);
    }

    public function store(Request $request) {

        $this->validate($request, [
           'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return redirect('/tasks');
    }

    public function destroy(Request $request, Task $task) {

        $this->authorize('destroy', $task);
        $task->delete();
        return redirect('/tasks');

    }

    public function update(Request $request, $id) {

        //분석 해야 할것.

        $task = Task::find($id);

        $task->name = $request->input('name');

        $task->save();

        return redirect('/tasks/'.$id);
    }
}
