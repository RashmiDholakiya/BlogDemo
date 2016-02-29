@extends('template')
@section('title','BlogSystem-Add New Blog')

@section('nav')
    <a   href={!! url('home') !!}>Blog</a>

    <a class="selected" href={!! url('addBlog') !!}>New Blog</a>
    <a href={!! url('front') !!}>View FrontEnd</a>
    <a href={!! url('logout') !!}>Logout</a>
@endsection

@section('content')

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
    <div class="h3">Add New Blog Article</div>
<hr>
    <div class="form-group">
        <form id="blog_form" action="insert" method="post" class="" enctype='multipart/form-data' >

            <div class="form-group">Enter Title *</div>
            <div class="form-group"><input type="text" name="title" id="title"  class="tect form-control ">
                <span id="e_title"></span>
            </div>


            <div class="form-group">Enter Description *</div>
            <div class="form-group">
                <textarea name="description" id="des" cols="60" rows="10" class="tect form-control" >

                </textarea>
                <span id="e_des"></span>
            </div>


            <div class="form-group">Select Image *</div>
            <div class="form-group"><input type="file" id="file" name="image" class="glyphicon-file" >
                <span id="e_file"></span>
            </div>



            <div class="form-group">
                <input  type="submit" name="submit" value="Submit" class="btn  btn-group btn-primary  ">
            </div>

            </table>

        </form>
    </div>

</div>

    <script type="text/javascript">

        $().ready(function () {                // validate signup form on keyup and submit
            /*$("#blog_form").validate({
                rules: {
                    title: "required",
                    des: "required",
                    file:"required"
                                 },
                messages: {
                    title: "Please enter your Blog Title",
                    des: "Please enter your Blog Content",
                    file:"Please enter Blog Image"
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });    */
        });
    </script>


@endsection