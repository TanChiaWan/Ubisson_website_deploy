<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use App\Models\PracticeGroup;
use App\Models\patientingroup;
use App\Models\healthdata;
use App\Models\medication;
use App\Models\allergy;
use App\Models\professionalingroup;
use Illuminate\Support\Facades\DB;
use App\Models\Professional;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Patient;
use App\Models\Logbook;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PracticeGroupExport;

use PhpOffice\PhpSpreadsheet\Reader\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

    use Illuminate\Support\Facades\Validator;



class TableController extends Controller
{
    public function index()
    {
        $organizationCount = Organization::count();
        $organizations = Organization::select('organizationid', 'organization_name', 'customized_login_url', 'administrator_name')->get();
        return view('all_organization', ['organizations'=>$organizations, 'organizationCount'=>$organizationCount]);
    }

    public function index2()
{
    $userCount = Professional::count();
    $professionals = Professional::all();
    return view('all_user', ['professionals' => $professionals, 'userCount' => $userCount]);
}
public function index3()
{   
    $roleCount = Role::count();
    $organizations = Organization::all();
    $roles = Role::all();
    return view('all_role', ['roles' => $roles, 'organizations' => $organizations, 'roleCount' => $roleCount]);
}

public function index4()
{
    $permissionCount = Permission::count();
    $permissions = Permission::select('name', 'permission_category', 'created_at', 'updated_at')->get();
    return view('all_permission', ['permissions' => $permissions, 'permissionCount' => $permissionCount]);
}
public function index5()
{
    $patients = Patient::select('patient_id', 'patient_name', 'organization_name', 'patient_age', 'diabetes_type', 'date_of_diagnosis')->get();
    return view('all_patient', ['patients' => $patients]);
}
public function index5org($organizationid)
{
    $patients = Patient::select('patient_id', 'patient_name', 'organization_name', 'patient_age', 'diabetes_type', 'date_of_diagnosis')
        ->where('organizationid_FK', $organizationid)
        ->get();
    $user = session('authenticated_user');
    return view('/orgadminview/orgall_patient', ['patients' => $patients, 'organizationid' => $organizationid, 'user' => $user]);
}
public function index6()
{
    $patients = Patient::all();
    return view('all_patient2', ['patients' => $patients]);
}

public function index6org($organization_id)
{
    $patient = Patient::select('patient_id', 'patient_name', 'organization_name', 'patient_age', 'diabetes_type', 'date_of_diagnosis')
        ->where('organizationid_FK', $organization_id)
        ->get();
        
    $patients = Patient::select('patient_id', 'patient_name', 'patient_age', 'patient_phonenum', 'organization_name')
        ->get();
        
    return view('/orgadminview/orgall_patient2', [
        'patient' => $patient,
        'patients' => $patients,
        'organizationid' => $organization_id
    ]);
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
    $professional_id = $user->professional_id;

    $professional = Professional::where('organizationid_FK', $organizationid_FK)
    ->where('professional_id', $professional_id)
    ->first();

    $organization = null;
    if ($professional) {
        $organization = Organization::find($professional->organizationid_FK);
    }

    return view('myorganization', [
        'organization' => $organization,
        'professional' => $professional,
    ]);
}

public function show2()
{
    $user = Auth::user();
    $organizationid_FK = $user->organizationid_FK;
    $professional_id = $user->professional_id;
    $professional = Professional::where('organizationid_FK', $organizationid_FK)
                           ->where('professional_id', $professional_id)
                           ->first();

    dd(  $professional);
    $organization = null;
    if ($professional) {
        $organization = Organization::find($professional->organizationid_FK);
    }

    return view('myprofile', [
        'organization' => $organization,
        'professional' => $professional,
    ]);
}




