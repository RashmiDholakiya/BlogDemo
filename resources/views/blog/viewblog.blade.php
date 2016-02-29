@extends('template')


@section('nav')
    <a  class="selected" href={!! url('home') !!}>Home</a>

    <a href={!! url('logout') !!}>Logout</a>
@endsection

@section('content')
    @if($records==null)
        {!! url('error')
           !!}
    @endif
@section('title','BlogSystem-'.$records[0]->title)
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>
    <ul class="breadcrumb">

        @if(Auth::id()==1)
           <li> <a type="button" href="{!! url('home') !!}" >Admin</a></li>
                <li><a type="button" href="{!! url('front') !!}" >Front</a></li>
                <li class="active">Blog</li>
        @else
            <li><a type="button" href="{!! url('home') !!}" >Home</a></li>
            <li class="active">Blog</li>
        @endif
    </ul>
    <div  class="row well">

    <br><br>
        @if($records==null)
            <h1>No data found</h1>
            {!! exit  !!}
        @endif
    @foreach( $records as $value)

        <div class="main contents">

            <div class="image">

                <img src="{!! asset('resources/assets/upload').'/'.$value->image_path !!}" class="img-thumbnail img-responsive">

            </div>
            <div class="data">

                    <div class="title nv-pie-title">

                    {!!   $value->title !!}
                </div>
                <div class="text-right text-info text-capitalize glyphicon-text-background">
                    {!! "Posted at : " . date('j F, Y',strtotime($value->active_from_date)) !!}
                </div>

                <div class="display text-primary">

                    {!! $value->description !!}


                </div>
            </div>
        </div>

        @endforeach
    <div class="main contents">
        <form action="../addcomments/{!! $records[0]->id !!}" method="post" id="blog_edit" class="form-group">
            <label>Add Your Comments:</label><br>
            <textarea name="comment" cols="70" rows="5"  class="text-justify form-control"></textarea><br>
            <input CLASS="btn btn-primary btn-default btn-block " type="submit" value="Post" name="submit">
        </form>

    </div>


    @foreach($comments as $cmt)


    <div  class="main contents">
        <div id='nameid' >{!! $cmt->comment !!} </div>
        <div id='msgid' align='right'>  Posted By: <a href="mailto:{!! $cmt->username !!}"> {!! $cmt->username !!}</a> </div>
    </div><br>

    @endforeach

    </div>
@endsection