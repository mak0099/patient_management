<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'medicine_name',
        'group_name',
        'company_name',
        'unit',
        'publication_status',
        'deletation_status',
        'created_by',
        'updated_by',
    ];
}
