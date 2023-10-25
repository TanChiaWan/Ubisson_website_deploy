<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medication extends Model
{
    protected $table = 'medication'; // Specify the correct table name
    
    protected $fillable = [
        'brand_name',
        'generic_name',
        'atc_classification',
        'formulation',
        'class',
        'company',
    ];
}
