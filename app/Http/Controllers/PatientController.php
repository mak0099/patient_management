<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Patient;
use App\Prescription;
use App\TempPrescriptionSymptom;
use App\PrescriptionSymptom;
use App\TempPrescriptionMedicine;
use App\PrescriptionMedicine;
use App\TempPrescriptionTest;
use App\PrescriptionTest;
use App\MedicalTest;
class PatientController extends Controller {

    public function patientEntry() {
        Session::put('menu', 'patient');
        return view('patient/patient_entry');
    }

    public function findPatient(Request $request) {
        $this->validate($request, [
            'patient_id' => 'required',
        ]);
        $patient_id = $request->input('patient_id');
        $patient = Patient::where('patient_id', $patient_id)->first();
        if ($patient) {
            return redirect()->route('patient_info',['patient_id'=> $patient->id]);
        } else {
            Session::put('alert-danger', 'Patient not found!');
            return redirect()->back();
        }
    }

    public function savePatient(Request $request, Patient $patient) {
        $this->validate($request, [
            'patient_name' => 'required',
            'verification_type' => 'required',
            'verification_number' => 'required',
            'date_of_birth' => 'required',
            'phone_number' => 'required',
        ]);
        $patient_id = time();
        $input = $request->input();
        $input['patient_id'] = $patient_id;
        $input['created_by'] = 1;
        $patient->fill($input);
        $patient->save();
        return redirect()->route('patient_info',['patient_id'=> $patient->id]);
    }

    public function patientInfo($patient_id) {
        $doctor_name = 'Nowshad Alam';
        $patient = Patient::find($patient_id);
        $patient->age = $this->getAgeFromBirthDate($patient->date_of_birth);
        $prescriptons = Prescription::where('deletation_status', FALSE)
                ->where('patient_id', $patient_id)
                ->orderBy('prescription_id', 'desc')
                ->get();
        $view = view('patient/patient_info');
        $view->with('patient', $patient);
        $view->with('doctor_name', $doctor_name);
        $view->with('prescriptions', $prescriptons);
        return $view;
    }

    public function getAgeFromBirthDate($birthDate) {
        $birth_year = Date('Y', strtotime($birthDate));
        $current_year = Date('Y', strtotime("+6 hours"));
        $age = $current_year - $birth_year;
        return $age;
    }

    public function viewPrescription($id) {
        $prescription = Prescription::where('prescription_id', $id)->first();
        $patient = Patient::find($prescription->patient_id);
        $patient->age = $this->getAgeFromBirthDate($patient->date_of_birth);
        $symptoms = PrescriptionSymptom::where('prescription_id', $prescription->prescription_id)->get();
        $medicines = PrescriptionMedicine::where('prescription_id', $prescription->prescription_id)
                ->join('medicines', 'prescription_medicines.medicine_id', '=', 'medicines.id')
                ->select('prescription_medicines.*', 'medicines.*')
                ->get();
        $tests = PrescriptionTest::where('prescription_id', $prescription->prescription_id)
                ->join('medical_tests', 'prescription_tests.test_id', '=', 'medical_tests.id')
                ->select('prescription_tests.*', 'medical_tests.*')
                ->get();
        $view = view('patient/view_prescription');
        $view->with('heading', 'View Prescription');
        $view->with('prescription', $prescription);
        $view->with('patient', $patient);
        $view->with('symptoms', $symptoms);
        $view->with('medicines', $medicines);
        $view->with('tests', $tests);
        return $view;
    }

    public function addPrescription($patient_id) {
        $patient = Patient::find($patient_id);
        $doctor_id = 1;
        $tests = MedicalTest::where('deletation_status', FALSE)->where('publication_status', TRUE)->get();
        $patient->age = $this->getAgeFromBirthDate($patient->date_of_birth);
        $temp_symptoms = TempPrescriptionSymptom::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->get();
        $temp_medicines = TempPrescriptionMedicine::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->get();
        $temp_tests = TempPrescriptionTest::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->get();
        $view = view('patient/add_prescription');
        $view->with('heading', 'New Prescription');
        $view->with('patient', $patient);
        $view->with('tests', $tests);
        $view->with('doctor_id', $doctor_id);
        $view->with('temp_symptoms', $temp_symptoms);
        $view->with('temp_medicines', $temp_medicines);
        $view->with('temp_tests', $temp_tests);
        return $view;
    }

