@extends('layout')
@section('after_style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="{{asset('public/health/plugins/select2/select2.min.css')}}">
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
<div style="padding: 15px 0;">
    <a href="{{route('patient_info', ['id' => $patient->id])}}" class="btn bg-purple"><span class="ion-arrow-return-left"></span> Patient Info</a>
</div>
<div class="box">
    <div class="box-body">
        <div class="col-sm-3">
            <span><strong>Patient Name : </strong>{{$patient->patient_name}}</span>
        </div>
        <div class="col-sm-3">
            <span><strong>Age : </strong>{{$patient->age}}</span>
        </div>
        <div class="col-sm-3">
            <span><strong>Patient ID : </strong>{{$patient->patient_id}}</span>
        </div>
        <div class="col-sm-3">
            <span><strong>Doctor ID : </strong>{{$doctor_id}}</span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-5">
        <div class="box">
            <div class="box-body">

                <form action="{{route('add_symptom_to_prescription')}}" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label class="control-label">Add Symptom : </label>
                        <div class="input-group">
                            <input type="hidden" name="patient_id" value="{{$patient->id}}">
                            <input type="hidden" name="doctor_id" value="1">
                            <input name="symptom" class="form-control">
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default">Add</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Symptoms</h3>

                <div class="box-tools">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <tbody><tr>
                            <th>#</th>
                            <th>Symptom</th>
                            <th>Action</th>
                        </tr>
                        @foreach($temp_symptoms as $key => $temp_symptom)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$temp_symptom->symptom}}</td>

                            <td><a href="{{route('delete_symptom_from_prescription', ['id'=> $temp_symptom->id])}}" class="btn btn-default" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i> Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

        </div>
    </div>
    <div class="col-sm-7">
        <div class="box">
            <div class="box-body">

                <form class="form-horizontal" id="search_form">
                    {{csrf_field()}}
                    <div class="row">

                        <div class="form-group col-sm-12">
                            <label class="col-sm-2 control-label">Medicine Name : </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="search_medicine" name="medicine_name" autofocus="">
                            </div>
                        </div>
                    </div>
                </form>

                <div class="alert bg-gray-light medicine_box" style="overflow: hidden; display: none">
                    <form class="form-horizontal" action="{{route('add_medicine_to_prescription')}}" method="post">
                        {{csrf_field()}}
                        <button type="button" class="close" onclick="$('.medicine_box').hide()">×</button>
                        <div class="">
                            <input type="hidden" name="medicine_id" id="medicine_id">
                            <input type="hidden" name="patient_id" value="{{$patient->id}}">
                            <input type="hidden" name="doctor_id" value="1">
                            <h4><span id="medicine_name">Name</span> <small>(<span id="unit"></span>)</small></h4>
                            <p><span id="group_name">Paracetamol</span>, <span id="company_name">Squire</span></p>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Period</label>
                            <select class="form-control" name="course_period">
                                <option>1 time/day</option>
                                <option>2 times/day</option>
                                <option>3 times/day</option>
                                <option>4 times/day</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Duration</label>
                            <select class="form-control" name="course_duration">
                                <option>1 month</option>
                                <option>2 months</option>
                                <option>3 months</option>
                                <option>4 months</option>
                                <option>5 months</option>
                                <option>6 months</option>
                                <option>Continue</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Taking Policy</label>
                            <select class="form-control" name="taking_policy">
                                <option>After Meal</option>
                                <option>Before Meal</option>
                                <option>After 1 hour from Meal</option>
                                <option>Before 1 hour from Meal</option>
                                <option>Before sleep at night</option>
                                <option>when wakeup in the morning</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Medicine Items</h3>

                <div class="box-tools">
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <tbody><tr>
                            <th>#</th>
                            <th>Medicine Name</th>
                            <th>Course Period</th>
                            <th>Course Duration</th>
                            <th>Taking Policy</th>
                            <th>Action</th>
                        </tr>
                        @foreach($temp_medicines as $key => $temp_medicine)
                        <?php $medicine = App\Medicine::find($temp_medicine->medicine_id) ?>
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$medicine->medicine_name . ' (' . $medicine->unit . ') ' . $medicine->group_name . ' - ' . $medicine->company_name}}</td>
                            <td>{{$temp_medicine->course_period}}</td>
                            <td>{{$temp_medicine->course_duration}}</td>
                            <td>{{$temp_medicine->taking_policy}}</td>
                            <td><a href="{{route('delete_medicine_from_prescription', ['id'=> $temp_medicine->id])}}" class="btn btn-default" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i> Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->
        <div class="box box-info">
            <div class="box-header">
                <h3 class="box-title">Medical Test Items</h3>

                <div class="box-tools">
                    <a href="" data-toggle="modal" data-target="#testModal" class="btn btn-default"><i class="fa fa-plus"></i> Add Medical Test</a>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-hover">
                    <tbody><tr>
                            <th>#</th>
                            <th>Test Name</th>
                            <th>Test Code</th>
                            <th>Test Catagory</th>
                            <th>Action</th>
                        </tr>
                        @foreach($temp_tests as $key => $temp_test)
                        <?php $test = App\MedicalTest::find($temp_test->test_id) ?>
                        <tr>
                            <td>{{$key +1}}</td>
                            <td>{{$test->test_name}}</td>
                            <td>{{$test->test_code}}</td>
                            <td>{{$test->test_category}}</td>
                            <td><a href="{{route('delete_test_from_prescription', ['id'=> $temp_test->id])}}" class="btn btn-default" onclick="return confirm('Are you sure to delete this?')"><i class="fa fa-trash-o"></i> Delete</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->

        </div>
        <!-- /.box -->
        <div class="box">
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="{{route('delete_all_from_prescription')}}" class="btn btn-danger" onclick="return confirm('Are you sure to delete all items?')"><i class="fa fa-times"></i> Clear all</a>
                <div class="pull-right">
                    <a href="{{route('save_prescription', ['patient_id' => $patient->id])}}" class="btn btn-success"><i class="fa fa-ok"></i> Submit Prescripton</a>
                </div>

            </div>
        </div>
        <!-- /.box -->
    </div>
</div>
<div class="modal" id="testModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">New test</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('add_test_to_prescription')}}" method="post" id="testForm">
                    {{csrf_field()}}
                    <input type="hidden" name="patient_id" value="{{$patient->id}}">
                    <input type="hidden" name="doctor_id" value="1">
                    <div class="form-group">
                        <label>Add new test</label>
                        <select class="form-control select2" style="width: 100%;" name="test_id">
                            @foreach($tests as $test)
                            <option value="{{$test->id}}">{{$test->test_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="testSubmit"><i class="fa fa-plus"></i> Add</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection
@section('after_script')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="{{asset('public/health/plugins/select2/select2.full.min.js')}}"></script> 
<script>
                    $('#search_form').submit(false);
                    $('#search_medicine').autocomplete({
                        source: "{{route('search_medicine')}}",
                        minlength: 1,
                        autoFocus: true,
                        select: function (e, ui) {
                            $('.medicine_box').show();
                            $('#medicine_id').val(ui.item.id);
                            $('#medicine_name').text(ui.item.value);
                            $('#unit').text(ui.item.unit);
                            $('#group_name').text(ui.item.group_name);
                            $('#company_name').text(ui.item.company_name);
                        }
                    });
                    $(function () {
                        //Initialize Select2 Elements
                        $(".select2").select2();
                    });
                    $('#testSubmit').click(function () {
                        $('#testForm').submit();
                    });
</script>
@endsection
