<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfessionalInGroup extends Model
{
    use HasFactory;
    protected $table = 'professional_in_groups';
    protected $primaryKey = 'id';
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'group_id',
    ];

    /**
     * Get the user associated with the professional in group.
     */
    public function user()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }

    /**
     * Get the group associated with the professional in group.
     */
    public function group()
    {
        return $this->belongsTo(PracticeGroup::class, 'practice_group_id');
    }
}