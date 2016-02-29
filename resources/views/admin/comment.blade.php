@extends('template')
@section('title','BlogSystem-Manage Comments')
@section('nav')
    <a  href={!! url('home') !!}>Blog</a>

    <a href={!! url('addBlog') !!}>New Blog</a>
    <a href={!! url('front') !!}>View FrontEnd</a>
    <a href={!! url('logout') !!}>Logout</a>
@endsection

@section('content')
    <ul class="breadcrumb">
        <li><a href="{!! url('home') !!}">Home</a></li>
        <li class="active">Comment</li>
    </ul>

    <div style="text-align: center;">



    </div>

    <br/><br/>
    <div class="loading-div"></div>

    <div id="results" class="contents">




        <table border=1 id="datatable" class="table table-bordered table-responsive">
            <tr>
                    <td>

                    </td>
                    <td colspan="4">
                        <a type="button" class="btn btn-primary pull-right delete_all">Delete Selected</a>
                </td>
            </tr>
            <tr >
                <th width="2%">Select</th>
                <th width="2%" >ID</th>
                <th width="8%" >UserName</th>
                <th width="43%">Comment</th>
                <th width="8%" >Action</th>
            </tr>

            @foreach($comments as $val)




                   <tr data-row-id="{!! $val->id !!}">
                    <td><input type="checkbox" class="sub_chk" data-id="{!! $val->id !!}"></td>

                    <td align="center">{!! $val->id !!}  </td>
                    <td align="center">{!! $val->username  !!}  </td>
                    <td align="justify">{!! $val->comment !!} </td>
                    <td align="center">

                        <a href="{!! url('delete-comment/').'/'.$val->id !!}" title="Click To Delete"
                           onclick="return confirm('Are you sure want to delete this record? ');"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                </tr>
            @endforeach

        </table>


    </div>
    <div style="text-align: center"> {!! $comments->links() !!} </div>
@endsection