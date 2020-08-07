@if ($errors->{$bag ?? 'default'}->any())
    <p class="mt-3 t-red fl">Encountered errors:</p>
    <ul>
        @foreach($errors->{$bag ?? 'default'}->all() as $error)
            <li class="t-red">{{$error}}</li>
        @endforeach
    </ul>

@endif
