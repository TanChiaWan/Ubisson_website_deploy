<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\practicegroup;
use App\Models\patientingroup;
use App\Models\professionalingroup;
use Illuminate\Support\Facades\DB;
use App\Models\Professional;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\patient;
use App\Models\logbook;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PracticeGroupExport;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class TableController extends Controller
{
    public function index()
    {
        $organizations = Organization::select('organizationid', 'organization_name', 'customized_login_url', 'administrator_name')->get();
        return view('all_organization', ['organizations'=>$organizations]);
    }

    public function index2()
{
    $professionals = Professional::select( 'professional_id','professional_name', 'professional_email_address', 'professional_account_role','status')->get();
    return view('all_user', ['professionals' => $professionals]);
}
public function index3()
{   
    $organizations = Organization::All();
    $roles = Role::All();
    return view('all_role', ['roles' => $roles],['organizations' => $organizations]);
}
public function index4()
{
    $permissions = Permission::select('name', 'permission_category', 'created_at', 'updated_at')->get();
    return view('all_permission', ['permissions' => $permissions]);
}
public function index5()
{
    $patients = Patient::select('patient_id', 'patient_name', 'organization_name', 'patient_age', 'diabetes_type', 'date_of_diagnosis')->get();
    return view('all_patient', ['patients' => $patients]);
}
public function index5org($organization_id)
{
    $patients = Patient::select('patient_id', 'patient_name', 'organization_name', 'patient_age', 'diabetes_type', 'date_of_diagnosis')
        ->where('organizationid_FK', $organization_id)
        ->get();
        
    return view('/orgadminview/orgall_patient', ['patients' => $patients]);
}

public function index6org($organization_id)
{
    $patient = Patient::select('patient_id', 'patient_name', 'organization_name', 'patient_age', 'diabetes_type', 'date_of_diagnosis')
    ->where('organizationid_FK', $organization_id)
    ->get();
    $patients = Patient::select('patient_id','patient_name', 'patient_age','patient_phonenum','organization_name')->get();
    return view('/orgadminview/orgall_patient2',['patient' => $patient],['patients' => $patients]);
}
public function index7()
{

    return view('createorg');
}

public function index8()
{
    $roles = Role::all();
    return view('createuser',  ['roles' => $roles]);
}



public function show()
{
    $user = Auth::user();
    $organizationid_FK = $user->organizationid_FK;

    $professional = Professional::where('organizationid_FK', $organizationid_FK)->first();

    $organization = null;
    if ($professional) {
        $organization = Organization::find($professional->organizationid_FK);
    }

    return view('myorganization', [
        'organization' => $organization,
        'professional' => $professional,
    ]);
}




    public function index11()
{$organizations = Organization::select('organizationid', 'organization_name')->get();
    $patient = Patient::all();
    return view('createpatient',['organizations' => $organizations],['patient' => $patient]);
}

public function index12()
{

    return view('myaboutpatient');
}

public function index13()
{

    return view('editpage');
}
public function showOrganization($professionalId)
{
    $professional = Professional::with('organization')->find($professionalId);
    $organization = $professional->organization;
    return view('organization', compact('professional'));
}

public function viewhyper()
{

    return view('hyper');
}
public function viewhypo()
{

    return view('hypo');
}

public function viewhyperreport()
{

    return view('hyperreport');
}

public function viewhyporeport()
{

    return view('hyporeport');
}

public function logbook()
{

    $patients = Patient::all();
    return view('logbook_bg', ['patients' => $patients]);
}

public function logbook2()
{

    $patients = Patient::all();
    return view('logbook_bp', ['patients' => $patients]);
}

public function healthdata()
{

    $patients = Patient::all();
    return view('healthdata', ['patients' => $patients]);
}
public function index14()
{

    return view('createpermission');
}




public function index17()
{

    return view('practice_group_add');
}

public function index19()
{
    $patient = Patient::select('patient_id', 'patient_name', 'organization_name', 'patient_age', 'diabetes_type', 'date_of_diagnosis')->get();
    $patientingroup = patientingroup::all();
    $practicegroup = practicegroup::all();
    return view('practice_group_add_patient',compact('patient', 'practicegroup','patientingroup'));
    
}
public function dashboard_bg()
{

    $patients = Patient::all();
    return view('dashboard_bg', ['patients' => $patients]);
}
public function dashboard_bp()
{

    $patients = Patient::all();
    return view('dashboard_bp', ['patients' => $patients]);
}
public function dashboard_cho()
{

    $patients = Patient::all();
    return view('dashboard_cholesterol', ['patients' => $patients]);
}
public function dashboard_general()
{

    $patients = Patient::all();
    return view('dashboard_general', ['patients' => $patients]);
}


public function practicegroup()
{
    $patientingroup = patientingroup::all();
    $practice_groups = PracticeGroup::all();
    $professionalingroup = professionalingroup::all();
    $patient = Patient::all();
    $logbook = logbook::all();
    
    return view('practice_group_home', [
        'practice_groups' => $practice_groups,
        'patientingroup' => $patientingroup,
        'professionalingroup' => $professionalingroup,
        'patient' => $patient,
        'logbook' => $logbook,
    ]);
}


public function addPatientInGroup(Request $request, $practice_group_id)
{
    // Retrieve the practice group based on the $practice_group_id
    $practicegroup = PracticeGroup::find($practice_group_id);

    // Retrieve the array of patient IDs from the request
    $patient_ids = $request->input('patient_id');

    // Get the existing patient_in_group records for the practice group
    $existing_records = PatientInGroup::where('group_id', $practicegroup->practice_group_id)->get();
    $new_patient_ids = [];

    if (!empty($patient_ids)) {
        // Array to store the IDs of existing patients in the group
        $existing_patient_ids = $existing_records->pluck('patient_id')->toArray();

        // Loop through the $patient_ids array and process each patient
        foreach ($patient_ids as $patient_id) {
            // Check if the patient is already in the group
            if (!in_array($patient_id, $existing_patient_ids)) {
                // If the patient is not in the group, create a new record
                $patientInGroup = new PatientInGroup;
                $patientInGroup->patient_id = $patient_id;
                $patientInGroup->group_id = $practicegroup->practice_group_id;
                $patientInGroup->save();
            }
            $new_patient_ids[] = $patient_id;
        }
    }

    // Loop through the existing records and check if they are still selected
    if ($existing_records) {
        foreach ($existing_records as $existing_record) {
            if (!in_array($existing_record->patient_id, $new_patient_ids)) {
                $existing_record->delete();
            }
        }
    }

    return redirect()->route('practice_group_detail', ['practice_group_id' => $practicegroup->practice_group_id]);
}



public function addProfessionalInGroup(Request $request, $practice_group_id)
{
    // Retrieve the practice group based on the $practice_group_id
    $practicegroup = PracticeGroup::find($practice_group_id);

    // Retrieve the array of professional IDs from the request
    $professional_ids = $request->input('professional_id');
 // Get the existing professional_in_group records for the practice group
 $existing_records = ProfessionalInGroup::where('group_id', $practicegroup->practice_group_id)->get();
 // Array to store the IDs of new professionals
 $new_professional_ids = [];
    // Check if professional_ids array is not empty
    if (!empty($professional_ids)) {
       

        // Array to store the IDs of existing professionals in the group
        $existing_professional_ids = $existing_records->pluck('user_id')->toArray();

        

        // Loop through the $professional_ids array and process each professional
        foreach ($professional_ids as $professional_id) {
            // Check if the professional is already in the group
            if (!in_array($professional_id, $existing_professional_ids)) {
                // If the professional is not in the group, create a new record
                $professionalInGroup = new ProfessionalInGroup;
                $professionalInGroup->user_id = $professional_id;
                $professionalInGroup->group_id = $practicegroup->practice_group_id;
                $professionalInGroup->save();
            }
            $new_professional_ids[] = $professional_id;
        }
    }
        // Check if there are existing records
        if ($existing_records) {
            // Loop through the existing records and check if they are still selected
            foreach ($existing_records as $existing_record) {
                if (!in_array($existing_record->user_id, $new_professional_ids)) {
                    $existing_record->delete();
                }
            }
        }
    

    return redirect()->route('practice_group_detail', ['practice_group_id' => $practicegroup->practice_group_id]);
}

public function deletePracticeGroup($practice_group_id)
{
    // Find the practice group by its ID
    $practiceGroup = PracticeGroup::find($practice_group_id);

    // Check if the practice group exists
    if ($practiceGroup) {
        // Delete the practice group
        $practiceGroup->delete();

        // Optionally, you can also delete associated records
        // For example, if there are professional_in_group records associated with the practice group:
        ProfessionalInGroup::where('group_id', $practice_group_id)->delete();
        PatientInGroup::where('group_id', $practice_group_id)->delete();

        // Similarly, you can delete other associated records (e.g., patient_in_group)

        // Redirect or perform any other actions after successful deletion
        return redirect()->route('practicegroup')->with('success', 'Practice group deleted successfully.');
    } else {
        // Handle the case when the practice group does not exist
        return redirect()->route('practicegroup')->with('error', 'Practice group not found.');
    }
}

public function orgpracticegroup($organization_id)
{
    $patientingroup = patientingroup::all();
    $practice_groups = PracticeGroup::all() ->where('organizationid_FK', $organization_id)->get();
    $professionalingroup = professionalingroup::all();
    $patient = Patient::all();
    $logbook = logbook::all();
    
    return view('/orgadminview/orgpractice_group_home', [
        'practice_groups' => $practice_groups,
        'patientingroup' => $patientingroup,
        'professionalingroup' => $professionalingroup,
        'patient' => $patient,
        'logbook' => $logbook,
    ]);
}


public function orgaddPatientInGroup(Request $request, $practice_group_id)
{
    // Retrieve the practice group based on the $practice_group_id
    $practicegroup = PracticeGroup::find($practice_group_id);

    // Retrieve the array of patient IDs from the request
    $patient_ids = $request->input('patient_id');

    // Get the existing patient_in_group records for the practice group
    $existing_records = PatientInGroup::where('group_id', $practicegroup->practice_group_id)->get();
    $new_patient_ids = [];

    if (!empty($patient_ids)) {
        // Array to store the IDs of existing patients in the group
        $existing_patient_ids = $existing_records->pluck('patient_id')->toArray();

        // Loop through the $patient_ids array and process each patient
        foreach ($patient_ids as $patient_id) {
            // Check if the patient is already in the group
            if (!in_array($patient_id, $existing_patient_ids)) {
                // If the patient is not in the group, create a new record
                $patientInGroup = new PatientInGroup;
                $patientInGroup->patient_id = $patient_id;
                $patientInGroup->group_id = $practicegroup->practice_group_id;
                $patientInGroup->save();
            }
            $new_patient_ids[] = $patient_id;
        }
    }

    // Loop through the existing records and check if they are still selected
    if ($existing_records) {
        foreach ($existing_records as $existing_record) {
            if (!in_array($existing_record->patient_id, $new_patient_ids)) {
                $existing_record->delete();
            }
        }
    }

    return redirect()->route('orgpractice_group_detail', ['practice_group_id' => $practicegroup->practice_group_id]);
}



public function orgaddProfessionalInGroup(Request $request, $practice_group_id)
{
    // Retrieve the practice group based on the $practice_group_id
    $practicegroup = PracticeGroup::find($practice_group_id);

    // Retrieve the array of professional IDs from the request
    $professional_ids = $request->input('professional_id');
 // Get the existing professional_in_group records for the practice group
 $existing_records = ProfessionalInGroup::where('group_id', $practicegroup->practice_group_id)->get();
 // Array to store the IDs of new professionals
 $new_professional_ids = [];
    // Check if professional_ids array is not empty
    if (!empty($professional_ids)) {
       

        // Array to store the IDs of existing professionals in the group
        $existing_professional_ids = $existing_records->pluck('user_id')->toArray();

        

        // Loop through the $professional_ids array and process each professional
        foreach ($professional_ids as $professional_id) {
            // Check if the professional is already in the group
            if (!in_array($professional_id, $existing_professional_ids)) {
                // If the professional is not in the group, create a new record
                $professionalInGroup = new ProfessionalInGroup;
                $professionalInGroup->user_id = $professional_id;
                $professionalInGroup->group_id = $practicegroup->practice_group_id;
                $professionalInGroup->save();
            }
            $new_professional_ids[] = $professional_id;
        }
    }
        // Check if there are existing records
        if ($existing_records) {
            // Loop through the existing records and check if they are still selected
            foreach ($existing_records as $existing_record) {
                if (!in_array($existing_record->user_id, $new_professional_ids)) {
                    $existing_record->delete();
                }
            }
        }
    

    return redirect()->route('orgpractice_group_detail', ['practice_group_id' => $practicegroup->practice_group_id]);
}

public function orgdeletePracticeGroup($practice_group_id)
{
    // Find the practice group by its ID
    $practiceGroup = PracticeGroup::find($practice_group_id);

    // Check if the practice group exists
    if ($practiceGroup) {
        // Delete the practice group
        $practiceGroup->delete();

        // Optionally, you can also delete associated records
        // For example, if there are professional_in_group records associated with the practice group:
        ProfessionalInGroup::where('group_id', $practice_group_id)->delete();
        PatientInGroup::where('group_id', $practice_group_id)->delete();

        // Similarly, you can delete other associated records (e.g., patient_in_group)

        // Redirect or perform any other actions after successful deletion
        return redirect()->route('orgpracticegroup')->with('success', 'Practice group deleted successfully.');
    } else {
        // Handle the case when the practice group does not exist
        return redirect()->route('orgpracticegroup')->with('error', 'Practice group not found.');
    }
}




public function export($practiceGroupId)
{
    // Fetch practice group data from the database
    $practiceGroup = PracticeGroup::find($practiceGroupId);

    if (!$practiceGroup) {
        // Practice group not found
        abort(404);
    }

    // Get the patients in the group with matching patient_id
    $patientIds = PatientInGroup::where('group_id', $practiceGroup->practice_group_id)->pluck('patient_id')->toArray();
    $patients = Patient::whereIn('patient_id', $patientIds)->get();

    // Define the CSV file name
    $fileName = 'practice_groups.csv';

    // Generate the CSV content
    $csvContent = $this->generateCsvContent($patients);

    // Store the CSV file in storage/app/public directory
    Storage::disk('public')->put($fileName, $csvContent);

    // Get the full path to the stored CSV file
    $filePath = Storage::disk('public')->path($fileName);

    // Return the CSV file as a download response
    return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
}

private function generateCsvContent($data)
{
    $csvContent = '';

    // Add the column headers to the CSV content
    $csvContent .= 'Name,Phone no.,Times,Ideal Range,Dangerous Range,Last Recorded,Date Added' . PHP_EOL;
    
    // Add the data rows to the CSV content
    foreach ($data as $row) {
        $patientInGroup = PatientInGroup::where('patient_id', $row->patient_id)->first();
        $practiceGroup = $patientInGroup ? PracticeGroup::find($patientInGroup->group_id) : null;
        $lastRecorded = $practiceGroup ? $practiceGroup->updated_at : '';
        $dateAdded = $practiceGroup ? $practiceGroup->created_at : '';
        $csvContent .= '"' . $row->patient_name . '","' . $row->patient_phonenum . '","' . $row->times . '","' . $row->ideal_range . '","' . $row->dangerous_range . '","' . $lastRecorded . '","' . $dateAdded . '"' . PHP_EOL;
    }

    return $csvContent;
}








}
