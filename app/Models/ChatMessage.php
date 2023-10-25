<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    use HasFactory;
    protected $fillable = ['sender_id', 'receiver_id', 'message'];

    public function sender()
    {
        return $this->belongsTo(Professional::class, 'professional_id');
    }

    public function receiver()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
