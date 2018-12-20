<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable=[
      'prescription_id',  
      'patient_id',  
      'doctor_id',  
      'location',  
      'date',    
      'deletation_status',  
      'created_by',  
      'updated_by',  
    ];
}
