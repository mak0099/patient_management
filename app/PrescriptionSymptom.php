<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionSymptom extends Model
{
    protected $fillable=[
      'prescription_id',  
      'symptom', 
      'deletation_status',  
      'created_by',  
    ];
}
