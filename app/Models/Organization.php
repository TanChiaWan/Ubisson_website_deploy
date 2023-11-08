<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class organization extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'organizationid';
    protected $fillable = [
        'organizationid',
        'organization_name',
        'customized_login_url',
        'address',
        'organization_mobile_phone',
        'administrator_name',
        'administrator_username',
        'administrator_email_address',
        'prefer_language',
        'region',
        'blood_glucose_unit',
        'other_unit',
    ];

     public function professionals()
    {
        return $this->hasMany(Professional::class, 'organizationid');
    }

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
