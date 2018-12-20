@extends('layout')
@section('after_style')
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
        <div class="box-body">
            <form class="form-horizontal" action="{{route('search_prescription_by_pharmacy')}}" method="post">
                {{csrf_field()}}
                <div class="form-group col-md-6">
                    <label class="col-sm-2 control-label">Prescription ID : </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" name="prescription_id" autofocus="" required="">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>

            </form>
            <form class="form-horizontal" action="{{route('search_patient_by_pharmacy')}}" method="post">
                {{csrf_field()}}
                <div class="form-group col-md-6">
                    <label class="col-sm-2 control-label">Patient ID : </label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <input type="text" class="form-control" name="patient_id" autofocus="" required="">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@include('partials.messages')
@isset($patient)
<div class="box">
    <div class="box-body">
        <div class="col-sm-4">
            <span><strong>Patient Name : </strong>{{$patient->patient_name}}</span>
        </div>
        <div class="col-sm-4">
            <span><strong>Age : </strong>{{$patient->age}}</span>
        </div>
        <div class="col-sm-4">
            <span><strong>Patient ID : </strong>{{$patient->patient_id}}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-8">
        <div class="box">
            <div class="box-header">
                <div class="pull-right">
                    <span><b>Prescription ID : </b>{{$prescription->prescription_id}}</span>
                </div>
            </div>
            <div class="box-body">
                <div class="col-sm-12">
                    <h3 style="color: #605ca8; font-weight: bold">Dr. Md. Naushad Alam</h3>
                    <p>
                        <span>MBBS (DMC), BCS (Health) FCPS (Surgery)</span><br>
                        <span>MS (Urology) URC (Singapore)</span><br>
                        <span style="color: #339900; font-weight: bold">Assistant Professor (Urology Department)</span><br>
                        <span>National Institute of Kidney Diseases & Urology</span><br>
                        <span>Sher-E-Bangla Nagar, Dhaka.</span><br>
                        <span style="font-weight: bold;">Mobile: 01552 374806</span>
                    </p>

                    <hr>
                </div>
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-4">
                            <span><b>Patient Name : </b>{{$patient->patient_name}}</span>
                        </div>
                        <div class="col-sm-4">
                            <span><b>Age : </b> {{$patient->age}} yrs</span>
                        </div>
                        <div class="col-sm-4">
                            <span><b>Date : </b> <?php echo date('d/m/Y', strtotime($prescription->date)) ?></span>
                        </div>
                    </div>
                    <hr>
                </div>
                <div class="col-sm-12">
                    <h4 style="font-weight: bold;">Medicines:</h4>

                    @if($medicines->count() > 0)
                    <form>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Medicine</th>
                                    <th>Group</th>
                                    <th>Company</th>
                                    <th>Period</th>
                                    <th>Duration</th>
                                    <th>Policy</th>
                                    <th style="text-align: center">Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($medicines as $key => $medicine)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$medicine->medicine_name}}</td>
                                    <td>{{$medicine->group_name}}</td>
                                    <td>{{$medicine->company_name}}</td>
                                    <td>{{$medicine->course_period}}</td>
                                    <td>{{$medicine->course_duration}}</td>
                                    <td>{{$medicine->taking_policy}}</td>
                                    <td><input type="number" class="form-control"></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="box-footer text-right">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                    @else
                    <span>--empty--</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="box">
            <div class="box-header">
                <h5>All Prescriptions : ({{$patient->patient_name}})</h5>
            </div>
            <div class="box-body">
                <ul class="list-group">
                    @foreach($prescriptions as $pres)
                    <a href="{{route('find_prescription_by_pharmacy',['id'=>$pres->prescription_id])}}"><li class="list-group-item {{$pres->prescription_id == $prescription->prescription_id ? 'active': ''}}">{{$pres->prescription_id}}</li></a>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endisset
@endsection
@section('after_script')
@endsection