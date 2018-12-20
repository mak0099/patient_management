<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionMedicine extends Model
{
    protected $fillable=[
      'prescription_id',  
      'medicine_id',  
      'course_duration',  
      'course_period',  
      'taking_policy',  
      'deletation_status',  
      'created_by',  
    ];
}
