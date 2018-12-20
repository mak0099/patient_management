<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TempPrescriptionTest extends Model {

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'test_id',
        'deletation_status',
        'created_by'
    ];

}
