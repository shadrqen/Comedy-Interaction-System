@extends('layouts.master')

@section('title')
    {{'Memes'}}
@endsection

<link href="{!! asset('css/memes.css') !!}" media="all" rel="stylesheet" type="text/css" />

@section('script')
    <script type="text/javascript" src="{!! asset('js/memes.js') !!}"></script>
@stop

@section('content')
    <div class="container" style="padding-top: 70px">
        <div class="row">

            <div class="col-md-6 col-md-offset-3 topDiv" style="background-color: white">

                <form enctype="multipart/form-data" action=""  id="form" role="form" method="POST">
                    <div class="form-group" style="padding:14px;">
                        <textarea class="form-control" name="comment" placeholder="Type your comment here" id="ta"></textarea>
                    </div>
                    <input type="file" name="image" id="memeImage">
                    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <span class="pull-right">
                            <button type="submit" class="btn btn-success" id="upload">
                                Upload
                            </button>
                        </span>submitComment

                </form>

                <div id="editMeme" class="hidden">

                </div>

            </div>

        </div>
    </div>


    <br>
    <br>

    @foreach($uploadedMemes as $memes)

        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="list-group-item" style="background-color: white; text-align: left">
                        <a href="#">{{$memes->user->name}}</a>
                        <br><br>
                        <?php

                        echo $memes->comment;

                        echo '<br><br>';

                        echo '<img src="uploads/' .$memes->image. '" width="500"; height="300" />';

                        ?>

                        <br><br>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-2">
                                    <span onclick="showTextarea({{$memes->memeId}})" style="color: #23b0fd;"
                                          class="glyphicon glyphicon-comment">Comment</span>
                                </div>
                                <div class="col-md-2">
                                    <a href="#"><span class="glyphicon glyphicon-share">Share</span></a>
                                </div>
                                <div class="col-md-2">
                                    <span>{{$memes->statuss}}</span>
                                    <span style="color: #23b0fd;" onclick="addLike({{$memes->memeId}},
                                            '{{$memes->type}}')"><span class="glyphicon glyphicon-thumbs-up">Like</span></span>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div id="{{$memes->memeId}}" class="hidden">
                        <textarea rows="1" style="width:400px;" id="{{$memes->image}}" cols="1" class="form-control"
                                  placeholder="Share your thoughts..."></textarea>
                            <br>
                            <button type="button" class="btn btn-success"
                                    onclick="submitComment({{$memes->memeId}}, '{{$memes->image}}', '{{$memes->type}}')">Submit
                            </button>
                        </div>
                        <br>
                        <div class="panel panel-success" style="background-color: wheat; width: 300px">
                            {{$memes->commentsM}}
                        </div>
                        <br>

                    </div>
                </div>
            </div>
        </div>

        <br>

    @endforeach


@endsection




