@extends('layouts.master')

@section('title')
    Scrabble Word Calculator
@endsection

@push('head')
    <link href="/css/books/show.css" type='text/css' rel='stylesheet'>
@endpush

@section('content')
    <form method='GET' action='/games/scrabble'>
        {{-- csrf_field() --}}
        <h2>Enter your word here: <input type='text' name='enteredWord' id='enteredWord' value='{{$enteredWord or ''}}'></h2>
        <br>
        <input type='radio' name='multipliercheck' id='single' value='single' {{($multipliercheck=='single' ? 'checked=true' : '') }}>None
        <br>
        <input type='radio' name='multipliercheck' id='double' value='double' {{($multipliercheck=='double' ? 'checked=true' : '') }}>Double word
        <br>
        <input type='radio' name='multipliercheck' id='triple' value='triple' {{($multipliercheck=='triple' ? 'checked=true' : '') }}>Triple word
        <br>
        <br>
        <label>Include 50 point Bingo</label>
        <input type='checkbox' name='includeBingo' {{($includeBingo ? 'CHECKED' : '') }}> Yes
        <br>
        <br>
        <input type='submit' class='acw.css' value='Calculate word value'>
    </form>

@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@else
    @if($enteredWord != null) 
        <h2>The scrabble word value of "<em>{{ $enteredWord }}</em>" is "<em>{{ $total }}</em>".</h2>
    @endif 
@endif

@endsection