    public function addSymptomToPrescription(Request $request) {
        $input = $request->all();
        $input['created_by'] = 1;
        if (TempPrescriptionSymptom::create($input)) {
            return redirect()->back();
        }
    }

    public function deleteSymptomFromPrescription($id) {
        TempPrescriptionSymptom::find($id)->delete();
        return redirect()->back();
    }

    public function addMedicineToPrescription(Request $request) {
        $input = $request->all();
        $input['created_by'] = 1;
        if (TempPrescriptionMedicine::create($input)) {
            return redirect()->back();
        }
    }

    public function deleteMedicineFromPrescription($id) {
        TempPrescriptionMedicine::find($id)->delete();
        return redirect()->back();
    }

    public function addTestToPrescription(Request $request) {
        $input = $request->all();
        $input['created_by'] = 1;
        if (TempPrescriptionTest::create($input)) {
            return redirect()->back();
        }
    }

    public function deleteTestFromPrescription($id) {
        TempPrescriptionTest::find($id)->delete();
        return redirect()->back();
    }

    public function deleteAllFromPrescription() {
        $patient_id = Session::get('patient_id');
        $doctor_id = 1;
        TempPrescriptionSymptom::where('patient_id', $patient_id)
                ->where('doctor_id', $doctor_id)->delete();
        TempPrescriptionMedicine::where('patient_id', $patient_id)
                ->where('doctor_id', $doctor_id)->delete();
        TempPrescriptionTest::where('patient_id', $patient_id)
                ->where('doctor_id', $doctor_id)->delete();
        return redirect()->back();
    }

    public function savePrescription($patient_id) {
        $prescription_id = time();
        $doctor_id = 1;
        $this->saveSymptom($prescription_id, $patient_id, $doctor_id);
        $this->saveMedicine($prescription_id, $patient_id, $doctor_id);
        $this->saveTest($prescription_id, $patient_id, $doctor_id);
        Prescription::create([
            'prescription_id' => $prescription_id,
            'patient_id' => $patient_id,
            'doctor_id' => $doctor_id,
            'date' => date('Y-m-d', strtotime('+6 hours')),
        ]);
        return redirect()->route('view_prescription', ['id' => $prescription_id]);
    }

    private function saveSymptom($prescription_id, $patient_id, $doctor_id) {
        $temp_symptom = TempPrescriptionSymptom::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->get();
        foreach ($temp_symptom as $item) {
            PrescriptionSymptom::create([
                'prescription_id' => $prescription_id,
                'symptom' => $item->symptom,
                'created_by' => 1,
            ]);
        }
        TempPrescriptionSymptom::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->delete();
    }

    private function saveMedicine($prescription_id, $patient_id, $doctor_id) {
        $temp_medicine = TempPrescriptionMedicine::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->get();
        foreach ($temp_medicine as $item) {
            PrescriptionMedicine::create([
                'prescription_id' => $prescription_id,
                'medicine_id' => $item->medicine_id,
                'course_duration' => $item->course_duration,
                'course_period' => $item->course_period,
                'taking_policy' => $item->taking_policy,
                'created_by' => 1,
            ]);
        }
        TempPrescriptionMedicine::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->delete();
    }

    private function saveTest($prescription_id, $patient_id, $doctor_id) {
        $temp_test = TempPrescriptionTest::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->get();
        foreach ($temp_test as $item) {
            PrescriptionTest::create([
                'prescription_id' => $prescription_id,
                'test_id' => $item->test_id,
                'created_by' => 1,
            ]);
        }
        TempPrescriptionTest::where('patient_id', $patient_id)
                        ->where('doctor_id', $doctor_id)->delete();
    }

}
