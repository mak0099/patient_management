@extends('layout')
@section('after_style')
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Add medicine</small>-->
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{$heading}}</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header">
                <div>
                    <a href="{{route('list_medicine')}}" class="btn bg-purple"><span class="ion-arrow-return-left"></span> Medicine List</a>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_medicine')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-6">
                        <label>Medicine Name</label>
                        <input type="text" class="form-control" placeholder="Medicine name" name="medicine_name">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Unit</label>
                        <div class="input-group">
                            <input type="number" class="form-control" placeholder="Unit" name="unit" min="0">
                            <span class="input-group-addon">ml/gm</span>
                        </div>
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Group Name</label>
                        <input type="text" class="form-control" placeholder="Group name" name="group_name">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Company Name</label>
                        <input type="text" class="form-control" placeholder="Company name" name="company_name">
                    </div>


                    <div class="box-footer text-right">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('after_script')

@endsection