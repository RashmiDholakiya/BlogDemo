@extends('template')
@section('title','BlogSystem-Registration')

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
    <div class="col-md-6 col-md-offset-3">
    <div style="text-align: center"><h1>Registration</h1></div>
    <div class="contents">

        <form action="{{URL('/do_register')}}" method="post" class="" id="blog_edit" enctype='multipart/form-data'>


            <input type="hidden" name="_token" value="{!! csrf_token() !!} ">


            <div class="form-group">Email-Id:</div>
            <div class="form-group">
                <input type="email" name="username" class="tect form-control"/>
            </div>


            <div class="form-group">Password:</div>
            <div class="form-group">
                <input type="password" name="password" id="password" class="tect form-control"/>
            </div>

            <div class="form-group">Confirm Password:</div>
            <div class="form-group">
                <input type="password" name="confirmpassword" id="confirmpassword" class="tect form-control"/>
            </div>

            <div class="form-group">Country:</div>
            <div class="form-group">
                <select name="country" id="country" class="country dropdown btn-block" >
                    <option selected="selected"  value="">Select Country</option>
                    @foreach($records as $key=>$val)
                    <option  value="{!! $val->id !!}">{!! $val->country_name !!}</option>
                   @endforeach
                </select>
            </div>

            <div class="form-group">State:</div>
            <div class="form-group">
                <select name="state" class="state dropdown btn-block">
                    <option selected="selected" value="">--Select State--</option>
                </select>

            </div>


            <div class="form-group">
                <input type="submit" name="submit" value="Sign Up to BlogSystem" class="btn btn-primary btn-block"/>
            </div>


        </form>

    </div>
    </div>
@endsection