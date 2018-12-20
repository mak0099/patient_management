<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PrescriptionTest extends Model
{
    protected $fillable = [
        'prescription_id',
        'test_id',
        'deletation_status',
        'created_by'
    ];

}
