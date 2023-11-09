<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diagnosis;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\Professional;
use App\Models\Remark;
use App\Models\ChatMessage;
use App\Models\Medication;
use App\Models\Allergy;
use App\Models\MedicationInDiagnosis;
class DiagnosisController extends Controller
{
    public function storeDiagnosisAndMedication(Request $request)
{
    // Validate the form data for diagnosis and medication
    $request->validate([
        'diagnosisTitle' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'severity' => 'required|in:Low,Moderate,Extreme',
        'medication_id' => 'required|exists:medication,id',
        'dosage' => 'required',
        'taken' => 'required',
    ]);

    // Create a new diagnosis
    $diagnosis = new Diagnosis();
    $diagnosis->patient_id_FK = $request->input('patient_id');
    $diagnosis->professional_id = $request->input('professional_id');
    $diagnosis->diagnosis_title = $request->input('diagnosisTitle');
    $diagnosis->diagnosis_startdate = $request->input('startDate');
    $diagnosis->diagnosis_enddate = $request->input('endDate');
    $diagnosis->severity = $request->input('severity');
    $diagnosis->diagnosiscreated_date = now();
    $diagnosis->diagnosisupdated_date = now();
    $diagnosis->taken_period = $request->input('date_taken') ?: '-';
    $diagnosis->active = $request->input('active');
    
    if (is_null($request->input('active'))){
        $diagnosis->active = 0;
    }else{
        $diagnosis->active = 1;
    }
    $diagnosis->save();

    // Create a new MedicationInDiagnosis record
    MedicationInDiagnosis::create([
        'medication_id' => $request->input('medication_id'),
        'diagnosis_id' => $diagnosis->diagnosis_id, // Use the ID of the newly created diagnosis
        'dosage' => $request->input('dosage'),
        'taken' => $request->input('taken'),
        // Add any other fields you want to save here
    ]);

    // Rest of your code for retrieving data and rendering the view
    $organizations = Organization::all();
    $chat_messages = ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = Patient::find($patientId);
    $user = Professional::find($professional_id);
    $remark = Remark::where('patient_id_FK', $patientId)->get();
    $professional = Professional::all();
    $allergy = Allergy::where('patient_id_FK', $patientId)->get();
    $singleallergy = Allergy::where('patient_id_FK', $patientId)->first();
    $diagnosis = Diagnosis::where('patient_id_FK', $patientId)->get();
    $medication = Medication::inRandomOrder()->first();
    $medicationindiagnosis   = MedicationInDiagnosis::all();
    // Redirect to your view with the necessary data
    return redirect()->route('medicationreport')->with([
    'patient' => $patient,
    'organizations' => $organizations,
    'user' => $user,
    'chat_messages' => $chat_messages,
    'remark' => $remark,
    'professional' => $professional,
    'allergy' => $allergy,
    'singleallergy' => $singleallergy,
    'diagnosis' => $diagnosis,
    'medication' => $medication,
    'medicationindiagnosis' => $medicationindiagnosis,
]);

}
public function storeDiagnosisAndMedicationorg(Request $request)
{

    // Validate the form data for diagnosis and medication
    $request->validate([
        'diagnosisTitle' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'severity' => 'required|in:Low,Moderate,Extreme',
        'medication_id' => 'required|exists:medication,id',
        
        'medication-type' => 'required',
        'dosage-unit' => 'required',
        'dosage-times' => 'required',
        'taken' => 'required|array',

        'taken_time' =>'required',
        'timesaday' =>'required',
    ]);

    // Create a new diagnosis
    $diagnosis = new Diagnosis();
    $diagnosis->patient_id_FK = $request->input('patient_id');
    $diagnosis->professional_id = $request->input('professional_id');
    $diagnosis->diagnosis_title = $request->input('diagnosisTitle');
    $diagnosis->diagnosis_startdate = $request->input('startDate');
    $diagnosis->diagnosis_enddate = $request->input('endDate');
    $diagnosis->severity = $request->input('severity');
    $diagnosis->diagnosiscreated_date = now();
    $diagnosis->diagnosisupdated_date = now();
    $diagnosis->taken_period = $request->input('date_taken') ?: '-';
    $diagnosis->active = $request->input('active');
    
    if (is_null($request->input('active'))){
        $diagnosis->active = 0;
    }else{
        $diagnosis->active = 1;
    }
    $diagnosis->save();
$medicationId = $request->input('medication_id');
    $dosageTimes = $request->input('dosage-times');
    $dosageUnit = $request->input('dosage-unit');
    $dosage = "$dosageTimes $dosageUnit";
    // Create a new MedicationInDiagnosis record
    MedicationInDiagnosis::create([
        'medication_id' => $request->input('medication_id'),
        'diagnosis_id' => $diagnosis->diagnosis_id, // Use the ID of the newly created diagnosis
        'dosage' => $dosage,
        'taken_time' => $request->input('taken_time'),
        'taken' => json_encode($request->input('taken')),
        'medicationtype' => $request->input('medication-type'),
        'timesaday' => $request->input('timesaday'),
        // Add any other fields you want to save here
    ]);

    // Rest of your code for retrieving data and rendering the view
    $organizations = Organization::all();
    $chat_messages = ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = Patient::find($patientId);
    $user = Professional::find($professional_id);
    $remark = Remark::where('patient_id_FK', $patientId)->get();
    $professional = Professional::all();
    $allergy = Allergy::where('patient_id_FK', $patientId)->get();
    $singleallergy = Allergy::where('patient_id_FK', $patientId)->first();
    $diagnosis = Diagnosis::where('patient_id_FK', $patientId)->get();
    $medication = Medication::inRandomOrder()->first();
    $medicationindiagnosis   = MedicationInDiagnosis::all();
    // Redirect to your view with the necessary data
    return redirect()->route('medicationreportorg')->with([
    'patient' => $patient,
    'organizations' => $organizations,
    'user' => $user,
    'chat_messages' => $chat_messages,
    'remark' => $remark,
    'professional' => $professional,
    'allergy' => $allergy,
    'singleallergy' => $singleallergy,
    'diagnosis' => $diagnosis,
    'medication' => $medication,
    'medicationindiagnosis' => $medicationindiagnosis,
]);

}
public function updateDiagnosisAndMedication(Request $request, $diagnosisId)
{
    // Validate the form data for diagnosis and medication
    $request->validate([
        'diagnosisTitle' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'severity' => 'required|in:Low,Moderate,Extreme',
        
    ]);

    // Fetch the existing diagnosis record
    $diagnosis = Diagnosis::find($diagnosisId);

    if (!$diagnosis) {
        // Handle the case where the diagnosis doesn't exist
        return redirect()->route('medication')->with('error', 'Diagnosis not found.');
    }

    // Update the diagnosis attributes
    $diagnosis->diagnosis_title = $request->input('diagnosisTitle');
    $diagnosis->diagnosis_startdate = $request->input('startDate');
    $diagnosis->diagnosis_enddate = $request->input('endDate');
    $diagnosis->severity = $request->input('severity');

    $diagnosis->taken_period = $request->input('date_taken') ?: '-';
    $diagnosis->active = $request->input('active');

    if (is_null($request->input('active'))){
        $diagnosis->active = 0;
    }else{
        $diagnosis->active = 1;
    }
    
    $diagnosis->diagnosisupdated_date = now();

    // Save the updated diagnosis
    $diagnosis->save();

    // Redirect back to the diagnosis view or another appropriate page
    $organizations = Organization::all();
    $chat_messages = ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = Patient::find($patientId);
    $user = Professional::find($professional_id);
    $remark = Remark::where('patient_id_FK', $patientId)->get();
    $professional = Professional::all();
    $allergy = Allergy::where('patient_id_FK', $patientId)->get();
    $singleallergy = Allergy::where('patient_id_FK', $patientId)->first();
    $diagnosis = Diagnosis::where('patient_id_FK', $patientId)->get();
    $medication = Medication::inRandomOrder()->first();
    $medicationindiagnosis   = MedicationInDiagnosis::all();
    // Redirect to your view with the necessary data
    return redirect()->route('medicationreport')->with([
        'patient' => $patient,
        'organizations' => $organizations,
        'user' => $user,
        'chat_messages' => $chat_messages,
        'remark' => $remark,
        'professional' => $professional,
        'allergy' => $allergy,
        'singleallergy' => $singleallergy,
        'diagnosis' => $diagnosis,
        'medication' => $medication,
        'medicationindiagnosis' => $medicationindiagnosis,
    ]);
}

public function updateDiagnosisAndMedicationorg(Request $request)
{
  
    // Validate the form data for diagnosis and medication
    $request->validate([
        'diagnosisTitle' => 'required|string',
        'startDate' => 'required|date',
        'endDate' => 'required|date',
        'severity' => 'required|in:Low,Moderate,Extreme',
        
    ]);
    $diagnosisId = session('diagnosisId');
    // Fetch the existing diagnosis record
    $diagnosis = Diagnosis::find($diagnosisId);

    if (!$diagnosis) {
        // Handle the case where the diagnosis doesn't exist
        return redirect()->route('medication')->with('error', 'Diagnosis not found.');
    }

    // Update the diagnosis attributes
    $diagnosis->diagnosis_title = $request->input('diagnosisTitle');
    $diagnosis->diagnosis_startdate = $request->input('startDate');
    $diagnosis->diagnosis_enddate = $request->input('endDate');
    $diagnosis->severity = $request->input('severity');

    $diagnosis->taken_period = $request->input('date_taken') ?: '-';
    $diagnosis->active = $request->input('active');

    if (is_null($request->input('active'))){
        $diagnosis->active = 0;
    }else{
        $diagnosis->active = 1;
    }
    
    $diagnosis->diagnosisupdated_date = now();

    // Save the updated diagnosis
    $diagnosis->save();

    // Redirect back to the diagnosis view or another appropriate page
    $organizations = Organization::all();
    $chat_messages = ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = Patient::find($patientId);
    $user = Professional::find($professional_id);
    $remark = Remark::where('patient_id_FK', $patientId)->get();
    $professional = Professional::all();
    $allergy = Allergy::where('patient_id_FK', $patientId)->get();
    $singleallergy = Allergy::where('patient_id_FK', $patientId)->first();
    $diagnosis = Diagnosis::where('patient_id_FK', $patientId)->get();
    $medication = Medication::inRandomOrder()->first();
    $medicationindiagnosis   = MedicationInDiagnosis::all();
    // Redirect to your view with the necessary data
    return redirect()->route('medicationreportorg')->with([
        'patient' => $patient,
        'organizations' => $organizations,
        'user' => $user,
        'chat_messages' => $chat_messages,
        'remark' => $remark,
        'professional' => $professional,
        'allergy' => $allergy,
        'singleallergy' => $singleallergy,
        'diagnosis' => $diagnosis,
        'medication' => $medication,
        'medicationindiagnosis' => $medicationindiagnosis,
    ]);
}
public function updateActiveStatus(Request $request, $diagnosisId)
{ 
    $affectedRows = Diagnosis::where('diagnosis_id', $diagnosisId)
        ->update(['active' => $request->input('active')]);

    if ($affectedRows > 0) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }
}
public function updateInUseStatus(Request $request, $diagnosisId)
{
 
    $affectedRows = Diagnosis::where('diagnosis_id', $diagnosisId)
    ->update(['inuse' => $request->input('inuse')]);
    if ($affectedRows > 0) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }

}



}
