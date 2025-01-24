@extends('layout')

@section('content')
    <h1>Детали вещи: {{ $thing->name }}</h1>
    <p>Описание: {{ $thing->description }}</p>
    <p>Статус: {{ $thing->status }}</p>
    <p>Гарантия: {{ $thing->wrnt }}</p>
@endsection
