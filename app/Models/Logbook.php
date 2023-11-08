<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Logbook extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'logbook_id';
    protected $foreignkey = 'patient_id';
    protected $fillable = [
        'bp_logbook_date',
        'bp_level',
        'bp_period',
        'bp_pulse',
        'bg_logbook_date',
        'bg_level',
        'bg_period',
    ];

   
}
