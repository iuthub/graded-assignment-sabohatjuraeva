<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    public function getIndex()
    {
        return view('task.index',
            ['users' => User::orderBy('name','desc')->get()]);
    }

    public function getAdminIndex()
    {
        $tasks = Auth::user()->tasks;
        return view('admin.index',
            ['tasks' => $tasks]);
    }

/*    public function getAdminCreate()
    {
        return view('admin.create');
    }*/

    public function getAdminEdit($id)
    {
        $task = Task::find($id);
        if(Gate::denies('update-post', $task)) {
            return redirect()->back()->with([
                'info'=>'You cannot edit this task'
            ]);
        }
        return view('admin.edit',
            ['task' => $task, 'taskId' => $id]);
    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|regex:/\w{2,}(\s)\w{2,}/'
        ]);

        $user = Auth::user();

        $task = new Task([
            'title' => $request->input('title'),
        ]);
        $user->tasks()->save($task);

        return redirect()->route('admin.index')->with('info', 'Task created: ' . $request->input('title'));
    }

    public function postAdminUpdate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|regex:/\w{2,}(\s)\w{2,}/'
        ]);
        $task = Task::find($request->input('id'));
        if(Gate::denies('update-post', $task)) {
            return redirect()->back()->with([
                'info'=>'You cannot edit this task'
            ]);
        }
        $task->title = $request->input('title');
        $task->save();
        return redirect()->route('admin.index')->with('info', 'Task edited, new task is: ' . $request->input('title'));
    }

    public function getAdminDelete($id)
    {
        $task = Task::find($id);
        if(Gate::denies('update-post', $task)) {
            return redirect()->back()->with([
                'info'=>'You cannot delete this task'
            ]);
        }
        $task->delete();
        return redirect()->route('admin.index')->with('info', 'Task deleted!');
    }
}
