@extends('layouts.master')

@section('title')
    Scrabble Word Calculator
@endsection

@push('head')
    <link href="/css/books/show.css" type='text/css' rel='stylesheet'>
@endpush

@section('scrabblewordcontent')
    <h1>Enter your word here: <input type='text' name='userlogin' id='userlogin'></h1>
    <br>
    <br>
@endsection

@section('radiobuttonscontent')
    <input type='radio' name='securitycheck' id='securitycheck' value='checkenabled' 'CHECKED'> None<br>
    <input type='radio' name='securitycheck' id='securitycheck' value='checkdisabled' > Double word score<br>
    <input type='radio' name='securitycheck' id='securitycheck' value='checkdisabled' > Triple word score
    <br>
    <br>  
@endsection

@section('includebingocontent')
  <label for='includeBingo'>Include 50 point Bingo</label>
  <input type='checkbox' name='includeBingo[]' id='includeBingo' value='bingoSelected' > Yes
  <br> 
  <br>
@endsection

@section('contentacw')
    @if($title)
        <input type='submit' class='acw.css'>
    @else
        <h1>No book chosen acw</h1>
    @endif
@endsection

@push('body')
    <script src="/js/books/show.js"></script>
@endpush