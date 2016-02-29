@extends('template')
@section('title','BlogSystem-Login')

@section('content')

    @if(Session::has('message'))
        <div class="row">
            <div class="col-lg-12">
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} msg">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-md-6 col-md-offset-3"   >
    <div style="text-align: center"><h1>Log In</h1>

    </div>
    <div class="contents">

        <form action="{{URL('/home')}}" method="post" class="" id="blog_edit" enctype='multipart/form-data'>


            <input type="hidden" name="_token" value="{!! csrf_token() !!} ">


            <div class="form-group">Email-Id:</div>
            <div class="form-group">
                <input type="email" name="username" class="tect form-control"/>
            </div>


            <div class="form-group">Password:</div>
            <div class="form-group">
                <input type="password" name="password" class="tect form-control"/>
            </div>


            <div class="form-group">
                <input type="submit" name="submit" value="Sign In to BlogSystem" class="btn btn-primary "/>
                <a type="button" href="{!! url('register') !!}" class="btn btn-primary ">Don't have Account?? Register here free.</a>
            </div>
           
        </form>

    </div>
    </div>

@endsection