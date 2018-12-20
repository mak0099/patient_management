@extends('layout')
@section('after_style')
@endsection
@section('content_header')
<h1>
    {{$heading}}
    <!--<small>Patient entry</small>-->
</h1>
<ol class="breadcrumb">
    <li><a href="{{route('index')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">{{$heading}}</li>
</ol>
@endsection

@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="box">
        <div class="box-header">
            <div class="col-sm-12">
                <a href="{{route('patient_info', ['id' => $patient->id])}}" class="btn bg-purple"><span class="ion-arrow-return-left"></span> Patient Info</a>
                <div class="pull-right">
                    <span><b>Prescription ID : </b>{{$prescription->prescription_id}}</span>
                </div>
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
            <div class="col-sm-5">
                <h4 style="font-weight: bold;">Symptoms:</h4>
                <table class="table">
                    @foreach($symptoms as $symptom)
                    <tr>
                        <td>{{$symptom->symptom}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col-sm-7">
                <h4 style="font-weight: bold;">Medicines:</h4>
                <table class="table">
<!--                    <thead>
                        <tr>
                            <th>Medicine Name</th>
                            <th>Period</th>
                            <th>Duration</th>
                            <th>Taking Policy</th>
                        </tr>
                    </thead>-->
                    <tbody>
                        @foreach($medicines as $medicine)

                        <tr>
                            <td>{{$medicine->medicine_name . ' ('. $medicine->unit . ') '}}</td>
                            <td>{{$medicine->course_period}}</td>
                            <td>{{$medicine->course_duration}}</td>
                            <td>{{$medicine->taking_policy}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-5">
                <h4 style="font-weight: bold;">Adv:</h4>
                <table class="table">
                    @foreach($tests as $test)
                    <tr>
                        <td>{{$test->test_name}}</td>
                        <td>{{$test->test_code}}</td>
                        <td>{{$test->test_category}}</td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('after_script')

@endsection
