@extends('layout.header')
@section('body')
    <header style="    padding-left: 300px;">
        <nav class="top-nav">
            <div class="container">
                <div class="nav-wrapper">
                    <a href="#" class="brand-logo">Stock Management System</a>
                    <ul id="nav-mobile" class="right hide-on-med-and-down">
                        <li><a href="">{{ Auth::guard('user')->user()->username   }}</a></li>
                        <li>  <a href="{{ route('logout') }}" onclick="event.preventDefault();
document.getElementById('logout').submit();">Log Out</a></li>
                    </ul>
                    <form id="logout" action="{{ route('logout') }}" method="post">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>

        </nav>

        <ul id="slide-out" class="side-nav fixed">
            {{--<li><div class="user-view">--}}
            {{--<div class="background">--}}
            {{--<img src="images/office.jpg">--}}
            {{--</div>--}}
            {{--<a href="#!user"><img class="circle" src="images/yuna.jpg"></a>--}}
            {{--<a href="#!name"><span class="white-text name">John Doe</span></a>--}}
            {{--<a href="#!email"><span class="white-text email">jdandturk@gmail.com</span></a>--}}
            {{--</div></li>--}}
            {{--<li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>--}}
            {{--<li><a href="#!">Second Link</a></li>--}}
            {{--<li><div class="divider"></div></li>--}}
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="{{ route('home') }}">Home</a></li>
            <li><a class="waves-effect" href="{{ route('salesHistory') }}">Sales History</a></li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="{{ route('supply') }}">Supply</a></li>
            <li><a class="waves-effect" href="{{ route('supplyHistory') }}">Supply History</a></li>
        </ul>
        {{--<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>--}}
        <script !src="">
            $(document).ready(function () {
                // $(".button-collapse").sideNav();
            });
        </script>
    </header>




    <main style="    padding-left: 300px;">
        <div class="container" style="margin-top: 20px;">
            @yield('section')
        </div>
    </main>
    @stop