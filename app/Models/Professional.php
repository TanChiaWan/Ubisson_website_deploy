<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Professional extends Model implements Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,HasRoles;

    protected $primaryKey = 'professional_id';
    protected $foreignKey = 'organizationid_FK';

    protected $fillable = [
        'organizationid_FK',
        'organization_name',
        'professional_name',
        'professional_gender',
        'professional_mobile_phone',
        'professional_organization',
        'professional_image',
        'username',
        'password',
        'professional_email_address',
        'professional_type_of_profession',
        'professional_account_role',
        'permissions',
        'status'
    ];

    protected $hidden = [
        'password',
        'permissions',
        'remember_token',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizationid');
    }

    // Implement the Authenticatable interface methods
    public function getAuthIdentifierName()
    {
        return 'organizationid_FK';
    }

    public function getAuthIdentifier()
    {
        return $this->{$this->getAuthIdentifierName()};
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null;
    }

    public function setRememberToken($value)
    {
        // do nothing
    }

    public function getRememberTokenName()
    {
        return null;
    }
}
