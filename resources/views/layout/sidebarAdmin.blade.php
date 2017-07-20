@extends('layout.header')
@section('body')

    <header style="    padding-left: 300px;">
        <nav class="top-nav" style="background-color: #338af7;">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo">Stock Management System</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li> <a href="">{{ Auth::guard('admin')->user()->adminName }}</a></li>
                        <li><a href="{{ route('adminLogout') }}" onclick="event.preventDefault();
document.getElementById('logout').submit();">Log Out</a></li>
                    </ul>
                    <form id="logout" action="{{ route('adminLogout') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>
        </nav>
        <ul id="slide-out" class="side-nav fixed">
            <li>
                <div class="user-view">
                    <div class="background">
                        <img src="http://materializecss.com/images/office.jpg" style="
">
                    </div>
                    <a href="#!user"><img class="circle"
                                          src="https://scontent.fkul7-1.fna.fbcdn.net/v/t1.0-1/p50x50/14040150_656677004487246_9149169057837849694_n.jpg?oh=41824065f9425f40546202b81db9c6a6&amp;oe=5A04F2CB"></a>
                    <a href="#!name"><span class="white-text name">user</span></a>
                    <a href="#!email"><span class="white-text email"></span></a>
                </div>
            </li>
            <li><a class="subheader">Sales</a></li>
            <li> <a class="waves-effect" href="{{ route('adminSales') }}">Sales</a></li>
            <li><a class="waves-effect" href="{{ route('salesHistoryAdmin') }}">Sales History</a></li>
            <li><a class="subheader">Supply</a></li>
            <li><a class="waves-effect" href="{{ route('adminSupply') }}">Supply</a></li>
            <li><a class="waves-effect" href="{{ route('supplyHistoryAdmin') }}">Supply History</a></li>
        </ul>
    </header>

    <main style="    padding-left: 300px;">
        <div class="container" style="margin-top: 20px;">
            @yield('section')
        </div>

    </main>


@stop