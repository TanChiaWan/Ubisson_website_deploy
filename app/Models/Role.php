<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class role extends Model
{
    public $timestamps = false;
    use HasApiTokens, HasFactory, Notifiable;
    protected $primaryKey = 'role_id';
    protected $foreignKey ='permission_id_FK';
    protected $foreignKey2 = 'professional_id_FK';
    protected $foreignKey3 = 'role_organization';
    protected $fillable = [
        'role_name',
        'role_organization',
        'permissions',
    ];
    protected $casts = [
        'permissions' => 'json',
    ];
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
}
