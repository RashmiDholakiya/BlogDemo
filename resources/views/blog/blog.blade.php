@extends('template')
@section('title','BlogSystem-Blogs')
@section('nav')
    <a class="selected" href={!! url('home') !!}>Home</a>
    <a href={!! url('logout') !!}>Logout</a>
@endsection

@section('content')
    <br>
    <ul class="breadcrumb">

        @if(Auth::id()==1)
            <li> <a type="button" href="{!! url('home') !!}" >Admin</a></li>
            <li class="active">Front</li>
        @else
            <li class="active">Home</li>

        @endif
    </ul>

    <div style="text-align: center">

        {!! $records->links() !!} </div>
    <div id="results">


        @foreach( $records as $value)

            <div class="main contents">
                <div class="image img-thumbnail img-responsive ">

                    <img src="resources/assets/upload/{!!  $value->image_path !!} ">

                </div>
                <div class="data ">

                    <div class="img-responsive">
                        <a class="title nv-pie-title" href="viewBlog/{!! $value->id  !!}">
                          {!!   $value->title !!}  </a>

                    </div>
                    <div class="text-right text-info text-capitalize glyphicon-asterisk " >
                        {!! "Posted at : " . date('j F, Y',strtotime($value->active_from_date)) !!}
                    </div>

                    <div class="display text-primary ">

                        <div class="item">{!! $value->description !!}</div>

                    </div>

                </div>


            </div>
            <hr>
        @endforeach

    </div>

    <div style="text-align: center"> {!! $records->links() !!} </div>

@endsection