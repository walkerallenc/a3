@extends('layouts.master')

@section('title')
    All the books
@endsection

@section('content')
    <div class='book'>
        @foreach($books as $book)
            <h2>{{ $book->title }}</h2>
            <img src='{{ $book->cover }}'>
        @endforeach
    </div>
@endsection