@extends('layout.header')
@section('body')
    <div>

        <a href="">{{ Auth::guard('admin')->user()->adminName }}</a>
        <a href="{{ route('adminLogout') }}" onclick="event.preventDefault();
document.getElementById('logout').submit();">Log Out</a>
        <form id="logout" action="{{ route('adminLogout') }}" method="post">
            {{ csrf_field() }}
        </form>
    </div>

    <div>
        <a href="{{ route('adminSales') }}">Sales</a>
        <a href="{{ route('salesHistoryAdmin') }}">Sales History</a>
        <a href="{{ route('adminSupply') }}">Supply</a>
        <a href="{{ route('supplyHistoryAdmin') }}">Supply History</a>
    </div>
    @yield('section')

@stop