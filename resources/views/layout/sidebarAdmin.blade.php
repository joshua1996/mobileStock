@extends('layout.header')
@section('body')
    <style>
        header, main, footer {
            padding-left: 300px;
        }
        @media only screen and (max-width : 992px) {
            header, main, footer {
                padding-left: 0;
            }
        }
    </style>
    <header style=" ">
        <nav class="top-nav" style="background-color: #338af7;">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo">Stock Management System</a>
                    <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
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
                        <img src="http://materializecss.com/images/office.jpg" style="">
                    </div>
                    <a href="#!user"><img class="circle"
                                          src="https://scontent.fkul7-1.fna.fbcdn.net/v/t1.0-1/p50x50/14040150_656677004487246_9149169057837849694_n.jpg?oh=41824065f9425f40546202b81db9c6a6&amp;oe=5A04F2CB"></a>
                    <a href="#!name"><span class="white-text name">{{ Auth::guard('admin')->user()->adminName }}</span></a>
                    <a href="#!email"><span class="white-text email"></span></a>
                </div>
            </li>
            <li><a class="subheader">Sales</a></li>
            <li class="{{ (Request::is('*/sales') ? 'active' : '') }}"> <a class="waves-effect" href="{{ route('adminSales') }}">Sales</a></li>
            <li class="{{ (Request::is('*/salesHistory') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('salesHistoryAdmin') }}">Sales History</a></li>
            <li><a class="subheader">Supply</a></li>
            <li class="{{ (Request::is('*/supply') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('adminSupply') }}">Supply</a></li>
            <li class="{{ (Request::is('*/supplyHistory') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('supplyHistoryAdmin') }}">Supply History</a></li>
            <li><a class="subheader">Stock</a></li>
            <li class="{{ (Request::is('*/stock') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('stockAdmin') }}">Stock</a></li>
            <li class="{{ (Request::is('*/stockType') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('stockTypeAdmin') }}">Stock Type</a></li>

            <li><a class="subheader">Other</a></li>
            <li class="{{ (Request::is('*/supplyPerson') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('supplyPerson') }}">Supply Person</a></li>
            <li class="{{ (Request::is('*/user') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('userEditAdmin') }}">User</a></li>
            <li class="{{ (Request::is('*/staff') ? 'active' : '') }}"><a class="waves-effect" href="{{ route('staffAdmin') }}">Staff</a></li>
            <li ><a href="{{ route('adminLogout') }}" onclick="event.preventDefault();
document.getElementById('logout').submit();">Log Out</a></li>
        </ul>
        <script>
           $(document).ready(function () {
               $('.button-collapse').sideNav({
                   menuWidth: 300, // Default is 300
                   edge: 'left', // Choose the horizontal origin
                   closeOnClick: true, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                   draggable: true // Choose whether you can drag to open on touch screens,

               });
           });
        </script>
    </header>

    <main style="">
        <div class="container" style="margin-top: 20px;">
            @yield('section')
        </div>

    </main>


@stop