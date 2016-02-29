@extends('template')
@section('title','BlogSystem-Edit Blog')

@section('nav')
    <a class="selected" href={!! url('home') !!}>Blog</a>

    <a href={!! url('addBlog') !!}>New Blog</a>
    <a href={!! url('front') !!}>View FrontEnd</a>
    <a href={!! url('logout') !!}>Logout</a>
@endsection

@section('content')
    <ul class="breadcrumb">
        <li><a href="{!! url('home') !!}">Home</a></li>
        <li class="active">Edit Blog</li>
    </ul>
    @if(Session::has('message'))
        <div class="row">
            <div class="col-lg-6">
                <div class="alert {{ Session::get('alert-class', 'alert-info') }} msg">
                    {{ Session::get('message') }}
                </div>
            </div>
        </div>
    @endif


    @foreach($records as $val)
    <div class="heading ">Update Blog Article

    </div>

    <div class="form-group">
        <form action="{!! url('editBlog') !!}" method="post" class="" id="blog_edit" enctype='multipart/form-data'>

            <div class="form-group">Enter Title *</div>
            <div class="form-group"><input type="text" name="title"  value="{!! $val->title !!}" class="tect form-control"></div>


            <div class="form-group">Enter Description *</div>
            <div class="form-group"><textarea name="description" cols="60" rows="10" class="tect form-control" >{!! $val->description !!}</textarea></td>
            </div>

            <div class="form-group">Select Image *</div>
            <div class="form-group">
                <img src="{!! asset('resources/assets/upload/').'/'.$val->image_path !!}" class="img-responsive img-thumbnail" height="100px" width="100px">
                <input type="file" name="image" class="glyphicon-file" >
            </div>


            <div class="form-group">
                <input type="hidden" name="old_image" value="{!! $val->image_path !!}">
                <input type="hidden" name="id" value="{!! $val->id !!}">
                <input type="submit" name="submit" value="Submit" class="btn  btn-group btn-primary btn-block ">
            </div>

            </table>

        </form>
    </div>
    @endforeach
@endsection