@extends('layout')
@section('after_style')
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Add test</small>-->
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
                    <a href="{{route('list_test')}}" class="btn bg-purple"><span class="ion-arrow-return-left"></span> Test List</a>
                </div>
            </div>
            <!-- /.box-header -->
            @include('partials/messages')
            <!-- form start -->
            <form role="form" action="{{route('save_test')}}" method="post">
                {{csrf_field()}}
                <div class="box-body">
                    <div class="form-group col-sm-6">
                        <label>Test Name</label>
                        <input type="text" class="form-control" placeholder="Test name" name="test_name">
                    </div>
                    <div class="form-group col-sm-6">
                        <label>Test Code</label>
                        <input type="text" class="form-control" placeholder="Test code" name="test_code">
                    </div>
                    <div class="form-group col-sm-12">
                        <label>Test Category</label>
                        <select class="form-control" name="test_category">
                            <option>Medical imaging</option>
                            <option>Blood tests‎</option>
                            <option>Urine tests‎</option>
                            <option>Chemical pathology‎</option>
                            <option>Diabetes-related tests</option>
                            <option>eye-related tests</option>
                        </select>
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