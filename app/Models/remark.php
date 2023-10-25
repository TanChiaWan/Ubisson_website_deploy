<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class remark extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'remark_id';
    protected $foreignKey = 'patient_id';


    protected $fillable = [
        
        'remark_image',
        'remark_file',
        'remark_date',
        'remark_status',
        'remark_comment',
    ];



}
