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
    protected $foreignKey = 'professional_id';

    protected $fillable = [
    'permission_name',
    'permission_category',
    'permissions',
    ];

    protected $hidden = [
        'permissions',
    ];
}
