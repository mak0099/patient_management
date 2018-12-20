@extends('layout')
@section('after_style')

@endsection
@section('content_header')
<h1>
    Patient
    <small>Patient info</small>
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Patient</li>
</ol>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- Widget: user widget style 1 -->
        <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
                <h3 class="widget-user-username">{{$patient->patient_name}}</h3>
                <h5 class="widget-user-desc">{{$patient->address}}</h5>
            </div>
            <div class="widget-user-image hidden">
                <img class="img-circle" src="{{asset('public/health/img/mak.jpg')}}" alt="User Avatar">
            </div>
            <div class="box-footer">
                <div class="row">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">Age</span>
                            <h5 class="description-header">{{$patient->age}}</h5>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <span class="description-text">Phone number</span>
                            <h5 class="description-header">{{$patient->phone_number}}</h5>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                            <span class="description-text">Verificaton number</span>
                            <h5 class="description-header">{{$patient->verification_type . " : " . $patient->verification_number}}</h5>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Previous prescriptions</h3>

                <div class="box-tools">
                    <a href="{{route('add_prescription', ['id' => $patient->id])}}" class="btn bg-purple"><i class="fa fa-plus"></i> Add new prescription</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Prescription ID</th>
                            <th>Doctor name</th>
                            <th colspan="2">Medicine taking progress</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prescriptions as $prescription)
                        <tr>
                            <td>{{$prescription->date}}</td>
                            <td><a href="{{route('view_prescription', ['id' => $prescription->prescription_id])}}">{{$prescription->prescription_id}}</a></td>
                            <td>{{$doctor_name}}</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                </div>
                            </td>
                            <td><span class="badge bg-red">55%</span></td>
                            <td><span class="label label-warning">progressing</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
</div>
@endsection
@section('after_script')

@endsection