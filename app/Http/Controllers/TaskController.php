<?php

namespace App\Http\Controllers;

use App\Project;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Project $project, string $status)
    {
        $tasks = $project->tasks()->where('status', $status)->get();
        return view('tasks.index', [
            'tasks' => $tasks,
            'status' => $status,
            'project' => $project
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Project $project)
    {
        /*if (auth()->user()->isNot($project->owner)) {
            abort(403);
        }*/
        $attributes = request()->validate([
            'body' => 'required'
        ]);
        if ($request->file('file_attachment')) {
            $path = $request->file('file_attachment')->store('file_attachments');
        }
        $project->addTask([
            'body' => request('body'),
            'status' => request('status'),
            'file_attachment' => $path ?? null
        ]);

        return redirect($project->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project, Task $task)
    {
        if (auth()->user()->isNot($task->project->owner)) {
            //abort(403);
            return response('Forbidden', 403);
        }
        $attributes = request()->validate([
            'body' => 'required'
        ]);
        $attributes['status'] = request('status');
        $task->update($attributes);
        return redirect($project->path());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project, Task $task)
    {
        $task->delete();
        return redirect()->back();
    }
}
