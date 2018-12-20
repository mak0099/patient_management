<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\MedicalTest;

class MedicalTestController extends Controller
{
    public function listTest(){
        Session::put('menu', 'test');
        $tests = MedicalTest::where('deletation_status', FALSE)->get();
        $view = view('medical_test/list_test');
        $view->with('heading', 'Test List');
        $view->with('tests', $tests);
        return $view;
    }
    public function addTest(){
        $view = view('medical_test/add_test');
        $view->with('heading', 'Add Test');
        return $view;
    }
    public function saveTest(Request $request){
        $this->validate($request, [
            'test_name' => 'required',
            'test_code' => 'required',
        ]);
        $input = $request->input();
        $input['created_by'] = 1;
        if(MedicalTest::create($input)){
            Session::put('alert-success', 'New item has saved!');
            return redirect()->back();
        }else{
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
    public function editTest($id){
        $test = MedicalTest::find($id);
        $view = view('medical_test/edit_test');
        $view->with('heading', 'Edit Test');
        $view->with('test',$test);
        return $view;
    }
    public function updateTest(Request $request, $id){
        $this->validate($request, [
            'test_name' => 'required',
            'test_code' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = 1;
        $test = MedicalTest::find($id);
        if($test->update($input)){
            Session::put('alert-success', 'item has updated!');
            return redirect()->route('list_test');
        }else{
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
    public function unpublishTest($id){
        $test = MedicalTest::find($id);
        if($test->update(['publication_status'=>FALSE])){
            return redirect()->back();
        }else{
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
    public function publishTest($id){
        $test = MedicalTest::find($id);
        if($test->update(['publication_status'=>TRUE])){
            return redirect()->back();
        }else{
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
    public function deleteTest($id){
        $test = MedicalTest::find($id);
        if($test->update(['deletation_status'=>TRUE])){
            Session::put('alert-success', 'Item has deleted!');
            return redirect()->back();
        }else{
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }
}
