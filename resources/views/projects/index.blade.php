@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row px-3">
            <a href="" @click.prevent="$modal.show('new-project-modal')" class="fl">Create New Project</a>

        </div>
        <div class="row">
            @forelse ($projects as $project)
                <div class="col-4 p-3">
                    <div class="bg-white p-3 rounded shadow">
                        <h3 class=" "><a
                                href="{{$project->path()}}">{{ $project->title }}</a></h3>
                        <div class="mb-3 overflow-auto">{{ $project->description }}</div>

                            <div>
                                <form action="{{ $project->path() }}" method="post" class="text-right">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm">delete</button>
                                </form>
                            </div>

                    </div>
                </div>
            @empty
                <div>No projects yet.</div>
                @endforelse</div.row>
        </div>

        <new-project-modal></new-project-modal>

@endsection
