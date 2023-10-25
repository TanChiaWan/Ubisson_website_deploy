<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class PracticeGroup extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $primaryKey = 'practice_group_id';
    protected $foreignKey = 'organizationid_FK';
    protected $fillable = [
        
        'name',
        'subTitle',
        'dangerHigh',
        'dangerLow',
        'thread_id',
    ];

    protected $casts = [
        'dangerHigh' => 'decimal:1',
        'dangerLow' => 'decimal:1',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class, 'organizationid_');
    }
    
    // If you want to use timestamps
    public $timestamps = true;
}
