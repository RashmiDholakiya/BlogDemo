@extends('template')
@section('title','BlogSystem-Manage Blog')

@section('nav')
    <a class="selected"  href={!! url('home') !!}>Blog</a>

    <a href={!! url('addBlog') !!}>New Blog</a>
    <a href={!! url('front') !!}>View FrontEnd</a>
    <a href={!! url('logout') !!}>Logout</a>

@endsection
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
<div style="text-align: center;">
    <br/>
    <div id="container">
        <input type="text" id="search" class="header-search" placeholder="Search By Title"/>
        <input type="button" id="button" value="Search" class="btn btn-primary  glyphicon-search" />
        <select id="status" class="dropdown dropdown-toggle">
            <option value="0" >Search by status</option>
            <option value="Active" >Active</option>
            <option value="Deactive" >Deactive</option>
        </select>
        <input type="button" id="Btnstatus" value="Search" class="btn btn-primary  glyphicon-search" />
        <input type="button"  onclick="return location.reload();" class="btn btn-primary" value="Reset All">

        <div id="result"></div>
    </div>
    <br/>
</div>


<div class="loading-div"></div>

<div id="results">

    <table border=1 id="datatable" class="table table-bordered table-responsive">
        <tr >
            <th width="2%">ID</th>
            <th width="8%">Title</th>
            <th width="40%">Description</th>
            <th width="15%">Active From Date</th>
            <th width="15%">Active To Date</th>
            <th width="7%">Status</th>
            <th width="13%">Action</th>
        </tr>

        @foreach($records_admin as $val)


        <tr>
            <td align="center">{!! $val->id !!}  </td>
            <td align="center">{!! $val->title !!}  </td>
            <td align="justify">{!! $val->description !!}

            </td>
            <td align="center">{!! date('j F, Y',strtotime($val->active_from_date)) !!} </td>
            <td align="center">{!! date('j F, Y',strtotime($val->active_to_date)) !!} </td>
            <td align="center">{!! $val->status !!}
                   @if($val->status=='Active')

                    <a title="Click to change it with Deactive" href="{!! url('updateStatus/').'/'. $val->id !!}/Deactive">Deactive</a>
                @else
                    <a title="Click to change it with Active" href="{!! url('updateStatus/').'/'. $val->id !!}/Active">Active</a>
                @endif
            </td>
            </td>
            <td align="center">
                <a href="comment/{!! $val->id  !!}" title="View Comment"><span class="glyphicon glyphicon-comment"></span></a>
                |
                <a href="{!! url('edit-comment/').'/'.$val->id !!}" title="Click To Edit"><span class="glyphicon glyphicon-pencil"></span>{{--<img
                            src="{!! asset('resources/assets/images/edit.png') !!}" height="30%" width="30%">--}}</a>
                |
                <a href="{!! url('delete/').'/'.$val->id !!}" title="Click To Delete"
                   onclick="return confirm('Are you sure want to delete this record? ');" ><span class="glyphicon glyphicon-trash"></span>{{--<img
                            src="{!! asset('resources/assets/images/delete.png') !!}" height="30%" width="30%">--}}</a>
            </td>
        </tr>
            @endforeach

        </table>


</div>
<div style="text-align: center" id="links"> {!! $records_admin->links() !!} </div>
    @endsection