<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\Patient;
use App\Models\Allergy;
use Illuminate\Http\Request;

class AllergyController extends Controller
{
    
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'allergy_name' => 'required|string',
            'allergy_symptoms' => 'required|string',
            'severity' => 'required|in:Low,Moderate,Extreme',
        ]);

        $allergy = new Allergy();
        $allergy->allergy_name = $request->input('allergy_name');
        $allergy->allergy_symptoms = $request->input('allergy_symptoms');
        $allergy->allergy_severity = $request->input('severity');
        $allergy->patient_id_FK = $request->input('patient_id');
        $allergy->allergycreated_date = Carbon::now(); // Set the current date and time
        $request->session()->put('patient_id', $request->input('patient_id'));
        $request->session()->put('professional_id', $request->input('professional_id'));
        $request->session()->put('patient', $patient); // Add 'patient' to the session
      
 
        $allergy->save();

        // Store the allergy information in the database
        // You can use the $validatedData to create a new allergy record
        
        // Redirect back or to a success page
        return redirect()->route('medicationreport')->with('success', 'Allergy information saved successfully.');
    }
    public function storeorg(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'allergy_name' => 'required|string',
        'allergy_symptoms' => 'required|string',
        'severity' => 'required|in:Low,Moderate,Extreme',
    ]);

    if (session()->has('patient_id')) {
        $patientId = session('patient_id');
    } elseif ($request->has('patient_id')) {
        $patientId = $request->input('patient_id');
    }
    if (session()->has('professional_id')) {
        $professional_id = session('professional_id');
        $professionalId = session('professionalId');
    } elseif ($request->has('professional_id')) {
        $professional_id = $request->input('professional_id');
        $professionalId = $request->input('professional_id');
    }
    
    if (session()->has('organizationid')) {
        $organizationid = session('organizationid');
        $organization_id = session('organizationid');
    } elseif ($request->has('organization_id')) {
        $organizationid = $request->input('organization_id');
        $organization_id = $request->input('organization_id');
    }
    
        session(['patient_id' => $patientId]);
        session(['organization_id' => $organizationid]);
        session(['organization_id' => $organization_id]);
        session(['professional_id' => $professional_id]);
        session(['professionalId' => $professionalId]);
    $patient = Patient::find($patientId);

    $allergy = new Allergy();
    $allergy->allergy_name = $request->input('allergy_name');
    $allergy->allergy_symptoms = $request->input('allergy_symptoms');
    $allergy->allergy_severity = $request->input('severity');
    $allergy->patient_id_FK = $patientId;
    $allergy->allergycreated_date = Carbon::now(); // Set the current date and time

  
    
    $allergy->save();

    return redirect()->route('medicationreportorg')->with('success', 'Allergy information saved successfully.');
}

}
