@extends('layouts.master')

@section('title')
    {{'Fashion and Design'}}
@endsection

<link href="{!! asset('css/fashion.css') !!}" media="all" rel="stylesheet" type="text/css" />

@section('script')
    <script type="text/javascript" src="{!! asset('js/fashion.js') !!}"></script>
@stop

@section('content')
    <div class="container" style="padding-top: 70px">
        <div class="row">

            <div class="col-md-6 col-md-offset-3" style="background-color: white" id="j">

                <form enctype="multipart/form-data" id="upload_form" method="POST" action="{{url('uploadFashion')}}" >
                    <div class="form-group" style="padding:14px;">
                        <textarea class="form-control" name="comment" placeholder="Type your comment here" id="ta"></textarea>
                    </div>
                    <input type="file" name="file" id="file">
                    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                    <input type="hidden" value="{{ csrf_token() }}" name="_token">
                    <span class="pull-right">
                    <button class="btn btn-success" id="upload">
                            <span class="glyphicon glyphicon-upload"></span>
                    </button>
                </span>

                </form>
            </div>

        </div>
    </div>


    <br>
    <br>

    @foreach($uploadedFashion as $fashion)

        <div class="container">
            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="list-group-item" style="background-color: white; text-align: left">
                        <a href="#">{{$fashion->name}}</a>
                        <br><br>
                        <?php

                        echo '<img src="uploads/' .$fashion->image. '" />';

                        echo '<br><br>';

                        echo $fashion->comment;

                        ?>
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