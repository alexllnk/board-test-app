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
            {{--@forelse($project->tasks as $task)


                <form action="{{$project->path()}}/tasks/{{$task->id}}" method="post">
                    @csrf
                    @method('patch')
                    <input name="body" value="{{ $task->body }}" class="w-1/2 {{$task->completed?"text-gray-400":""}}">
                    <input type="checkbox" name="completed" id="task-{{$task->id}}-input"
                           onchange="this.form.submit()" {{$task->completed?"checked":""}}>
                    <label for="task-{{$task->id}}-input">complete!</label>
                </form>

            @empty
                <p>No Tasks Yet</p>
            @endforelse--}}
            <div class="mb-3">
                <form action="{{ $project->path() . '/tasks' }}" method="post">
                    @csrf
                    <input type="text" name="body" id="" placeholder="Add a New Task" class="w-full">
                </form>
            </div>
        </div>
        <p class="mb-3"><a href="{{ $project->path() . '/edit' }}" class="btn btn-success">Edit Poject </a></p>
        <div><a href="/projects" class="btn btn-primary">◄ Go Back</a></div>
        @include('projects.errors')
    </div>

@endsection

