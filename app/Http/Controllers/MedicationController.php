<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Medication; 
use App\Models\Diagnosis;
use App\Models\MedicationInDiagnosis;
class MedicationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'brand_name' => 'required|string',
            'generic_name' => 'required|string',
            'atc_classification' => 'required|string',
            'formulation' => 'required|string',
        ]);
    
        // Check if the medication already exists in the database
        $existingMedication = Medication::where([
            'brand_name' => $validatedData['brand_name'],
            'generic_name' => $validatedData['generic_name'],
            'atc_classification' => $validatedData['atc_classification'],
            'formulation' => $validatedData['formulation'],
        ])->first();
        
        if ($existingMedication) {
            return redirect()->route('medication_list')->with('error', 'Medication already exists.');
        }

        // Create a new medication record
        Medication::create($validatedData);

        return redirect()->route('medication_list')->with('success', 'Medication added successfully.');
    }

    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'brand_name' => 'required|string',
        'generic_name' => 'required|string',
        'atc_classification' => 'required|string',
        'formulation' => 'required|string',
    ]);

    $medication = Medication::findOrFail($id);
    $existingMedication = Medication::where([
        'brand_name' => $validatedData['brand_name'],
        'generic_name' => $validatedData['generic_name'],
        'atc_classification' => $validatedData['atc_classification'],
        'formulation' => $validatedData['formulation'],
    ])->first();
    
    if ($existingMedication) {
        return response()->json(['error' => 'Medication already exists.'], 422); // Return error response
    }
    
    $medication->update([
        'brand_name' => $validatedData['brand_name'],
        'generic_name' => $validatedData['generic_name'],
        'atc_classification' => $validatedData['atc_classification'],
        'formulation' => $validatedData['formulation'],
    ]);

    return response()->json(['success' => 'Medication updated successfully.']); // Return success response
}

public function saveMedication(Request $request)
{

    // Validate the form data (you can add more validation rules)
    $request->validate([
        'medication_id' => 'required|exists:medication,id',
        'dosage' => 'required',
        'taken' => 'required', // Add any other validation rules here
    ]);

    // Access the selected medication_id and brand_name
    $medicationId = $request->input('medication_id');
    

    // Create a new MedicationInDiagnosis record
    MedicationInDiagnosis::create([
        'medication_id' => $request->input('medication_id'),
        'diagnosis_id' => $request->input('diagnosis_id'),
        'dosage' => $request->input('dosage'),
        'taken' => $request->input('taken'),
        // Add any other fields you want to save here
    ]);

    // Redirect back or to a specific page after saving
    return redirect()->route('medicationreport')->with('success', 'Medication added successfully');
}


}
