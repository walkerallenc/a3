{{-- /resources/views/books/search.blade.php --}}
@extends('layouts.master')

@section('title')
    Search acw
@endsection

@section('content')
    <h1>Search</h1>

    <form method='GET' action='/books/search'>

        <label for='searchTerm'>Search by title:</label>
        <input type='text' name='searchTerm' id='searchTerm' value='{{ $searchTerm or '' }}'>
        
         {{-- ($caseSensitive) ? 'CHECKED' : '' --}}
        <input type='checkbox' name='caseSensitive' {{ ($caseSensitive) ? 'CHECKED' : '' }} >
        <label>case sensitive</label>

        <br>
        <input type='submit' class='btn btn-primary btn-small'>

    </form>

@if($searchTerm != null)
    <h2>Results for query: <em>{{ $searchTerm }}</em></h2>

    @if(count($searchResults) == 0)
        No matches found.
    @else
        <div class='book'>
            @foreach($searchResults as $title => $book)

                <h3>{{ $title }}</h3>
                <h4>by {{ $book['author'] }}</h4>
                <img src='{{$book['cover']}}'>

            @endforeach
        </div>
    @endif
@endif

@endsection
