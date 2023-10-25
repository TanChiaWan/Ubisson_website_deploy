<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInGroup extends Model
{
    use HasFactory;

    protected $table = 'patient_in_groups';
    protected $primaryKey = 'id';
    protected $fillable = [
        'organizationid',
        'patient_id',
        'group_id',
    ];
    
    // Define relationships with other models
    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizationid');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function group()
    {
        return $this->belongsTo(PracticeGroup::class, 'group_id');
    }
}
