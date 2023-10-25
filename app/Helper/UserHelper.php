<?php

namespace App\Helpers;

use App\Models\Professional;

class UserHelper
{
    public static function findProfessional($professional_id)
    {
        return Professional::find($professional_id);
    }
}