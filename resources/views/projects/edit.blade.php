@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-column">
            <h2>Edit Your Project</h2>
            <form action=" {{ $project->path() }}" method="post" class="d-block">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <p class="m-0 font-weight-bold">Title</p>
                    <input class="mb-3" ype="text" name="title" id="" required placeholder="Title" value="{{ $project->title }}">
                </div>
                <div class="mb-3">
                    <p class="m-0 font-weight-bold">Description</p>
                <textarea class="mb-3" name="description" id="" cols="30" rows="10" required
                          placeholder="Description">{{ $project->description }}</textarea>
                </div>
                <input type="submit" class="btn btn-primary mb-3" value="Save">
            </form>

            <div class="d-block">
                <a href="{{ $project->path() }}" class="btn btn-danger">Cancel</a>
            </div>
        </div>

        @include('projects.errors')

    </div>
@endsection
