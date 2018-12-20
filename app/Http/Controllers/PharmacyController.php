<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Patient;
use App\Prescription;
use App\PrescriptionMedicine;

class PharmacyController extends Controller
{
    public function patientEntry() {
        Session::put('menu', 'pharmacy');
        return view('pharmacy/patient_entry');
    }

    public function searchPatient(Request $request) {
        $this->validate($request, [
            'patient_id' => 'required',
        ]);
        $patient_id = $request->input('patient_id');
        if (Patient::where('patient_id', $patient_id)->first()) {
            return redirect()->route('find_patient_by_pharmacy', ['id' => $patient_id]);
        } else {
            Session::put('alert-danger', 'Patient not found!');
            return redirect()->back();
        }
    }

    public function findPatient($patient_id) {
        $patient = Patient::where('patient_id', $patient_id)->first();
        $patient->age = $this->getAgeFromBirthDate($patient->date_of_birth);
        $prescriptions = Prescription::where('patient_id', $patient->id)->orderBy('id', 'desc')->get();
        $prescription = $prescriptions->last();
        $medicines = PrescriptionMedicine::where('prescription_id', $prescription->prescription_id)
                ->join('Medicines', 'prescription_medicines.medicine_id', '=', 'Medicines.id')
                ->get();
        $view = view('pharmacy/patient_entry');
        $view->with('patient', $patient);
        $view->with('medicines', $medicines);
        $view->with('prescription', $prescription);
        $view->with('prescriptions', $prescriptions);
        return $view;
    }

    public function searchPrescription(Request $request) {
        $this->validate($request, [
            'prescription_id' => 'required',
        ]);
        $prescription_id = $request->input('prescription_id');
        if (Prescription::where('prescription_id', $prescription_id)->first()) {
            return redirect()->route('find_prescription_by_pharmacy', ['id' => $prescription_id]);
        } else {
            Session::put('alert-danger', 'Prescription not found!');
            return redirect()->back();
        }
        
    }

    public function findPrescription($prescription_id) {
        $prescription = Prescription::where('prescription_id', $prescription_id)->first();
        $patient = Patient::find($prescription->patient_id);
        $patient->age = $this->getAgeFromBirthDate($patient->date_of_birth);
        $prescriptions = Prescription::where('patient_id', $patient->id)->orderBy('id', 'desc')->get();
        $medicines = PrescriptionMedicine::where('prescription_id', $prescription->prescription_id)
                ->join('Medicines', 'prescription_medicines.medicine_id', '=', 'Medicines.id')
                ->get();
        if ($patient) {
            $view = view('pharmacy/patient_entry');
            $view->with('patient', $patient);
            $view->with('medicines', $medicines);
            $view->with('prescription', $prescription);
            $view->with('prescriptions', $prescriptions);
            return $view;
        } else {
            Session::put('alert-danger', 'Patient not found!');
            return redirect()->back();
        }
    }

    public function getAgeFromBirthDate($birthDate) {
        $birth_year = Date('Y', strtotime($birthDate));
        $current_year = Date('Y', strtotime("+6 hours"));
        $age = $current_year - $birth_year;
        return $age;
    }
}
