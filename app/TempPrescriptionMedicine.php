<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPrescriptionMedicine extends Model
{
    protected $fillable=[
      'patient_id',  
      'doctor_id',  
      'medicine_id',  
      'course_duration',  
      'course_period',  
      'taking_policy',  
      'deletation_status',  
      'created_by',  
    ];
}
