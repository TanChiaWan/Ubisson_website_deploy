<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicationInDiagnosis extends Model
{
    use HasFactory;

    protected $table = 'medication_in_diagnosis';
    protected $primaryKey = 'id';
    protected $fillable = [
        'medication_id',
        'diagnosis_id',
        'taken',
        'dosage',
        'timesaday',
        'medicationtype',
        'taken_time',
    ];
    

    public function patient()
    {
        return $this->belongsTo(Medication::class, 'medication_id');
    }

    public function group()
    {
        return $this->belongsTo(Diagnosis::class, 'diagnosis_id');
    }
}
