@extends('layouts.master')

@section('title')
    {{'Jokes'}}
@endsection

<link href="{!! asset('css/jokes.css') !!}" media="all" rel="stylesheet" type="text/css" />

@section('script')
    <script type="text/javascript" src="{!! asset('js/jokes.js') !!}"></script>
@stop

@section('content')
    <div class="container" style="padding-top: 70px">
        <div class="row">

            <div class="col-md-6 col-md-offset-3" style="background-color: white" id="j">
                <div class="form-group" style="padding:14px;">
                    <textarea id="ta" class="form-control" placeholder="Something funny?"></textarea>
                </div>
                <span style="color: #23b0fd" class="pull-right">
                        <button type="submit" class="glyphicon glyphicon-upload btn btn-success"
                                onclick="">
                        </button>
                    </span>

            </div>


        </div>

    </div>

<br><br>





    <div class="container hidden" id="div">
        <div class="row">

            <div class="col-md-6 col-md-offset-3">
                <div class="list-group-item" style="background-color: white; text-align: left">
                    <a href="#"><span id="userName"></span></a>
                    <br><br>
                    <span id="joke"></span>
                    <br><br>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2">
                                <a href="#"><span class="glyphicon glyphicon-comment">Comment</span></a>
                            </div>
                            <div class="col-md-2">
                                <a href="#"><span class="glyphicon glyphicon-share">Share</span></a>
                            </div>
                            <div class="col-md-2">
                                <a href="#"><span class="glyphicon glyphicon-thumbs-up">Like</span></a>
                            </div>
                        </div>
                    </div>

                    <br>
                </div>
            </div>
        </div>
    </div>


<br>


    @foreach($jokeDetails as $jokes)

        <div class="container">
            <div class="row">

    <div class="col-md-6 col-md-offset-3">
            <div class="list-group-item" style="background-color: white; text-align: left">
                <a href="#">{{$jokes->name}}</a>
                <br><br>
                {{$jokes->joke}}
                <br><br>
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="#"><span class="glyphicon glyphicon-comment">Comment</span></a>
                        </div>
                        <div class="col-md-2">
                            <a href="#"><span class="glyphicon glyphicon-share">Share</span></a>
                        </div>
                        <div class="col-md-2">
                            <a href="#"><span class="glyphicon glyphicon-thumbs-up">Like</span></a>
                        </div>
                    </div>
                </div>

                <br>
            </div>
    </div>
            </div>
        </div>

        <br>

    @endforeach



@endsection