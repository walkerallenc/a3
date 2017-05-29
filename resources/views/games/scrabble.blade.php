{{--######################################################################################################--}}
{{--#                                DWA15-Dynamic Web Applications Assignment #3.                       #--}}          
{{--######################################################################################################--}}

@extends('layouts.master')

@section('title')
    Scrabble Word Calculator
@endsection

@push('head')
    <link href="/css/acw.css" type='text/css' rel='stylesheet'>
@endpush

{{--###############################################################################--}}
{{--#This section is where the mutiplier and bonus point selections are captured. #--}}          
{{--###############################################################################--}}
@section('content')
    <form method='GET' action='/games/scrabble'>
        <h3><input type='text' name='enteredWord' id='enteredWord' value='{{$enteredWord or ''}}'><==Enter your word here</h3>
        <p class="required">*** this is a required field ***</p>
        <input type='radio' name='multipliercheck' id='single' value='single' {{($multipliercheck=='single' ? 'checked' : '') }}>None
        <br>
        <input type='radio' name='multipliercheck' id='double' value='double' {{($multipliercheck=='double' ? 'checked' : '') }}>Double word
        <br>
        <input type='radio' name='multipliercheck' id='triple' value='triple' {{($multipliercheck=='triple' ? 'checked' : '') }}>Triple word
        <br>
        <br>
        <label>Include 50 point Bingo</label>
        <input type='checkbox' name='includeBingo' {{($includeBingo ? 'CHECKED' : '') }}> Yes
        <br>
        <br>
        <input type='submit' class='/css/acw.css' value='Calculate scrabble word value'>
    </form>

{{--#################################################################################--}}
{{--#If validation error are generated, they are diplayed in the section.           #--}}          
{{--#If validation error are not generated, the calculated word value is displayed. #--}}          
{{--#################################################################################--}}
@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@else
    @if($enteredWord != null) 
        <h3>The scrabble word value of "<em>{{ $enteredWord }}</em>" is "<em>{{ $total }}</em>".</h3>
    @endif 
@endif

@endsection

