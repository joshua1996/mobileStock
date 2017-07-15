@extends('layout.header')
@section('body')

    <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('salesHistory') }}">salesHistory</a>
    </div>
   @yield('section')

    @stop