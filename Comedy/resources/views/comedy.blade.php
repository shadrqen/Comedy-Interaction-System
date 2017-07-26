@extends('layouts.master')

@section('title')
    {{'Comedy Central'}}
@endsection

<link href="{!! asset('css/comedy.css') !!}" media="all" rel="stylesheet" type="text/css" />

@section('script')
<script type="text/javascript" src="{!! asset('js/comedy.js') !!}"></script>
    @stop

@section('content')
    <div class="container" style="padding-top: 70px">
        <div class="row">

                <div class="col-md-6 col-md-offset-3" style="background-color: white" id="share">
                    <form class="form-horizontal" role="form" method="post" action="">
                        <div class="form-group" style="padding:14px;">
                            <textarea id="textarea" class="form-control" placeholder="Something funny? "></textarea>
                        </div>

                        <button class="btn btn-success pull-right" id="btn">click</button>

                    </form>
                </div>

        </div>
    </div>


    <br>
    <br>


    @foreach($uploadedMemes as $meme)

        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="list-group-item" style="background-color: white; text-align: left">
                        <a href="#">{{$meme->name}}</a>
                        <br><br>
                        <?php

                        echo '<img src="uploads/' .$meme->image. '" width="500"; height="300" />';

                        echo '<br><br>';

                        echo $meme->comment;

                        ?>

                        <br><br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <span onclick="showTextarea({{$meme->memeId}})" style="color: #23b0fd;"
                                          class="glyphicon glyphicon-comment">Comment</span>
                                </div>
                                <div class="col-md-2">
                                    <a href="#"><span class="glyphicon glyphicon-share">Share</span></a>
                                </div>
                                <div class="col-md-2">
                                    <span>{{$meme->statuss}}</span>
                                    <span style="color: #23b0fd;" onclick="addLike({{$meme->memeId}},
                                            '{{$meme->type}}')"><span class="glyphicon glyphicon-thumbs-up">Like</span></span>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div id="{{$meme->memeId}}" class="hidden">
                        <textarea rows="1" style="width:400px;" id="{{$meme->image}}" cols="1" class="form-control"
                                  placeholder="Share your thoughts..."></textarea>
                            <br>
                            <button type="button" class="btn btn-success"
                                    onclick="submitComment({{$meme->memeId}}, '{{$meme->image}}', '{{$meme->type}}')">Submit
                            </button>
                        </div>
                        <br>
                        <div class="panel panel-success" style="background-color: wheat; width: 300px">
                            {{--{{$memes->commentsM}}--}}
                        </div>
                        <br>

                    </div>
                </div>
            </div>
        </div>

        <br>

    @endforeach



@endsection