@extends('layout.header')
@section('body')

    <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('salesHistory') }}">salesHistory</a>
        <a href="{{ route('supply') }}">Supply</a>
        <a href="{{ route('supplyHistory') }}">Supply History</a>
    </div>
   @yield('section')

    @stop