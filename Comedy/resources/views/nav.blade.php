<script type="text/javascript" src="{!! asset('js/nav.js') !!}"></script>

<link href="{!! asset('css/nav.css') !!}" media="all" rel="stylesheet" type="text/css" />

<?php
//use Illuminate\Support\Facades\Auth;
//?>

<script type="text/javascript">
    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
            $('nav').addClass('shrink');
        } else {
            $('nav').removeClass('shrink');
        }
    });


</script>

<div class="container">
    <nav class="navbar navbar-findcond navbar-fixed-top" id="nav">
        <div class="container">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse js-navbar-collapse">
                <ul class="nav navbar-nav">


                    <li class="list">
                        <a href="{{url('home')}}" style="color: #23b0fd">Home</a>
                    </li>


                    <li>
                        <a href="{{url('memes')}}" style="color: black">Memes</a>
                    </li>


                    <li>
                        <a href="{{url('jokes')}}" style="color: black">Jokes</a>
                    </li>


                    <li>
                        <a href="{{url('videos')}}" style="color: black;">Funny Videos</a>
                    </li>



                    <li>
                        <a href="{{url('fashion')}}" style="color: black">Fashion</a>
                    </li>

                </ul>

                <ul class="nav navbar-nav navbar-right">

                        <li>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="" class="search-form">
                                            <div class="form-group has-feedback">
                                                <label for="search" class="sr-only">Search</label>
                                                <input type="text" class="form-control" name="search" id="search" placeholder="search">
                                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </li>

                    <li>
                       <a href="#"><span class="glyphicon glyphicon-bell"></span></a>
                    </li>

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{Auth::user()->name}}
                            </a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">Account</a></li>
                            <li><a href="#">Favorites</a></li>
                            <li><a href="#">Promotions</a></li>
                            <li><a href="#">Refer to a friend</a></li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div><!-- /.nav-collapse -->
        </div>
    </nav>
</div>