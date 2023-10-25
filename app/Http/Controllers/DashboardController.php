<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\PracticeGroup;
use App\Models\Professional;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       
        $professionalsCount = Professional::count();
        $practicegroupCount = PracticeGroup::count();
        $patientsCount = Patient::count();

        return view('home', [
                
            'patientsCount' => $patientsCount,
            'professionalsCount' => $professionalsCount,
            'practicegroupCount' => $practicegroupCount,
        ]);
    }
}
