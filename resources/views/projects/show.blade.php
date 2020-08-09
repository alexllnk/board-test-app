@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <div class="mb-3">
                <p class="m-0 font-weight-bold">Title</p>
                {{ $project->title }}
            </div>

            <div class="mb-3">
                <p class="m-0 font-weight-bold">Description</p>
                {{ $project->description }}
            </div>
            <p>Tasks:</p>
            @forelse($project->tasks as $task)


                <form action="{{$project->path()}}/tasks/{{$task->id}}" method="post" class="row">
                    @csrf
                    @method('patch')
                    <div class="form-group col">
                        <input type="text" class="form-control" id="body" placeholder="task body here" name="body"
                               value="{{ $task->body }}">
                    </div>
                    <div class="form-group col">
                        <select class="form-control" name="status">
                            <option value="new" {{$task->status == "new"?"selected":""}}>New</option>
                            <option value="in-progress" {{$task->status == "in-progress"?"selected":""}}>In Progress
                            </option>
                            <option value="done" {{$task->status == "done"?"selected":""}}>Done</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <a href="{{ Storage::url($task->file_attachment) }}">File Attachment</a>

                    </div>

                    <div class="col">
                        <form action="{{ $task->path() }}" method="post" class="d-inline">
                            @csrf
                            @method('patch')
                            <button type="submit" class="btn btn-outline-success btn-sm">update</button>
                        </form>

                        <form action="{{ $task->path() }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-danger btn-sm">delete</button>
                        </form>

                    </div>

                </form>

            @empty
                <p class="t-red">no tasks yet</p>
            @endforelse
            <p>Add New Tasks:</p>
            <div class="mb-3">
                <form action="{{ $project->path() . '/tasks' }}" method="post" enctype="multipart/form-data" class="row">
                    @csrf
                    <div class="form-group col">
                        <input type="text" class="form-control" id="body" placeholder="task body here" name="body">
                    </div>
                    <div class="form-group col">
                        <select class="form-control" name="status">
                            <option value="new">New</option>
                            <option value="in-progress">In Progress
                            </option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                    <div class="form-group col">
                        <input type="file" class="form-control-file" id="" name="file_attachment">
                    </div>
                    <div class="form-group col">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form>
            </div>
            <div class="mb-3">
                <p>View all project's tasks by their status:</p>
                <a class="mr-3" href="/projects/{{$project->id}}/tasks/new">New</a>
                <a class="mr-3" href="/projects/{{$project->id}}/tasks/in-progress">In Progress</a>
                <a class="mr-3" href="/projects/{{$project->id}}/tasks/done">Done</a>
            </div>
        </div>
        <p class="mb-3"><a href="{{ $project->path() . '/edit' }}" class="btn btn-success">Edit Poject </a></p>
        <div><a href="/projects" class="btn btn-primary">◄ Go Back</a></div>
        @include('projects.errors')
    </div>

@endsection

