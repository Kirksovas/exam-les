
@extends('layout')

@section('content')
    <h1>Вещи в ремонте</h1>
    <ul>
        @foreach($things as $thing)
            <li @highlightStatus($thing->status)>
                {{ $thing->name }} ({{ $thing->status }})
            </li>
        @endforeach
    </ul>
@endsection