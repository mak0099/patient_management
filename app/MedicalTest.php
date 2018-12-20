<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalTest extends Model
{
    protected $fillable = [
        'test_name',
        'test_code',
        'test_category',
        'publication_status',
        'deletation_status',
        'created_by',
        'updated_by',
    ];
}
