@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/health/plugins/datatables/dataTables.bootstrap.css')}}">
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Medicine list</small>-->
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{$heading}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box">
            <div class="box-header">
                <div class="text-right">
                    <a href="{{route('add_medicine')}}" class="btn bg-purple"><span class="fa fa-plus"></span> Add New Medicine</a>
                </div>
            </div>
            @include('partials/messages')
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Medicine name</th>
                            <th>Group name</th>
                            <th>Company name</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($medicines as $key => $medicine)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$medicine->medicine_name}}</td>
                            <td>{{$medicine->group_name}}</td>
                            <td>{{$medicine->company_name}}</td>
                            <td>
                                @if($medicine->publication_status)
                                <a href="{{route('unpublish_medicine', ['id' => $medicine->id])}}"><span class="label label-success">Published</span></a>
                                @else
                                <a href="{{route('publish_medicine', ['id' => $medicine->id])}}"><span class="label label-danger">Unpublished</span></a>
                                @endif

                            </td>
                            <td>
                                <a href="{{route('edit_medicine',['id' => $medicine->id])}}" class="btn btn-default"><i class="fa fa-edit"></i> Edit</a>
                                <a href="{{route('delete_medicine',['id' => $medicine->id])}}" class="btn btn-default" onclick="return confirm('Are you sure to delte this?')"><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('public/health/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('public/health/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
                                    $(function () {
                                        $("#example1").DataTable();
                                        $('#example2').DataTable({
                                            "paging": true,
                                            "lengthChange": false,
                                            "searching": false,
                                            "ordering": true,
                                            "info": true,
                                            "autoWidth": false
                                        });
                                    });
</script>
@endsection