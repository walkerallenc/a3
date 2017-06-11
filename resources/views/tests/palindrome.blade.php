{{--######################################################################################################--}}
{{--#                               Palindrome test.                                                     #--}}          
{{--######################################################################################################--}}

@extends('layouts.master')

@section('title')
    Palindrome test
@endsection

@push('head')
    <link href="/css/acw.css" type='text/css' rel='stylesheet'>
@endpush

{{--###############################################################################--}}
{{--#   This is where the palindrome test string is captured.                     #--}}          
{{--###############################################################################--}}
@section('content')
    <form method='GET' action='/tests/palindrome'>
        <h3><input type='text' name='enteredWord' id='enteredWord' value='{{$enteredWord or ''}}'><==Enter your palindrome candidate string here.</h3>
        <p class="required">*** this is a required field ***</p>
        <br>
        <input type='submit' class='/css/acw.css' value='Submit palindrome test string(s).'>
    </form>

{{--##################################################################################--}}
{{--#If validation error are generated, they are diplayed in the section.            #--}}          
{{--#If validation error are not generated, the palindrome test result is displayed. #--}}          
{{--##################################################################################--}}
@if(count($errors) > 0)
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@else
    @if($enteredWord != null) 
        <h3>The original word string is "<em>{{ $enteredWord }}</em>" and the reversed word string is "<em>{{ $WordAccumulator }}</em>".</h3><br>
        <h3>The results are "<em>{{ $palindromeresults }}</em>".</h3>
    @endif 
@endif

@endsection

