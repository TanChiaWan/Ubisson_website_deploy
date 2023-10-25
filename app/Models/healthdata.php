<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class healthdata extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'healthdata_id';
    protected $foreignkey = 'patient_id';
    protected $fillable = [
        'weight',
        'height',
        'sbp',
        'dbp',
        'hr',
        'celcius',
        'fahrenheit',
        'operator',
        'ga',
        'instid',
        'testID',
        'a1cpercentage',
        'lotview',
        'cho',
        'hdl',
        'ldlc',
        'tg',
        'cpeptide',
        'ckdstage',
        'cre',
        'ua',
        'egfr',
        'acr',
        'ma',
        'pro',
        'upcr',
        'ca',
        'k',
        'na',
        'p',
        'gpt',
        'alt',
        'got',
        
    ];

    
}
