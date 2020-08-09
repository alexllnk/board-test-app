@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row px-3">
            <h1>All project's tasks with the "{{ $status }}" status</h1>
        </div>
        <div class="row">
            @forelse ($tasks as $task)
                <div class="col-4 p-3">
                    <div class="bg-white p-3 rounded shadow">
                        <div class="mb-3 overflow-auto">{{ $task->body }}</div>

                        <div>
                            <form action="{{ $task->path() }}" method="post" class="text-right">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-outline-danger btn-sm">delete</button>
                            </form>
                        </div>

                    </div>
                </div>
            @empty
                <div class="col">No tasks with such a status...</div>
            @endforelse
        </div>
        <div class="my-3">
            <a href="{{$project->path()}}" class="btn btn-primary">◄ Back to the Project</a>
        </div>
    </div>
@endsection
