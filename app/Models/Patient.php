<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class patient extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'patient_id';
    protected $foreignKey = 'organizationid';
    protected $foreignKey2 = 'organization_name';
    protected $fillable = [
        'organization_name',
        'patient_number',
        'patient_image',
        'patient_name',
        'patient_gender',
        'patient_age',
        'diabetes_type',
        'date_of_birth',
        'date_of_diagnosis',
        'patient_phonenum',
        'emergencypersonname',
        'emergencypersonphonenum',
        'targetBG_low_BC',
        'targetBG_high_BC',
        'targetBG_low_AC',
        'targetBG_high_AC',
        'targetBG_low_BT',
        'targetBG_high_BT',
        'targethba1c',
        'mincarb',
        'maxcarb',
        'minweight',
        'maxweight',
        'minbmi',
        'maxbmi',
        'totalactivity',
    ];
    

    protected $hidden = [
        'patient_number',
        'patient_image',
        'patient_gender',
        'date_of_birth',

        'emergencypersonname',
        'emergencypersonphonenum'
    ];

    
}
