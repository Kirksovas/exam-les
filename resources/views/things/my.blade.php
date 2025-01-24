@extends('layout')

@section('content')
    <h1>Мои вещи</h1>

    @forelse($things as $thing)
        <li @highlightStatus($thing->status)>
            {{ $thing->name }} ({{ $thing->status }})
            <br>
            <span>Описание: {{ $thing->description }}</span>
            <span>Гарантия: {{ $thing->wrnt ?? 'Не указана' }}</span>
        </li>
    @empty
        <p>У вас нет вещей.</p>
    @endforelse
@endsection
