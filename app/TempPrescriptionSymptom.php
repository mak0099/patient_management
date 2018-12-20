<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPrescriptionSymptom extends Model
{
    protected $fillable=[
      'patient_id',  
      'doctor_id',  
      'symptom', 
      'deletation_status',  
      'created_by',  
    ];
}
