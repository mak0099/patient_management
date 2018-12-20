<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Medicine;

class MedicineController extends Controller {

    public function listMedicine() {
        Session::put('menu', 'medicine');
        $medicines = Medicine::where('deletation_status', FALSE)->get();
        $view = view('medicine/list_medicine');
        $view->with('heading', 'Medicine List');
        $view->with('medicines', $medicines);
        return $view;
    }

    public function addMedicine() {
        $view = view('medicine/add_medicine');
        $view->with('heading', 'Add Medicine');
        return $view;
    }

    public function saveMedicine(Request $request, Medicine $medicine) {
        $this->validate($request, [
            'medicine_name' => 'required',
            'group_name' => 'required',
            'company_name' => 'required',
        ]);
        $input = $request->input();
        $input['created_by'] = 1;
        if ($medicine->create($input)) {
            Session::put('alert-success', 'New item has saved!');
            return redirect()->back();
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function editMedicine($id) {
        $medicine = Medicine::find($id);
        $view = view('medicine/edit_medicine');
        $view->with('heading', 'Edit Medicine');
        $view->with('medicine', $medicine);
        return $view;
    }

    public function updateMedicine(Request $request, $id) {
        $this->validate($request, [
            'medicine_name' => 'required',
            'group_name' => 'required',
            'company_name' => 'required',
        ]);
        $input = $request->all();
        $input['updated_by'] = 1;
        $medicine = Medicine::find($id);
        if ($medicine->update($input)) {
            Session::put('alert-success', 'item has updated!');
            return redirect()->route('list_medicine');
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function unpublishMedicine($id) {
        $medicine = Medicine::find($id);
        if ($medicine->update(['publication_status' => FALSE])) {
            return redirect()->back();
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function publishMedicine($id) {
        $medicine = Medicine::find($id);
        if ($medicine->update(['publication_status' => TRUE])) {
            return redirect()->back();
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function deleteMedicine($id) {
        $medicine = Medicine::find($id);
        if ($medicine->update(['deletation_status' => TRUE])) {
            Session::put('alert-success', 'Item has deleted!');
            return redirect()->back();
        } else {
            Session::put('alert-danger', 'Something went wrong!');
            return redirect()->back();
        }
    }

    public function searchMedicine(Request $request) {
        $term = $request->term;
        $medicines = Medicine::where('publication_status', TRUE)
                ->where('deletation_status', false)
                ->where('medicine_name', 'LIKE', '%' . $term . '%')
                ->take(10)
                ->get();

        $results = array();
        foreach ($medicines as $medicine) {
            $results[] = [
                'id' => $medicine->id,
                'value' => $medicine->medicine_name,
                'unit' => $medicine->unit,
                'group_name' => $medicine->group_name,
                'company_name' => $medicine->company_name,
            ];
        }
        return response()->json($results);
    }

    public function findMedicine(Request $request) {
        $term = $request->input('medicine_name');
        $medicines = Medicine::where('publication_status', TRUE)
                ->where('deletation_status', false)
                ->where('medicine_name', 'LIKE', '%' . $term . '%')
                ->get();
        $view = view('patient/add_prescription');
        if ($medicines->count() > 0) {
            $view->with('has_result', TRUE);
            $view->with('medicines', $medicines);
        } else {
            $view->with('has_result', FALSE);
        }
        return $view;
    }

}
