<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class allergy extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'allergy_id';
    protected $foreignkey = 'patient_id';
    protected $fillable = [
        
        'allergy_name',
        'allergy_symptoms',
        'allergy_severity',
    ];

    protected $hidden = [
        'allergy_symptoms',
        'allergy_severity',
    ];
}
