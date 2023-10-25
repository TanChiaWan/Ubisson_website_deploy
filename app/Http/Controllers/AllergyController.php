<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
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
        // Add any other fields you may have
 
        $allergy->save();

        // Store the allergy information in the database
        // You can use the $validatedData to create a new allergy record
        
        // Redirect back or to a success page
        return redirect()->route('medicationreport')->with('success', 'Allergy information saved successfully.');
    }
}