    public function index11()
{$organizations = Organization::select('organizationid', 'organization_name')->get();
    $patient = Patient::all();
    return view('createpatient',['organizations' => $organizations],['patient' => $patient]);
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
    $patients = patient::all();
    $criteria1 = '0';
    $criteria2 = '0';
    $criteria3 = '0';
    $criteria4 = '0';
    $results = Logbook::all();
    $results2 = Logbook::all();
    return view('hyper', ['results' => $results,'criteria1' => $criteria1, 'criteria2' => $criteria2,'criteria3' => $criteria3, 'criteria4' => $criteria4,'results2' => $results2,'patients' => $patients]);
}
public function viewhypo()
{
    $patients = patient::all();
    $criteria1 = '0';
    $criteria2 = '0';
    $criteria3 = '0';
    $criteria4 = '0';
    $results = Logbook::all();
    $results2 = Logbook::all();
    return view('hypo', ['results' => $results,'criteria1' => $criteria1, 'criteria2' => $criteria2,'criteria3' => $criteria3, 'criteria4' => $criteria4,'results2' => $results2,'patients' => $patients]);

}

public function viewhyperreport(Request $request)
{
    $bgLevels = $request->query('bg_level');
    $bpLevels = $request->query('bp_level');
    $bpLevels2 = $request->query('bp_level2');
    $period = $request->query('period');
    $bg_period = $request->query('bg_period');
    $criteria1 = $request->query('criteria1');
    $criteria2 = $request->query('criteria2');
    $criteria3 = $request->query('criteria3');
    $criteria4 = $request->query('criteria4');
    $bg_logbook_date = $request->query('bg_logbook_date');
    $bp_logbook_date = $request->query('bp_logbook_date');
   
        // Fetch the necessary dat
        

        // Pass the data to the view
        return view('hyperreport', compact('bgLevels', 'bpLevels', 'bpLevels2', 'bg_logbook_date','bp_logbook_date','criteria1','criteria2','criteria3','criteria4','period','bg_period'));

    

}

public function viewhyporeport(Request $request)
{

    $bgLevels = $request->query('bg_level');
    $bpLevels = $request->query('bp_level');
    $bpLevels2 = $request->query('bp_level2');
    $period = $request->query('period');
    $bg_period = $request->query('bg_period');
    $criteria1 = $request->query('criteria1');
    $criteria2 = $request->query('criteria2');
    $criteria3 = $request->query('criteria3');
    $criteria4 = $request->query('criteria4');
    $bg_logbook_date = $request->query('bg_logbook_date');
    $bp_logbook_date = $request->query('bp_logbook_date');
   
        // Fetch the necessary dat
        

        // Pass the data to the view
        return view('hyporeport', compact('bgLevels', 'bpLevels', 'bpLevels2', 'bg_logbook_date','bp_logbook_date','criteria1','criteria2','criteria3','criteria4','period','bg_period'));

    

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
public function practice($organizationid)
{

    return view('/orgadminview/practice_group_add',['organizationid'=>$organizationid]);
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
    $practicegroupCount = PracticeGroup::count();
    
    return view('practice_group_home', [
        'practicegroupCount' => $practicegroupCount,
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
    $practice_groups = PracticeGroup::where('organizationid_FK', $organization_id)->get();

    $professionalingroup = professionalingroup::all();
    $patient = Patient::all();
    $logbook = logbook::all();
    $practicegroupCount = PracticeGroup::where('organizationid_FK', $organization_id)->count();
    return view('/orgadminview/practice_group_home', [
        'practicegroupCount' => $practicegroupCount,
        'practice_groups' => $practice_groups,
        'patientingroup' => $patientingroup,
        'professionalingroup' => $professionalingroup,
        'patient' => $patient,
        'logbook' => $logbook,
        'organizationid' => $organization_id
    ]);
}


public function orgaddPatientInGroup(Request $request, $practice_group_id,$organization_id)
{
    // Retrieve the practice group based on the $practice_group_id
    $practiceGroup = PracticeGroup::find($practice_group_id)
    ->where('organizationid_FK', $organization_id)
    ->first();

    // Retrieve the array of patient IDs from the request
    $patient_ids = $request->input('patient_id');

    // Get the existing patient_in_group records for the practice group
    $existing_records = PatientInGroup::where('group_id', $practiceGroup->practice_group_id)->get();
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
                $patientInGroup->group_id = $practiceGroup->practice_group_id;
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

    return redirect()->route('orgpractice_group_detail', ['practice_group_id' => $practiceGroup->practice_group_id, 'organization_id' => $organization_id]);

}



public function orgaddProfessionalInGroup(Request $request, $practice_group_id,$organization_id)
{
    // Retrieve the practice group based on the $practice_group_id
    $practiceGroup = PracticeGroup::find($practice_group_id)
    ->where('organizationid_FK', $organization_id)
    ->first();
    // Retrieve the array of professional IDs from the request
    $professional_ids = $request->input('professional_id');
 // Get the existing professional_in_group records for the practice group
 $existing_records = ProfessionalInGroup::where('group_id', $practiceGroup->practice_group_id)->get();
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
                $professionalInGroup->group_id = $practiceGroup->practice_group_id;
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
    

        return redirect()->route('orgpractice_group_detail', ['practice_group_id' => $practiceGroup->practice_group_id, 'organization_id' => $organization_id]);
}

public function orgdeletePracticeGroup($practice_group_id,$organization_id)
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
        return redirect()->route('orgpracticegroup', ['organization_id' => $organization_id])
        ->with('success', 'Practice group deleted successfully.');
    } else {
        // Handle the case when the practice group does not exist
        return redirect()->route('orgpracticegroup',[ 'organizationid' => $organization_id])->with('error', 'Practice group not found.');
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
    $fileName = $practiceGroup->name . '.csv';


    // Generate the CSV content
    $csvContent = $this->generateCsvContent($patients);

    // Store the CSV file in storage/app/public directory
    Storage::disk('public')->put($fileName, $csvContent);

    // Get the full path to the stored CSV file
    $filePath = Storage::disk('public')->path($fileName);

    // Return the CSV file as a download response
    return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
}

public function exportorg($practiceGroupId,$organization_id)
{
    // Fetch practice group data from the database
    $practiceGroup = PracticeGroup::find($practice_group_id)
    ->where('organizationid_FK', $organization_id)
    ->first();
    if (!$practiceGroup) {
        // Practice group not found
        abort(404);
    }

    // Get the patients in the group with matching patient_id
    $patientIds = PatientInGroup::where('group_id', $practiceGroup->practice_group_id)->pluck('patient_id')->toArray();
    $patients = Patient::whereIn('patient_id', $patientIds)->get();

    // Define the CSV file name
    $fileName = $practiceGroup->name . '.csv';


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
    $csvContent .= 'Name,Phone no.,Dangerous Event(Total), Dangerous Low Event,Dangerous High Event,Ideal Range,Dangerous Range(Low),Dangerous Range(High),Last Recorded,Date Added' . PHP_EOL;
    
    // Add the data rows to the CSV content
    foreach ($data as $row) {
        $patientInGroup = PatientInGroup::where('patient_id', $row->patient_id)->first();
        $practiceGroup = $patientInGroup ? PracticeGroup::find($patientInGroup->group_id) : null;
        $lastRecorded = $practiceGroup ? $practiceGroup->updated_at : '';
        $dateAdded = $practiceGroup ? $practiceGroup->created_at : '';
        $csvContent .= '"' . $row->patient_name . '","' . $row->patient_phonenum . '","' . $row->triggertimes . '","' . $row->dangerLow . '","' . $row->dangerHigh . '","' . $row->idealrangeBG_low . ' to ' . $row->idealrangeBG_high . '","' . $row->dangerousrangeBG_low . ' to ' . $row->dangerousrangeBG_high . '","' . $lastRecorded . '","' . $dateAdded . '"' . PHP_EOL;

    }

    return $csvContent;
}

public function exports($patientId)
{
    // Fetch patient data from the database
    $patient = Patient::where('patient_id', $patientId)->get();
    $patientname = Patient::where('patient_id', $patientId)->select('patient_name')->get();
    $patients = healthdata::where('patient_id_FK', $patientId)->get();

    // Define the CSV file name
    $fileName = $patient[0]['patient_name'] . '.csv'; // Assuming $patients is a collection

    // Generate the CSV content
    $csvContent = $this->generateCsvContents($patients);

    // Store the CSV file in storage/app/public directory
    Storage::disk('public')->put($fileName, $csvContent);

    // Get the full path to the stored CSV file
    $filePath = Storage::disk('public')->path($fileName);

    // Return the CSV file as a download response
    return response()->download($filePath, $fileName)->deleteFileAfterSend(true);
}

private function generateCsvContents($patients)
{
    $csvContent = '';

    // Add the column headers to the CSV content
    $csvContent .= '"Data Originate","Date","Weight","Height","SBP/DBP","HR","Celcius","Fahrenheit","Operator","GA","CHO","HDL","LDLC","TG","Cpeptide","CKD Stage","CRE","UA","eGFR","ACR","MA","PRO","UPCR","CA","K","NA","P","GPT/ALT","GOT"' . PHP_EOL;

    // Add the data rows to the CSV content
    foreach ($patients as $data) {
       
        $csvContent .= '"Patient","' . $data->date . '","' . $data->weight . '","' . $data->height . '","' . $data->sbp . '/' . $data->dbp . '","' . $data->hr . '","' . $data->celcius . '","' . $data->fahrenheit . '","' . $data->operator . '","' . $data->ga . '","' . $data->cho . '","' . $data->hdl . '","' . $data->ldlc . '","' . $data->tg . '","' . $data->cpeptide . '","' . $data->ckdstage . '","' . $data->cre . '","' . $data->ua . '","' . $data->egfr . '","' . $data->acr . '","' . $data->ma . '","' . $data->pro . '","' . $data->upcr . '","' . $data->ca . '","' . $data->k . '","' . $data->na . '","' . $data->p . '","' . $data->gpt . '/' . $data->alt . '","' . $data->got . '"' . PHP_EOL;
    }

    return $csvContent;
}

public function deletehealthdata(Request $request)
{
    $patientId = $request->input('patient_id');
    $healthdataId = $request->input('healthdata_id');
    $patient = Patient::find($patientId);
    // Find the healthdata based on patient_id and healthdata_id
    $healthdata2 = healthdata::where('patient_id_FK', $patientId)
        ->where('healthdata_id', $healthdataId)
        ->first();
        $healthdata = healthdata::all();
        $singleHealthData = healthdata::where('patient_id_FK', $patientId)->first();
    // Check if the healthdata exists
    if ($healthdata2) {
        // Delete the healthdata
        $healthdata2->delete();

        // Redirect to a success page or the same form page
        return view('healthdata', ['patientId' => $patientId,'patient' => $patient,'singleHealthData' => $singleHealthData,'healthdata'=>$healthdata ]);
    } else {
        // Handle the case when the healthdata does not exist
        return view('healthdata', ['patientId' => $patientId,'patient' => $patient,'singleHealthData' => $singleHealthData,'healthdata'=>$healthdata ]);

    }
}
public function deletemedication($medicationId)
{
    // Find the healthdata based on patient_id and healthdata_id
    $medication = medication::where('id', $medicationId)->first();

    // Check if the healthdata exists
    if ($medication) {
        // Delete the healthdata
        $medication->delete();
        return redirect()->route('medication_list');
    } else {
        // Handle the case when the healthdata does not exist
        return redirect()->route('medication_list')
            ->with('error', 'Medication not found.');
    }
}

public function deleteallergy(Request $request,$patientId, $allergy_Id,$professionalId)
{
    
   
    // Find the healthdata based on patient_id and healthdata_id
    $allergy = allergy::where('patient_id_FK', $patientId)
        ->where('allergy_id', $allergy_Id)
        ->first();
     
        $request->session()->put('patient_id', $request->input('patient_id'));
        $request->session()->put('professional_id', $request->input('professional_id'));
    $allergylist = allergy::where('patient_id_FK', $patientId)->get();
    // Check if the healthdata exists
    if ($allergy) {
        // Delete the healthdata
        $allergy->delete();
        return redirect()->route('medicationreport',compact('allergylist'))
            ->with('success', 'Health data deleted successfully.');
    } 
}

    
    
public function showForm()
{
    return view('import');
}


public function import(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,xls,csv',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('temp'); // Store the uploaded file temporarily

        $errors = []; // Initialize an empty array to collect errors

        try {
            // Load the Excel file using PhpSpreadsheet
            $spreadsheet = IOFactory::load(storage_path('app/' . $path));
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            if (count($data) > 0) {
                // Assuming your Excel file has columns 'name' and 'price'
                // Adjust column index based on your Excel file's structure

                // Skip the header row by starting the loop from index 1
                for ($i = 1; $i < count($data); $i++) {
                    $row = $data[$i];

                    // Check if 'organizationid_FK' and 'organization_name' exist in 'organizations' table
                    $organizationExists = DB::table('organizations')
                        ->where('organizationid', $row[0]) // Assuming 'organizations' table has 'id' column for 'organizationid_FK'
                        ->where('organization_name', $row[1])
                        ->exists();

                    // Check if 'professional_account_role' exists in 'roles' table
                    $accountRoleExists = DB::table('roles')
                        ->where('name', $row[9]) // Assuming 'roles' table has 'name' column for 'professional_account_role'
                        ->exists();
                    $nameExists = DB::table('professionals')
                        ->where('professional_name', $row[2]) // Assuming 'roles' table has 'name' column for 'professional_account_role'
                        ->exists();
                        $usernameExists = DB::table('professionals')
                        ->where('username', $row[5]) // Assuming 'roles' table has 'name' column for 'professional_account_role'
                        ->exists();
                    if (!$organizationExists || !$accountRoleExists || $nameExists || $usernameExists) {
                        $error = 'Invalid data in row ' . ($i + 1) . '. ';
                        if (!$organizationExists) {
                            $error .= 'Organization with ID ' . "'".$row[0]."'" . ' and Name ' . "'".$row[1]."'" . ' does not exist. ';
                        }
                        if (!$accountRoleExists) {
                            $error .= 'Account role ' . "'".$row[9]."'" . ' does not exist.';
                        }
                        if ($nameExists) {
                            $error .= 'Professional name ' . "'".$row[2]."'" . ' already exists.';
                        }
                        if ($usernameExists) {
                            $error .= 'Username ' . "'".$row[5]."'" . ' already exists.';
                        }
                        $errors[] = $error; // Add the error message to the errors array
                    } else {
                        // You can add more specific validation rules here if needed
                        // For example, check if email is valid, password meets requirements, etc.

                        DB::table('professionals')->insert([
                            'organizationid_FK' => $row[0],
                            'organization_name' => $row[1],
                            'professional_name' => $row[2],
                            'professional_gender' => $row[3],
                            'professional_mobile_phone' => $row[4],
                            'username' => $row[5], // Assuming username is in the 7th column
                            'password' => bcrypt($row[6]), // Assuming plain password is in the 8th column
                            'plain_password' => $row[6], // Assuming plain password is in the 8th column
                            'professional_email_address' => $row[7],
                            'professional_type_of_profession' => $row[8],
                            'professional_account_role' => $row[9],
                        ]);
                    }
                }
            }

            // Delete the temporary file after successful import
            \Storage::delete($path);

            if (!empty($errors)) {
                $errorMessage = implode('<br>', $errors); // Join the error messages with <br> tags
                return redirect()->back()->with('error', $errorMessage);
            }

            return redirect()->route('all_user')->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            // If any exception occurs during the import process, handle it here
            return redirect()->back()->with('error', 'Error reading the Excel file.');
        }
    }

    return redirect()->back()->with('error', 'No file selected.');
}


public function import_medication(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,xls',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $path = $file->store('temp'); // Store the uploaded file temporarily

        $errors = []; // Initialize an empty array to collect errors

        try {
            // Load the Excel file using PhpSpreadsheet
            $spreadsheet = IOFactory::load(storage_path('app/' . $path));
            $worksheet = $spreadsheet->getActiveSheet();
            $data = $worksheet->toArray();

            if (count($data) > 0) {
                // Assuming your Excel file has columns 'name' and 'price'
                // Adjust column index based on your Excel file's structure

                // Skip the header row by starting the loop from index 1
                for ($i = 1; $i < count($data); $i++) {
                    $row = $data[$i];

                    // Check if 'organizationid_FK' and 'organization_name' exist in 'organizations' table
                    $medicationExists = DB::table('medication')
                    
                        ->where('brand_name', $row[0])
                        ->exists();

                    
                    if ($medicationExists) {
                        $error = 'Invalid data in row ' . ($i + 1) . '. ';
                        if (!$medicationExists) {
                            $error .= 'Medicaiton Name ' . "'".$row[1]."'" . 'exist. ';
                        }
                        $errors[] = $error; // Add the error message to the errors array
                    } else {
                        // You can add more specific validation rules here if needed
                        // For example, check if email is valid, password meets requirements, etc.

                        DB::table('medication')->insert([
                            'brand_name' => $row[0],
                            'generic_name' => $row[1],
                            'atc_classification' => $row[2],
                            'formulation' => $row[3],
                            'class' => $row[4], // Assuming username is in the 7th column
                            'company' => $row[5], // Assuming plain password is in the 8th column
                            'dosage' => $row[6], // Assuming plain password is in the 8th column
                        
                        ]);
                    }
                }
            }

            // Delete the temporary file after successful import
            \Storage::delete($path);

            if (!empty($errors)) {
                $errorMessage = implode('<br>', $errors); // Join the error messages with <br> tags
                return redirect()->back()->with('error', $errorMessage);
            }

            return redirect()->route('medication_list')->with('success', 'Data imported successfully.');
        } catch (\Exception $e) {
            // If any exception occurs during the import process, handle it here
            return redirect()->back()->with('error', 'Error reading the Excel file.');
        }
    }

    return redirect()->back()->with('error', 'No file selected.');
}
public function downloadTemplate()
{
    // Create a new spreadsheet
    $spreadsheet = new Spreadsheet();

    // Set column headers
    $spreadsheet->getActiveSheet()->fromArray(["BRAND NAME", "GENERIC NAME", "ATC CLASSIFICATION", "FORMULATION", "CLASS", "COMPANY","DOSAGE"], null, 'A1');

    // Create a temporary file
    $tempFilePath = tempnam(sys_get_temp_dir(), 'template');
    
    // Save the spreadsheet as an XLSX file
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->save($tempFilePath);

    // Download the file as XLSX
    return response()->download($tempFilePath, 'empty_template.xlsx')->deleteFileAfterSend(true);
}

public function dashboard()
{

    return view('dashboard');
}

public function chatpage()
{

    return view('chat');
}



}
