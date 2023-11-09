<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;
use App\Models\PracticeGroup;
use App\Models\Professional;
use App\Models\Logbook;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        
        $patient = Patient::All();
        $logbook = Logbook::All();
        $professionalsCount = Professional::count();
        $practicegroupCount = PracticeGroup::count();
        $patientsCount = Patient::count();
        $count = 0; // Initialize the counter variable
 $hyperbp = 0; // Initialize the first count variable for the first condition
$hyperbg = 0; // Initialize the second count variable for the second condition
$hypobp = 0; // Initialize the third count variable for the third condition
$hypobg = 0; // Initialize the fourth count variable for the fourth condition

foreach ($logbook as $index => $logbooks) {
    $patients = $patient->where('patient_id', $logbooks->patient_id_FK)->first();
    $bp_level2 = $logbooks->bp_level2; // Assuming this is the variable holding bp_level2
    $bp_level = $logbooks->bp_level;
    $bg_level = $logbooks->bg_level; // Assuming this is the variable holding bg_level

    // First condition
    if (($bp_level2 > 80 || $bp_level > 120) && ($bp_level2 > 60 && $bp_level > 90)) {
        $hyperbp++;
    }

    // Second condition
    if ($bg_level > 7.8) {
        $hyperbg++;
    }

    // Third condition
    if (($bp_level2 < 60 || $bp_level < 90) && ($bp_level2 < 80 && $bp_level < 120)) {
        $hypobp++;
    }

    // Fourth condition
    if ($patients && ($bg_level < 4.0)) {
        $hypobg++;
    }
}
        return view('home', [
            'hyperbg' => $hyperbg,
            'hyperbp' => $hyperbp,
            'hypobg' => $hypobg,
            'hypobp' => $hypobp,
            'count' => $count,
            'patient' => $patient,
            'logbook' => $logbook,
            'patientsCount' => $patientsCount,
            'professionalsCount' => $professionalsCount,
            'practicegroupCount' => $practicegroupCount,
        ]);
    }



}
