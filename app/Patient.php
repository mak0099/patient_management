<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'patient_id', 
        'patient_name', 
        'verification_type', 
        'verification_number', 
        'phone_number', 
        'date_of_birth' , 
        'address', 
        'created_by', 
        'updated_by'
        ];
    
    
}
