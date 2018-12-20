@extends('layout')
@section('after_style')
<link rel="stylesheet" href="{{asset('public/health//plugins/datepicker/datepicker3.css')}}">
@endsection
@section('content_header')
<h1>
    Patient
    <small>Patient entry</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Patient</li>
</ol>
@endsection

@section('content')
<div class="box" style="box-shadow: 0 5px 30px #ccc">
    <div class="box-body">
        <form class="form-horizontal" action="{{route('find_patient')}}" method="post">
            {{csrf_field()}}
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Patient ID : </label>

                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" name="patient_id">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- /.box-header -->
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <!-- form start -->
        @include('partials/messages')
        <form action="{{route('save_patient')}}" method="post">
            {{csrf_field()}}
            <div class="box box-success">

                <div class="box-header with-border">
                    <h3 class="box-title">Create new patient</h3>
                </div>
                <div class="box-body row">
                    <div class="form-group col-sm-6 required">
                        <label class="control-label">Patient name</label>
                        <input type="text" name="patient_name" class="form-control" required="">
                    </div>
                    <div class="form-group col-sm-6">
                        <label class="control-label">Gender</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="gender" value="Male">Male</label>
                            <label class="radio-inline"><input type="radio" name="gender" value="Female">Female</label>
                            <label class="radio-inline"><input type="radio" name="gender" value="Other">Other</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 required">
                        <label class="control-label">Phone number</label>
                        <input type="tel" name="phone_number" class="form-control">
                    </div>

                    <!--                    <div class="form-group col-sm-6 required">
                                            <label class="control-label">Date of Birth</label>
                                            <input type="date" name="date_of_birth" class="form-control">
                                        </div>-->
                    <div class="form-group col-sm-6">
                        <label>Date of birth</label>
                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" name="date_of_birth" class="form-control pull-right" id="datepicker">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group col-sm-6 required">
                        <label class="control-label">Varification type</label>
                        <div class="radio">
                            <label class="radio-inline"><input type="radio" name="verification_type" value="NID">NID</label>
                            <label class="radio-inline"><input type="radio" name="verification_type" value="BCN">BCN</label>
                            <label class="radio-inline"><input type="radio" name="verification_type" value="Passport">Passport</label>
                        </div>
                    </div>
                    <div class="form-group col-sm-6 required">
                        <label class="control-label">Verification Number (NID/BCN/Passport)</label>
                        <input type="text" name="verification_number" class="form-control">
                    </div>
                    <div class="form-group col-sm-12">
                        <label class="control-label">Address</label>
                        <textarea class="form-control" rows="5" name="address"></textarea>
                    </div>
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success pull-right">Register</button>
                </div>

            </div><!-- /.box -->

        </form>
    </div>
</div>
@endsection
@section('after_script')
<script src="{{asset('public/health/plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<script>
$(function () {
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true
    });
});
</script>
@endsection