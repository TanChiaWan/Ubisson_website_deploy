<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class diagnosis extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'diagnosis_id';
    protected $foreignkey = 'patient_id';
    protected $fillable = [
    'diagnosis_title',
    'diagnosis_startdate',
    'diagnosis_enddate',
    'severity',
    'status',
    'medication_name',
    'medication_dosage',
    'taken_period',
    'active',
    'mealtime'
    ];

    
}
