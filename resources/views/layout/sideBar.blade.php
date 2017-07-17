@extends('layout.header')
@section('body')
    <div>
        <a href="">{{ Auth::guard('user')->user()->username   }}</a>
        <a href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout').submit();">Log Out</a>
        <form id="logout" action="{{ route('logout') }}" method="post">
            {{ csrf_field() }}
        </form>
    </div>

    <div>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('salesHistory') }}">salesHistory</a>
        <a href="{{ route('supply') }}">Supply</a>
        <a href="{{ route('supplyHistory') }}">Supply History</a>
    </div>
   @yield('section')

    @stop