<?php

namespace App\Http\Controllers;
use App\Models\Patient;
use App\Models\Professional;
use Illuminate\Http\Request;
use App\Models\Remark;
class RemarkController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'file' => 'nullable|file|mimes:pdf,doc,docx,csv,xlsx',
            'datetime' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'required|in:Critical Situation,Recovery,Discharge',
            'notes' => 'nullable|string',
        ]);
        $remark = new Remark();
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
       
        $patient = Patient::find($patientId);
        $user = Professional::find($professional_id);
        $remark->patient_id_FK = $request->input('patient_id'); // Replace 'patient_id' with your actual input name
        
        $remark->professional_id = $request->input('professional_id'); // Replace 'professional_id' with your actual input name
        $remark->remark_comment = $request->input('notes');
        $remark->remark_created_date = $request->input('datetime');
        $remark->status = $request->input('status');
        $request->session()->put('patient_id', $request->input('patient_id'));
        $request->session()->put('professional_id', $request->input('professional_id'));
        // Handle file uploads
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('remark_images', 'public');
            $remark->remark_image = $imagePath;
        }

        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $originalFileName = $uploadedFile->getClientOriginalName();
            
            // Store the uploaded file with its original name in the 'public' disk under the 'remark_files' directory
            $filePath = $uploadedFile->storeAs('remark_files', $originalFileName, 'public');
            
            $remark->remark_file = $filePath;
        }
       
        $remark->save();

        // Process the form data and save it to the database
        // ...
    
        return redirect()->route('remark')->with([
            'patient' => $patient,
            'user' => $user,
        ]);


    }
    public function submitForms(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'file' => 'nullable|file|mimes:pdf,doc,docx,csv,xlsx',
            'datetime' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'required|in:Critical Situation,Recovery,Discharge',
            'notes' => 'nullable|string',
        ]);

        $remark = new Remark();
        if (session()->has('patient')) {
            $patient = session('patient');
            $patientId = $patient->patient_id;
        } else {
            $patientId = session('patient_id');
            $patient = Patient::find($patientId);
        }
    
    $user = session('authenticated_user');
    $professionalId = $user->professional_id;
        $organizationid = session('organization_id');
        $remark->patient_id_FK = $patientId;
        $remark->professional_id =  $professionalId;
        $remark->remark_comment = $request->input('notes');
        $remark->remark_created_date = $request->input('datetime');
        $remark->status = $request->input('status');
        $request->session()->put('patient_id', $request->input('patient_id'));
        $request->session()->put('professional_id', $request->input('professional_id'));
        $request->session()->put('patient', $patient); // Add 'patient' to the session
      
        // Handle file uploads
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('remark_images', 'public');
            $remark->remark_image = $imagePath;
        }
    
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $originalFileName = $uploadedFile->getClientOriginalName();
    
            // Store the uploaded file with its original name in the 'public' disk under the 'remark_files' directory
            $filePath = $uploadedFile->storeAs('remark_files', $originalFileName, 'public');
    
            $remark->remark_file = $filePath;
        }
    
        $remark->save();
 
        return redirect()->route('remarkorg');
    }
    
}
