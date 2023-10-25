<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class permission extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'permission_id';


    protected $fillable = [
        'name',
        'guard_name',
    'permission_category',
    'permissions',
    ];

    protected $hidden = [
        'permissions',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function rolePermissions()
{
    return $this->belongsToMany(Role::class, 'role_has_permissions', 'permission_id', 'role_id')
                ->withPivot('organizationid')
                ->withTimestamps();
}
}
