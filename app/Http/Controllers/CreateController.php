<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Validation\Rule;
use App\Models\Organization;
use App\Models\Patient;
use App\Models\Healthdata;
use App\Models\Professional;
use App\Models\ChatMessage;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
class CreateController extends Controller
{
    
    public function insert(Request $request)
    {
        $organizationName = $request->input('organization_name');
        $customizedLoginUrl = $request->input('customized_login_url');
        $address = $request->input('address');
        $organizationMobilePhone = $request->input('organization_mobile_phone');
        $administratorName = $request->input('administrator_name');
        $administratorEmailAddress = $request->input('administrator_email_address');
        $administratorUsername = $request->input('administrator_username');
        $preferLanguage = $request->input('prefer_language');
        $region = $request->input('region');
        $bloodGlucoseUnit = $request->input('blood_glucose_unit');
        $otherUnit = $request->input('other_unit');

        $validator = Validator::make($request->all(), [
            'organization_name' => 'required|unique:organizations',
            'customized_login_url' => 'required|unique:organizations',
            'address' => 'required|unique:organizations',
            'organization_mobile_phone' => 'required|unique:organizations',
            'administrator_name' => 'required|unique:organizations',
            'administrator_email_address' => 'required|email|unique:organizations',
            'administrator_username' => 'required|unique:organizations',
            'prefer_language' => 'required',
            'region' => 'required',
            'blood_glucose_unit' => 'required',
            'other_unit' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        
        $data = [
            'organization_name' => $organizationName,
            'customized_login_url' => "/14.167.2.15/organization/$customizedLoginUrl",
            'address' => $address,
            'organization_mobile_phone' => $organizationMobilePhone,
            'administrator_name' => $administratorName,
            'administrator_email_address' => $administratorEmailAddress,
            'administrator_username' => $administratorUsername,
            'prefer_language' => $preferLanguage,
            'region' => $region,
            'blood_glucose_unit' => $bloodGlucoseUnit,
            'other_unit' => $otherUnit,
        ];
        
        DB::table('organizations')->insert($data);
        return redirect()->route('all_organization');
    }


public function insert2(Request $request)
{
    $patient_name = $request->input('patient_name');
    $patient_image = $request->input('patient_image');
    $patient_gender = $request->input('patient_gender');
    $diabetes_type = $request->input('diabetes_type');
    $organization_name = $request->input('organization_name');
    $date_of_birth = $request->input('date_of_birth');
    $patient_age = Carbon::parse($date_of_birth)->age;
    $date_of_diagnosis = $request->input('date_of_diagnosis');
    $patient_phonenum = $request->input('patient_phonenum');
    $patient_number = $request->input('patient_number');
    $emergencypersonname = $request->input('emergencypersonname');
    $emergencypersonphonenum = $request->input('emergencypersonphonenum');
    $imagePath = $request->file('patient_image')->store('patient_image', 'public');
    
    $data = [
        'patient_name' => $patient_name,
        'patient_image' => $imagePath,
        'patient_gender' => $patient_gender,
        'diabetes_type' => $diabetes_type,
        'organization_name' => $organization_name,
        'date_of_birth' => $date_of_birth,
        'date_of_diagnosis' => $date_of_diagnosis,
        'patient_phonenum' => $patient_phonenum,
        'patient_number' => $patient_number,
        'emergencypersonname' => $emergencypersonname,
        'patient_age' => $patient_age,
        'emergencypersonphonenum' => $emergencypersonphonenum,
    ];

    $validator = Validator::make($data, [
        'patient_name' => 'required|string|max:255',
        
        'patient_gender' => 'required|in:Male,Female',
        'diabetes_type' => 'required',
        'organization_name' => 'required',
        'date_of_birth' => 'required|date',
        'date_of_diagnosis' => 'required|date',
        'patient_phonenum' => 'required|string|max:20',
        'patient_number' => [
            'required',
            'integer',
            'max:255',
            Rule::unique('patients')->where(function ($query) use ($patient_number) {
                return $query->where('patient_number', $patient_number);
            }),
        ],
        'emergencypersonname' => 'required|string|max:255',
        'patient_age' => 'required|integer',
        'emergencypersonphonenum' => 'required|string|max:20',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::table('patients')->insert($data);
    return redirect()->route('all_patient');
}
public function insert2org(Request $request)
{
  
    $patient_name = $request->input('patient_name');
    $patient_image = $request->input('patient_image');
    $patient_gender = $request->input('patient_gender');
    $diabetes_type = $request->input('diabetes_type');
  
    $organization_id = $request->input('organization_id');
    
    $organization = Organization::find($organization_id);
    $organization_name = $organization->organization_name;
    $date_of_birth = $request->input('date_of_birth');
    $patient_age = Carbon::parse($date_of_birth)->age;
    $date_of_diagnosis = $request->input('date_of_diagnosis');
    $patient_phonenum = $request->input('patient_phonenum');
    $patient_number = $request->input('patient_number');
    $emergencypersonname = $request->input('emergencypersonname');
    $emergencypersonphonenum = $request->input('emergencypersonphonenum');
    $imagePath = $request->file('patient_image')->store('patient_image', 'public');
    
    $data = [
        'patient_name' => $patient_name,
        'patient_image' => $imagePath,
        'patient_gender' => $patient_gender,
        'diabetes_type' => $diabetes_type,
        'organizationid_FK' => $organization_id,
        'organization_name' => $organization_name,
        'date_of_birth' => $date_of_birth,
        'date_of_diagnosis' => $date_of_diagnosis,
        'patient_phonenum' => $patient_phonenum,
        'patient_number' => $patient_number,
        'emergencypersonname' => $emergencypersonname,
        'patient_age' => $patient_age,
        'emergencypersonphonenum' => $emergencypersonphonenum,
    ];

    $validator = Validator::make($data, [
        'patient_name' => 'required|string|max:255',
        'patient_image' => 'sometimes', // Make patient_image optional
        'patient_gender' => 'required|in:Male,Female',
        'diabetes_type' => 'required',
        'organization_name' => 'required',
        'date_of_birth' => 'required|date',
        'date_of_diagnosis' => 'required|date',
        'patient_phonenum' => 'required|string|max:20',
        'patient_number' => [
            'required',
            'integer',
            'max:255',
            Rule::unique('patients')->where(function ($query) use ($patient_number) {
                return $query->where('patient_number', $patient_number);
            }),
        ],
        'emergencypersonname' => 'required|string|max:255',
        'patient_age' => 'required|integer',
        'emergencypersonphonenum' => 'required|string|max:20',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    DB::table('patients')->insert($data);
    return redirect()->route('orgall_patients');
}


    public function update(Request $request, $patient_id)
    {
        
        $patients = Patient::findOrFail($patient_id);
        $patient_name = $request->input('patient_name');
        $patient_image = $request->input('patient_image');
        $patient_gender = $request->input('patient_gender');
        $diabetes_type = $request->input('diabetes_type');
        $organization_name = $request->input('organization_name');
        $date_of_birth = $request->input('date_of_birth');
        $patient_age = Carbon::parse($date_of_birth)->age;
        $date_of_diagnosis = $request->input('date_of_diagnosis');
        $patient_phonenum = $request->input('patient_phonenum');
        $patient_number = $request->input('patient_number');
        $emergencypersonname = $request->input('emergencypersonname');
        $emergencypersonphonenum = $request->input('emergencypersonphonenum');
        $validator = Validator::make($request->all(), [
            'patient_name' => 'required|string|max:255',
            'patient_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'patient_gender' => 'required|in:Male,Female',
            'diabetes_type' => 'required',
            'organization_name' => 'required',
            'date_of_birth' => 'required|date',
            'date_of_diagnosis' => 'required|date',
            'patient_phonenum' => 'required|string|max:20',
            'patient_number' => [
                'required',
                'integer',
                'max:255',
                Rule::unique('patients')->ignore($patients->patient_id,'patient_id'),
            ],
            'emergencypersonname' => 'required|string|max:255',
            'patient_age' => 'required|integer',
            'emergencypersonphonenum' => 'required|string|max:20',
        ]);
      
            $imagePath = $request->file('patient_image')->store('patient_image', 'public');
            $patients->patient_image = $imagePath;
            

        
        $data = [
            'patient_name' => $patient_name,
            'patient_image' =>  $imagePath,
            'patient_gender' => $patient_gender,
            'diabetes_type' => $diabetes_type,
            'organization_name' => $organization_name,
            'date_of_birth' => $date_of_birth,
            'date_of_diagnosis' => $date_of_diagnosis,
            'patient_phonenum' => $patient_phonenum,
            'patient_number' => $patient_number,
            'emergencypersonname' => $emergencypersonname,
            'patient_age' => $patient_age,
            'emergencypersonphonenum' => $emergencypersonphonenum,
        ];
        
        $selectedOrganizationId = $request->input('organization_name');
        $selectedOrganization = Organization::where('organizationid', $selectedOrganizationId)->first();
        $selectedOrganizationName = $selectedOrganization ? $selectedOrganization->organization_name : '';
    
        $data['organization_name'] = $selectedOrganizationName;
        






    $condition = [
        // Define your conditions here, for example:
        'patient_id' => $patient_id, // Assuming you have the patient ID available
    ];

    // Update the record in the 'patients' table based on the conditions
    DB::table('patients')->where($condition)->update($data);

    return redirect()->route('all_patient');
}
public function updateorg(Request $request)
{
  
    $patient = session('patient');
    $patient_id = $patient->patient_id;
    $patient_name = $request->input('patient_name');
    $patient_image = $request->input('current-image');
    $patient_gender = $request->input('patient_gender');
    $diabetes_type = $request->input('diabetes_type');
    $date_of_birth = $request->input('date_of_birth');
    $patient_age = Carbon::parse($date_of_birth)->age;
    $date_of_diagnosis = $request->input('date_of_diagnosis');
    $patient_phonenum = $request->input('patient_phonenum');
    $patient_number = $request->input('patient_number');
    $emergencypersonname = $request->input('emergencypersonname');
    $emergencypersonphonenum = $request->input('emergencypersonphonenum');
    $validator = Validator::make($request->all(), [
        'patient_name' => 'required|string|max:255',
        'patient_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'patient_gender' => 'required|in:Male,Female',
        'diabetes_type' => 'required',
        'organization_name' => 'required',
        'date_of_birth' => 'required|date',
        'date_of_diagnosis' => 'required|date',
        'patient_phonenum' => 'required|string|max:20',
        'patient_number' => [
            'required',
            'integer',
            'max:255',
            Rule::unique('patients')->ignore($patient->patient_id,'patient_id'),
        ],
        'emergencypersonname' => 'required|string|max:255',
        'patient_age' => 'required|integer',
        'emergencypersonphonenum' => 'required|string|max:20',
    ]);
  
    $currentImageURL = $request->input('current_image');
    $newImageFile = $request->file('new_image');
    
    if ($newImageFile) {
        // Handle uploading a new image
        $imagePath = $newImageFile->store('patient_image', 'public');
        $patient->patient_image = $imagePath;
    } else {
        // No new image was uploaded; keep the current image URL
        // Extract the file name part from the URL
        $patient->patient_image = 'patient_image/' . basename($currentImageURL);
        $imagePath = $patient->patient_image;
    }
    
        $organization_id = session('organizationid');
        $organization = Organization::where('organizationid', $organization_id)->first();
        
        if ($organization) {
            $organization_name = $organization->organization_name;

        }
        if ($patient) {
            $patient->organizationid_FK = $organization_id;
            $patient->patient_name = $patient_name;
            $patient->patient_image = $imagePath;
            $patient->patient_gender = $patient_gender;
            $patient->diabetes_type = $diabetes_type;
            $patient->organization_name = $organization_name;
            $patient->date_of_birth = $date_of_birth;
            $patient->date_of_diagnosis = $date_of_diagnosis;
            $patient->patient_phonenum = $patient_phonenum;
            $patient->patient_number = $patient_number;
            $patient->emergencypersonname = $emergencypersonname;
            $patient->patient_age = $patient_age;
            $patient->emergencypersonphonenum = $emergencypersonphonenum;
        
            $patient->save();
        }

return redirect()->route('aboutpatientorg');

}


public function updateglucosetargetorg(Request $request)
{

    if (session()->has('patient')) {
        $patient = session('patient');
        $patient_id = $patient->patient_id;
    } else {
        $patient_id = session('patient_id');
        $patient = Patient::find($patient_id);
    }
   

    $user = session('authenticated_user');

    // Example: Retrieving the input from the form
    $beforeComsumptionLB = $request->input('patient-update-glucosetarget-beforecomsumptionlb');
    $beforeComsumptionUB = $request->input('patient-update-glucosetarget-beforecomsumptionub');
    $afterComsumptionLB = $request->input('patient-update-glucosetarget-aftercomsumptionlb');
    $afterComsumptionUB = $request->input('patient-update-glucosetarget-aftercomsumptionub');
    $bedtimeLB = $request->input('patient-update-glucosetarget-bedtimelb');
    $bedtimeUB = $request->input('patient-update-glucosetarget-bedtimeub');
    $hba1c = $request->input('patient-update-glucosetarget-hba1c');

    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'patient-update-glucosetarget-beforecomsumptionlb' => 'required|numeric',
        'patient-update-glucosetarget-beforecomsumptionub' => 'required|numeric',
        'patient-update-glucosetarget-aftercomsumptionlb' => 'required|numeric',
        'patient-update-glucosetarget-aftercomsumptionub' => 'required|numeric',
        'patient-update-glucosetarget-bedtimelb' => 'required|numeric',
        'patient-update-glucosetarget-bedtimeub' => 'required|numeric',
        'patient-update-glucosetarget-hba1c' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Example: Update the health data in the database
    if ($patient) {
        $patient->targetBG_low_BC = $beforeComsumptionLB;
        $patient->targetBG_high_BC = $beforeComsumptionUB;
        $patient->targetBG_low_AC = $afterComsumptionLB;
        $patient->targetBG_high_AC = $afterComsumptionUB;
        $patient->targetBG_low_BT = $bedtimeLB;
        $patient->targetBG_high_BT = $bedtimeUB;
        $patient->targethba1c = $hba1c;
    
        $patient->save();
    }
  
    // Pass the patient information to the view
    return redirect()->route('aboutpatientorg');

}
public function update2(Request $request,$organizationid)
{
    
    $organizations = Organization::findOrFail($organizationid);
    $organizationName = $request->input('organization_name');
    $customizedLoginUrl = $request->input('customized_login_url');
    $address = $request->input('address');
    $organizationMobilePhone = $request->input('organization_mobile_phone');
    $administratorName = $request->input('administrator_name');
    $administratorEmailAddress = $request->input('administrator_email_address');
    $administratorUsername = $request->input('administrator_username');
    $preferLanguage = $request->input('prefer_language');
    $region = $request->input('region');
    $bloodGlucoseUnit = $request->input('blood_glucose_unit');
    $otherUnit = $request->input('other_unit');
    
    $validator = Validator::make($request->all(), [
        'organization_name' => [
            'required',
            Rule::unique('organizations')->ignore($organizations->organizationid,'organizationid'),
        ],
        'customized_login_url' => [
            'required',
            Rule::unique('organizations')->ignore($organizations->organizationid,'organizationid'),
        ],
        'address' => [
            'required',
            Rule::unique('organizations')->ignore($organizations->organizationid,'organizationid'),
        ],
        'organization_mobile_phone' => [
            'required',
            Rule::unique('organizations')->ignore($organizations->organizationid,'organizationid'),
        ],
        'administrator_name' => [
            'required',
            Rule::unique('organizations')->ignore($organizations->organizationid,'organizationid'),
        ],
        'administrator_email_address' => [
            'required',
            'email',
            Rule::unique('organizations')->ignore($organizations->organizationid,'organizationid'),
        ],
        'administrator_username' => [
            'required',
            Rule::unique('organizations')->ignore($organizations->organizationid,'organizationid'),
        ],
        'prefer_language' => 'required',
        'region' => 'required',
        'blood_glucose_unit' => 'required',
        'other_unit' => 'required',
    ]);
    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    
    $data = [
        'organization_name' => $organizationName,
        'customized_login_url' => "/14.167.2.15/organization/$customizedLoginUrl",
        'address' => $address,
        'organization_mobile_phone' => $organizationMobilePhone,
        'administrator_name' => $administratorName,
        'administrator_email_address' => $administratorEmailAddress,
        'administrator_username' => $administratorUsername,
        'prefer_language' => $preferLanguage,
        'region' => $region,
        'blood_glucose_unit' => $bloodGlucoseUnit,
        'other_unit' => $otherUnit,
    ];


    $condition = [
        // Define your conditions here, for example:
        'organizationid' => $organizationid, // Assuming you have the patient ID available
    ];
    $condition2 = [
        // Define your conditions here, for example:
        'organizationid_FK' => $organizationid, // Assuming you have the patient ID available
    ];

    // Update the record in the 'patients' table based on the conditions
    DB::table('organizations')->where($condition)->update($data);
    DB::table('professionals')
    ->where($condition2)
    ->update(['organizationid_FK' => $organizationid, 'organization_name' => $organizationName]);



    return redirect()->route('all_organization');
}

public function insert3(Request $request){
    {

        $name = $request->input('name');
        $permission_category = $request->input('permission_category');
        
        
        $data = [
            'name' => $name,
            'permission_category' => $permission_category,
            'guard_name' =>'web',
            'created_at' => Carbon::now(), // Set the current date and time as the created_at value
            'updated_at' => Carbon::now(), 
        ];
        DB::table('permissions')->insert($data);
        return redirect()->route('home');
    }
    

    
}

public function inserthealthdata(Request $request,$patient_id)
{
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    $patient = Patient::findOrFail($patient_id);
 
    $patients = Patient::findOrFail($patient_id);
    // Example: Retrieving the input from the form
    $recordedAt = $request->input('healthdata-add-datetime');
    $weight = $request->input('healthdata-add-weight');
    $height = $request->input('healthdata-add-height');
    $sbp = $request->input('healthdata-add-sbp');
    $dbp = $request->input('healthdata-add-dbp');
    $pulse = $request->input('healthdata-add-pulse');
    $celsius = $request->input('healthdata-add-celsius');
    $fahrenheit = $request->input('healthdata-add-fahrenheit');
    $a1cpercentage = $request->input('healthdata-add-a1cpercentage');
    $lotview = $request->input('healthdata-add-lotview');
    $instid = $request->input('healthdata-add-instid');
    $testID = $request->input('healthdata-add-testid');
    $operator = $request->input('healthdata-add-operator');
    $ga = $request->input('healthdata-add-ga');
    $cho = $request->input('healthdata-add-cho');
    $hdl = $request->input('healthdata-add-hdl');
    $ldlc = $request->input('healthdata-add-ldlc');
    $tg = $request->input('healthdata-add-tg');
    $cpeptide = $request->input('healthdata-add-cpeptide');
    $ckdstage = $request->input('healthdata-add-ckdstage');
    $cre = $request->input('healthdata-add-cre');
    $ua = $request->input('healthdata-add-ua');
    $egfr = $request->input('healthdata-add-egfr');
    $acr = $request->input('healthdata-add-acr');
    $ma = $request->input('healthdata-add-ma');
    $pro = $request->input('healthdata-add-pro');
    $upcr = $request->input('healthdata-add-upcr');
    $ca = $request->input('healthdata-add-ca');
    $k = $request->input('healthdata-add-k');
    $na = $request->input('healthdata-add-na');
    $p = $request->input('healthdata-add-p');
    $gptalt = $request->input('healthdata-add-gptalt');
    $got = $request->input('healthdata-add-got');

    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'healthdata-add-datetime' => 'required|date',
        'healthdata-add-weight' => 'required|numeric',
        'healthdata-add-height' => 'required|numeric',
        'healthdata-add-sbp' => 'required|numeric',
        'healthdata-add-dbp' => 'required|numeric',
        'healthdata-add-pulse' => 'required|numeric',
        'healthdata-add-celsius' => 'required|numeric',
        'healthdata-add-fahrenheit' => 'required|numeric',
        'healthdata-add-a1cpercentage' => 'required|numeric',
        'healthdata-add-lotview' => 'nullable|numeric',
        'healthdata-add-instid' => 'nullable|numeric',
        'healthdata-add-testid' => 'nullable|numeric',
        'healthdata-add-operator' => 'nullable|numeric',
        'healthdata-add-ga' => 'nullable|numeric',
        'healthdata-add-cho' => 'required|numeric',
        'healthdata-add-hdl' => 'required|numeric',
        'healthdata-add-ldlc' => 'required|numeric',
        'healthdata-add-tg' => 'required|numeric',
        'healthdata-add-cpeptide' => 'required|numeric',
        'healthdata-add-ckdstage' => 'required|numeric',
        'healthdata-add-cre' => 'required|numeric',
        'healthdata-add-ua' => 'required|numeric',
        'healthdata-add-egfr' => 'required|numeric',
        'healthdata-add-acr' => 'required|numeric',
        'healthdata-add-ma' => 'required|numeric',
        'healthdata-add-pro' => 'required|numeric',
        'healthdata-add-upcr' => 'required|numeric',
        'healthdata-add-ca' => 'required|numeric',
        'healthdata-add-k' => 'required|numeric',
        'healthdata-add-na' => 'required|numeric',
        'healthdata-add-p' => 'required|numeric',
        'healthdata-add-gptalt' => 'required|numeric',
        'healthdata-add-got' => 'required|numeric',
    ]);
    
    $condition = [
        // Define your conditions here, for example:
        'patient_id' => $patient_id, // Assuming you have the patient ID available
    ];

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Example: Prepare the data to be inserted into the database
    $healthData = [
        'patient_id_FK' => $patient_id,
        'date' => $recordedAt,
        'weight' => $weight,
        'height' => $height,
        'sbp' => $sbp,
        'dbp' => $dbp,
        'pulse' => $pulse,
        'celcius' => $celsius,
        'fahrenheit' => $fahrenheit,
        'a1cpercentage' => $a1cpercentage,
        'lotview' => $lotview,
        'instid' => $instid,
        'testID' => $testID,
        'operator' => $operator,
        'ga' => $ga,
        'cho' => $cho,
        'hdl' => $hdl,
        'ldlc' => $ldlc,
        'tg' => $tg,
        'cpeptide' => $cpeptide,
        'ckdstage' => $ckdstage,
        'cre' => $cre,
        'ua' => $ua,
        'egfr' => $egfr,
        'acr' => $acr,
        'ma' => $ma,
        'pro' => $pro,
        'upcr' => $upcr,
        'ca' => $ca,
        'k' => $k,
        'na' => $na,
        'p' => $p,
        'gpt/alt' => $gptalt,
        'got' => $got,
    
        'hr' => null,
        'tc' => null,
        'unit' => null,
    ];

    // Example: Insert the data into the database
    DB::table('healthdatas')->where($condition)->insert($healthData);
    $singleHealthData = Healthdata::where('patient_id_FK', $patientId)->first();
    $healthdata = Healthdata::all();
    // Redirect to a success page or the same form page
    return redirect()->route('healthdata')
    ->with('patientId', $patients->patient_id)
    ->with('patient', $patient)
    ->with('singleHealthData', $singleHealthData)
    ->with('healthdata', $healthdata);
}
public function updatehealthdata(Request $request, $patient_id, $healthdata_id)
{
 
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = Patient::find($patientId);
    $user = Professional::find($professional_id);

    // Retrieve the existing health data record by ID
    $singleHealthData = Healthdata::findOrFail($healthdata_id);

    // Example: Retrieving the input from the form
    $recordedAt = $request->input('healthdata-add-datetime');
 
    $weight = $request->input('healthdata-add-weight');
    $height = $request->input('healthdata-add-height');
    $sbp = $request->input('healthdata-add-sbp');
    $dbp = $request->input('healthdata-add-dbp');
    $pulse = $request->input('healthdata-add-pulse');
    $celsius = $request->input('healthdata-add-celsius');
    $fahrenheit = $request->input('healthdata-add-fahrenheit');
    $a1cpercentage = $request->input('healthdata-add-a1cpercentage');
    $lotview = $request->input('healthdata-add-lotview');
    $instid = $request->input('healthdata-add-instid');
    $testID = $request->input('healthdata-add-testid');
    $operator = $request->input('healthdata-add-operator');
    $ga = $request->input('healthdata-add-ga');
    $cho = $request->input('healthdata-add-cho');
    $hdl = $request->input('healthdata-add-hdl');
    $ldlc = $request->input('healthdata-add-ldlc');
    $tg = $request->input('healthdata-add-tg');
    $cpeptide = $request->input('healthdata-add-cpeptide');
    $ckdstage = $request->input('healthdata-add-ckdstage');
    $cre = $request->input('healthdata-add-cre');
    $ua = $request->input('healthdata-add-ua');
    $egfr = $request->input('healthdata-add-egfr');
    $acr = $request->input('healthdata-add-acr');
    $ma = $request->input('healthdata-add-ma');
    $pro = $request->input('healthdata-add-pro');
    $upcr = $request->input('healthdata-add-upcr');
    $ca = $request->input('healthdata-add-ca');
    $k = $request->input('healthdata-add-k');
    $na = $request->input('healthdata-add-na');
    $p = $request->input('healthdata-add-p');
    $gptalt = $request->input('healthdata-add-gptalt');
    $got = $request->input('healthdata-add-got');
    $condition = [
        // Define your conditions here, for example:
        'patient_id_FK' => $patient_id, // Assuming you have the patient ID available
    ];
    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'healthdata-add-datetime' => 'required|date',
        'healthdata-add-weight' => 'required|numeric',
        'healthdata-add-height' => 'required|numeric',
        'healthdata-add-sbp' => 'required|numeric',
        'healthdata-add-dbp' => 'required|numeric',
        'healthdata-add-pulse' => 'required|numeric',
        'healthdata-add-celsius' => 'required|numeric',
        'healthdata-add-fahrenheit' => 'required|numeric',
        'healthdata-add-a1cpercentage' => 'required|numeric',
        'healthdata-add-lotview' => 'nullable|numeric',
        'healthdata-add-instid' => 'nullable|numeric',
        'healthdata-add-testid' => 'nullable|numeric',
        'healthdata-add-operator' => 'nullable|numeric',
        'healthdata-add-ga' => 'nullable|numeric',
        'healthdata-add-cho' => 'required|numeric',
        'healthdata-add-hdl' => 'required|numeric',
        'healthdata-add-ldlc' => 'required|numeric',
        'healthdata-add-tg' => 'required|numeric',
        'healthdata-add-cpeptide' => 'required|numeric',
        'healthdata-add-ckdstage' => 'required|numeric',
        'healthdata-add-cre' => 'required|numeric',
        'healthdata-add-ua' => 'required|numeric',
        'healthdata-add-egfr' => 'required|numeric',
        'healthdata-add-acr' => 'required|numeric',
        'healthdata-add-ma' => 'required|numeric',
        'healthdata-add-pro' => 'required|numeric',
        'healthdata-add-upcr' => 'required|numeric',
        'healthdata-add-ca' => 'required|numeric',
        'healthdata-add-k' => 'required|numeric',
        'healthdata-add-na' => 'required|numeric',
        'healthdata-add-p' => 'required|numeric',
        'healthdata-add-gptalt' => 'required|numeric',
        'healthdata-add-got' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    DB::table('healthdatas')
    ->where($condition)
    ->where('healthdata_id', $healthdata_id)
    ->update([
        'date' => $recordedAt,
        'weight' => $weight,
        'height' => $height,
        'sbp' => $sbp,
        'dbp' => $dbp,
        'pulse' => $pulse,
        'celcius' => $celsius,
        'fahrenheit' => $fahrenheit,
        'a1cpercentage' => $a1cpercentage,
        'lotview' => $lotview,
        'instid' => $instid,
        'testID' => $testID,
        'operator' => $operator,
        'ga' => $ga,
        'cho' => $cho,
        'hdl' => $hdl,
        'ldlc' => $ldlc,
        'tg' => $tg,
        'cpeptide' => $cpeptide,
        'ckdstage' => $ckdstage,
        'cre' => $cre,
        'ua' => $ua,
        'egfr' => $egfr,
        'acr' => $acr,
        'ma' => $ma,
        'pro' => $pro,
        'upcr' => $upcr,
        'ca' => $ca,
        'k' => $k,
        'na' => $na,
        'p' => $p,
        'gpt/alt' => $gptalt,
        'got' => $got,
        // Update other fields as needed
    ]);


    // Example: Update the existing health data record
 

// Dump the updated record to verify

    $healthdata = Healthdata::all();

    // Redirect to a success page or the same form page
        return view('healthdata')->with([
            'patientId' => $patient->patient_id,
            'patient' => $patient,
            'singleHealthData' => $singleHealthData,
            'healthdata' => $healthdata,
        ]);
}

public function updatehealthdataorg(Request $request)
{
 
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = Patient::find($patientId);
    $user = Professional::find($professional_id);

    // Retrieve the existing health data record by ID
    $singleHealthData = Healthdata::findOrFail($healthdata_id);

    // Example: Retrieving the input from the form
    $recordedAt = $request->input('healthdata-add-datetime');
 
    $weight = $request->input('healthdata-add-weight');
    $height = $request->input('healthdata-add-height');
    $sbp = $request->input('healthdata-add-sbp');
    $dbp = $request->input('healthdata-add-dbp');
    $pulse = $request->input('healthdata-add-pulse');
    $celsius = $request->input('healthdata-add-celsius');
    $fahrenheit = $request->input('healthdata-add-fahrenheit');
    $a1cpercentage = $request->input('healthdata-add-a1cpercentage');
    $lotview = $request->input('healthdata-add-lotview');
    $instid = $request->input('healthdata-add-instid');
    $testID = $request->input('healthdata-add-testid');
    $operator = $request->input('healthdata-add-operator');
    $ga = $request->input('healthdata-add-ga');
    $cho = $request->input('healthdata-add-cho');
    $hdl = $request->input('healthdata-add-hdl');
    $ldlc = $request->input('healthdata-add-ldlc');
    $tg = $request->input('healthdata-add-tg');
    $cpeptide = $request->input('healthdata-add-cpeptide');
    $ckdstage = $request->input('healthdata-add-ckdstage');
    $cre = $request->input('healthdata-add-cre');
    $ua = $request->input('healthdata-add-ua');
    $egfr = $request->input('healthdata-add-egfr');
    $acr = $request->input('healthdata-add-acr');
    $ma = $request->input('healthdata-add-ma');
    $pro = $request->input('healthdata-add-pro');
    $upcr = $request->input('healthdata-add-upcr');
    $ca = $request->input('healthdata-add-ca');
    $k = $request->input('healthdata-add-k');
    $na = $request->input('healthdata-add-na');
    $p = $request->input('healthdata-add-p');
    $gptalt = $request->input('healthdata-add-gptalt');
    $got = $request->input('healthdata-add-got');
    $condition = [
        // Define your conditions here, for example:
        'patient_id_FK' => $patient_id, // Assuming you have the patient ID available
    ];
    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'healthdata-add-datetime' => 'required|date',
        'healthdata-add-weight' => 'required|numeric',
        'healthdata-add-height' => 'required|numeric',
        'healthdata-add-sbp' => 'required|numeric',
        'healthdata-add-dbp' => 'required|numeric',
        'healthdata-add-pulse' => 'required|numeric',
        'healthdata-add-celsius' => 'required|numeric',
        'healthdata-add-fahrenheit' => 'required|numeric',
        'healthdata-add-a1cpercentage' => 'required|numeric',
        'healthdata-add-lotview' => 'nullable|numeric',
        'healthdata-add-instid' => 'nullable|numeric',
        'healthdata-add-testid' => 'nullable|numeric',
        'healthdata-add-operator' => 'nullable|numeric',
        'healthdata-add-ga' => 'nullable|numeric',
        'healthdata-add-cho' => 'required|numeric',
        'healthdata-add-hdl' => 'required|numeric',
        'healthdata-add-ldlc' => 'required|numeric',
        'healthdata-add-tg' => 'required|numeric',
        'healthdata-add-cpeptide' => 'required|numeric',
        'healthdata-add-ckdstage' => 'required|numeric',
        'healthdata-add-cre' => 'required|numeric',
        'healthdata-add-ua' => 'required|numeric',
        'healthdata-add-egfr' => 'required|numeric',
        'healthdata-add-acr' => 'required|numeric',
        'healthdata-add-ma' => 'required|numeric',
        'healthdata-add-pro' => 'required|numeric',
        'healthdata-add-upcr' => 'required|numeric',
        'healthdata-add-ca' => 'required|numeric',
        'healthdata-add-k' => 'required|numeric',
        'healthdata-add-na' => 'required|numeric',
        'healthdata-add-p' => 'required|numeric',
        'healthdata-add-gptalt' => 'required|numeric',
        'healthdata-add-got' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    DB::table('healthdatas')
    ->where($condition)
    ->where('healthdata_id', $healthdata_id)
    ->update([
        'date' => $recordedAt,
        'weight' => $weight,
        'height' => $height,
        'sbp' => $sbp,
        'dbp' => $dbp,
        'pulse' => $pulse,
        'celcius' => $celsius,
        'fahrenheit' => $fahrenheit,
        'a1cpercentage' => $a1cpercentage,
        'lotview' => $lotview,
        'instid' => $instid,
        'testID' => $testID,
        'operator' => $operator,
        'ga' => $ga,
        'cho' => $cho,
        'hdl' => $hdl,
        'ldlc' => $ldlc,
        'tg' => $tg,
        'cpeptide' => $cpeptide,
        'ckdstage' => $ckdstage,
        'cre' => $cre,
        'ua' => $ua,
        'egfr' => $egfr,
        'acr' => $acr,
        'ma' => $ma,
        'pro' => $pro,
        'upcr' => $upcr,
        'ca' => $ca,
        'k' => $k,
        'na' => $na,
        'p' => $p,
        'gpt/alt' => $gptalt,
        'got' => $got,
        // Update other fields as needed
    ]);


    // Example: Update the existing health data record
 

// Dump the updated record to verify

    $healthdata = Healthdata::all();

    // Redirect to a success page or the same form page
        return view('healthdata')->with([
            'patientId' => $patient->patient_id,
            'patient' => $patient,
            'singleHealthData' => $singleHealthData,
            'healthdata' => $healthdata,
        ]);
}


public function inserthealthdataorg(Request $request)
{
 
    $organizations = Organization::all();
    $user = session('authenticated_user');
    $professional_id =  $user->professional_id;

    $patients = session('patient');
    $patientId = $patients->patient_id;
    // Example: Retrieving the input from the form
    $recordedAt = $request->input('healthdata-add-datetime');
    $weight = $request->input('healthdata-add-weight');
    $height = $request->input('healthdata-add-height');
    $sbp = $request->input('healthdata-add-sbp');
    $dbp = $request->input('healthdata-add-dbp');
    $pulse = $request->input('healthdata-add-pulse');
    $celsius = $request->input('healthdata-add-celsius');
    $fahrenheit = $request->input('healthdata-add-fahrenheit');
    $a1cpercentage = $request->input('healthdata-add-a1cpercentage');
    $lotview = $request->input('healthdata-add-lotview');
    $instid = $request->input('healthdata-add-instid');
    $testID = $request->input('healthdata-add-testid');
    $operator = $request->input('healthdata-add-operator');
    $ga = $request->input('healthdata-add-ga');
    $cho = $request->input('healthdata-add-cho');
    $hdl = $request->input('healthdata-add-hdl');
    $ldlc = $request->input('healthdata-add-ldlc');
    $tg = $request->input('healthdata-add-tg');
    $cpeptide = $request->input('healthdata-add-cpeptide');
    $ckdstage = $request->input('healthdata-add-ckdstage');
    $cre = $request->input('healthdata-add-cre');
    $ua = $request->input('healthdata-add-ua');
    $egfr = $request->input('healthdata-add-egfr');
    $acr = $request->input('healthdata-add-acr');
    $ma = $request->input('healthdata-add-ma');
    $pro = $request->input('healthdata-add-pro');
    $upcr = $request->input('healthdata-add-upcr');
    $ca = $request->input('healthdata-add-ca');
    $k = $request->input('healthdata-add-k');
    $na = $request->input('healthdata-add-na');
    $p = $request->input('healthdata-add-p');
    $gptalt = $request->input('healthdata-add-gptalt');
    $got = $request->input('healthdata-add-got');

    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'healthdata-add-datetime' => 'required|date',
        'healthdata-add-weight' => 'required|numeric',
        'healthdata-add-height' => 'required|numeric',
        'healthdata-add-sbp' => 'required|numeric',
        'healthdata-add-dbp' => 'required|numeric',
        'healthdata-add-pulse' => 'required|numeric',
        'healthdata-add-celsius' => 'required|numeric',
        'healthdata-add-fahrenheit' => 'required|numeric',
        'healthdata-add-a1cpercentage' => 'required|numeric',
        'healthdata-add-lotview' => 'nullable|numeric',
        'healthdata-add-instid' => 'nullable|numeric',
        'healthdata-add-testid' => 'nullable|numeric',
        'healthdata-add-operator' => 'nullable|numeric',
        'healthdata-add-ga' => 'nullable|numeric',
        'healthdata-add-cho' => 'required|numeric',
        'healthdata-add-hdl' => 'required|numeric',
        'healthdata-add-ldlc' => 'required|numeric',
        'healthdata-add-tg' => 'required|numeric',
        'healthdata-add-cpeptide' => 'required|numeric',
        'healthdata-add-ckdstage' => 'required|numeric',
        'healthdata-add-cre' => 'required|numeric',
        'healthdata-add-ua' => 'required|numeric',
        'healthdata-add-egfr' => 'required|numeric',
        'healthdata-add-acr' => 'required|numeric',
        'healthdata-add-ma' => 'required|numeric',
        'healthdata-add-pro' => 'required|numeric',
        'healthdata-add-upcr' => 'required|numeric',
        'healthdata-add-ca' => 'required|numeric',
        'healthdata-add-k' => 'required|numeric',
        'healthdata-add-na' => 'required|numeric',
        'healthdata-add-p' => 'required|numeric',
        'healthdata-add-gptalt' => 'required|numeric',
        'healthdata-add-got' => 'required|numeric',
    ]);
    
    $condition = [
        // Define your conditions here, for example:
        'patient_id' => $patientId, // Assuming you have the patient ID available
    ];

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Example: Prepare the data to be inserted into the database
    $healthData = [
        'patient_id_FK' => $patientId,
        'date' => $recordedAt,
        'weight' => $weight,
        'height' => $height,
        'sbp' => $sbp,
        'dbp' => $dbp,
        'pulse' => $pulse,
        'celcius' => $celsius,
        'fahrenheit' => $fahrenheit,
        'a1cpercentage' => $a1cpercentage,
        'lotview' => $lotview,
        'instid' => $instid,
        'testID' => $testID,
        'operator' => $operator,
        'ga' => $ga,
        'cho' => $cho,
        'hdl' => $hdl,
        'ldlc' => $ldlc,
        'tg' => $tg,
        'cpeptide' => $cpeptide,
        'ckdstage' => $ckdstage,
        'cre' => $cre,
        'ua' => $ua,
        'egfr' => $egfr,
        'acr' => $acr,
        'ma' => $ma,
        'pro' => $pro,
        'upcr' => $upcr,
        'ca' => $ca,
        'k' => $k,
        'na' => $na,
        'p' => $p,
        'gpt/alt' => $gptalt,
        'got' => $got,
    
        'hr' => null,
        'tc' => null,
        'unit' => null,
    ];

    // Example: Insert the data into the database
    DB::table('healthdatas')->where($condition)->insert($healthData);
    $singleHealthData = Healthdata::where('patient_id_FK', $patientId)->first();
    $healthdata = Healthdata::all();
    // Redirect to a success page or the same form page
    return redirect()->route('healthdataorg');
}
public function updatehealthdataorgs(Request $request)
{
 
  $healthdata_id = $request->input('healthdata_id');
  if (session()->has('patient')) {
    $patient = session('patient');
    $patient_id = $patient->patient_id;
} else {
    $patient_id = session('patient_id');
    $patient = Patient::find($patient_id);
}
$user = session('authenticated_user');

    // Retrieve the existing health data record by ID
    $singleHealthData = Healthdata::findOrFail($healthdata_id);

    // Example: Retrieving the input from the form
    $recordedAt = $request->input('healthdata-add-datetime');
 
    $weight = $request->input('healthdata-add-weight');
    $height = $request->input('healthdata-add-height');
    $sbp = $request->input('healthdata-add-sbp');
    $dbp = $request->input('healthdata-add-dbp');
    $pulse = $request->input('healthdata-add-pulse');
    $celsius = $request->input('healthdata-add-celsius');
    $fahrenheit = $request->input('healthdata-add-fahrenheit');
    $a1cpercentage = $request->input('healthdata-add-a1cpercentage');
    $lotview = $request->input('healthdata-add-lotview');
    $instid = $request->input('healthdata-add-instid');
    $testID = $request->input('healthdata-add-testid');
    $operator = $request->input('healthdata-add-operator');
    $ga = $request->input('healthdata-add-ga');
    $cho = $request->input('healthdata-add-cho');
    $hdl = $request->input('healthdata-add-hdl');
    $ldlc = $request->input('healthdata-add-ldlc');
    $tg = $request->input('healthdata-add-tg');
    $cpeptide = $request->input('healthdata-add-cpeptide');
    $ckdstage = $request->input('healthdata-add-ckdstage');
    $cre = $request->input('healthdata-add-cre');
    $ua = $request->input('healthdata-add-ua');
    $egfr = $request->input('healthdata-add-egfr');
    $acr = $request->input('healthdata-add-acr');
    $ma = $request->input('healthdata-add-ma');
    $pro = $request->input('healthdata-add-pro');
    $upcr = $request->input('healthdata-add-upcr');
    $ca = $request->input('healthdata-add-ca');
    $k = $request->input('healthdata-add-k');
    $na = $request->input('healthdata-add-na');
    $p = $request->input('healthdata-add-p');
    $gptalt = $request->input('healthdata-add-gptalt');
    $got = $request->input('healthdata-add-got');
    $condition = [
        // Define your conditions here, for example:
        'patient_id_FK' => $patient_id, // Assuming you have the patient ID available
    ];
    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'healthdata-add-datetime' => 'required|date',
        'healthdata-add-weight' => 'required|numeric',
        'healthdata-add-height' => 'required|numeric',
        'healthdata-add-sbp' => 'required|numeric',
        'healthdata-add-dbp' => 'required|numeric',
        'healthdata-add-pulse' => 'required|numeric',
        'healthdata-add-celsius' => 'required|numeric',
        'healthdata-add-fahrenheit' => 'required|numeric',
        'healthdata-add-a1cpercentage' => 'required|numeric',
        'healthdata-add-lotview' => 'nullable|numeric',
        'healthdata-add-instid' => 'nullable|numeric',
        'healthdata-add-testid' => 'nullable|numeric',
        'healthdata-add-operator' => 'nullable|numeric',
        'healthdata-add-ga' => 'nullable|numeric',
        'healthdata-add-cho' => 'required|numeric',
        'healthdata-add-hdl' => 'required|numeric',
        'healthdata-add-ldlc' => 'required|numeric',
        'healthdata-add-tg' => 'required|numeric',
        'healthdata-add-cpeptide' => 'required|numeric',
        'healthdata-add-ckdstage' => 'required|numeric',
        'healthdata-add-cre' => 'required|numeric',
        'healthdata-add-ua' => 'required|numeric',
        'healthdata-add-egfr' => 'required|numeric',
        'healthdata-add-acr' => 'required|numeric',
        'healthdata-add-ma' => 'required|numeric',
        'healthdata-add-pro' => 'required|numeric',
        'healthdata-add-upcr' => 'required|numeric',
        'healthdata-add-ca' => 'required|numeric',
        'healthdata-add-k' => 'required|numeric',
        'healthdata-add-na' => 'required|numeric',
        'healthdata-add-p' => 'required|numeric',
        'healthdata-add-gptalt' => 'required|numeric',
        'healthdata-add-got' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    DB::table('healthdatas')
    ->where($condition)
    ->where('healthdata_id', $healthdata_id)
    ->update([
        'date' => $recordedAt,
        'weight' => $weight,
        'height' => $height,
        'sbp' => $sbp,
        'dbp' => $dbp,
        'pulse' => $pulse,
        'celcius' => $celsius,
        'fahrenheit' => $fahrenheit,
        'a1cpercentage' => $a1cpercentage,
        'lotview' => $lotview,
        'instid' => $instid,
        'testID' => $testID,
        'operator' => $operator,
        'ga' => $ga,
        'cho' => $cho,
        'hdl' => $hdl,
        'ldlc' => $ldlc,
        'tg' => $tg,
        'cpeptide' => $cpeptide,
        'ckdstage' => $ckdstage,
        'cre' => $cre,
        'ua' => $ua,
        'egfr' => $egfr,
        'acr' => $acr,
        'ma' => $ma,
        'pro' => $pro,
        'upcr' => $upcr,
        'ca' => $ca,
        'k' => $k,
        'na' => $na,
        'p' => $p,
        'gpt/alt' => $gptalt,
        'got' => $got,
        // Update other fields as needed
    ]);


    // Example: Update the existing health data record
 

// Dump the updated record to verify

    $healthdata = Healthdata::all();

    // Redirect to a success page or the same form page
    return redirect()->route('healthdataorg');
    
}
public function delete($healthdata_id)
{
    try {
        // Find the health data record by ID
        $healthData = Healthdata::findOrFail($healthdata_id);

        // Delete the health data record
        $healthData->delete();

        // Redirect to a success page or the health data listing page
        return redirect()->route('healthdata')->with('success', 'Health data record deleted successfully.');
    } catch (\Exception $e) {
        // Handle exceptions (e.g., ModelNotFoundException) here
        return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
    }
}
public function updateglucosetarget(Request $request, $patient_id)
{

    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = Patient::findOrFail($patient_id);
    $user = Professional::find($professional_id);

    // Example: Retrieving the input from the form
    $beforeComsumptionLB = $request->input('patient-update-glucosetarget-beforecomsumptionlb');
    $beforeComsumptionUB = $request->input('patient-update-glucosetarget-beforecomsumptionub');
    $afterComsumptionLB = $request->input('patient-update-glucosetarget-aftercomsumptionlb');
    $afterComsumptionUB = $request->input('patient-update-glucosetarget-aftercomsumptionub');
    $bedtimeLB = $request->input('patient-update-glucosetarget-bedtimelb');
    $bedtimeUB = $request->input('patient-update-glucosetarget-bedtimeub');
    $hba1c = $request->input('patient-update-glucosetarget-hba1c');

    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'patient-update-glucosetarget-beforecomsumptionlb' => 'required|numeric',
        'patient-update-glucosetarget-beforecomsumptionub' => 'required|numeric',
        'patient-update-glucosetarget-aftercomsumptionlb' => 'required|numeric',
        'patient-update-glucosetarget-aftercomsumptionub' => 'required|numeric',
        'patient-update-glucosetarget-bedtimelb' => 'required|numeric',
        'patient-update-glucosetarget-bedtimeub' => 'required|numeric',
        'patient-update-glucosetarget-hba1c' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Example: Update the health data in the database
    $healthData = [
        'targetBG_low_BC' => $beforeComsumptionLB,
        'targetBG_high_BC' => $beforeComsumptionUB,
        'targetBG_low_AC' => $afterComsumptionLB,
        'targetBG_high_AC' => $afterComsumptionUB,
        'targetBG_low_BT' => $bedtimeLB,
        'targetBG_high_BT' => $bedtimeUB,
        'targethba1c' => $hba1c,
    ];
    $condition = [
        // Define your conditions here, for example:
        'patient_id' => $patient_id, // Assuming you have the patient ID available
    ];
    DB::table('patients')->where($condition)->update($healthData);
  

    // Redirect to the patient's details page or any other appropriate page
    $organizations = Organization::all();
    $chat_messages = ChatMessage::all();
    $professional_id = $request->input('professional_id');
   
    $user = Professional::find($professional_id);
    // Pass the patient information to the view
    return view('aboutpatient', compact('patient','organizations','user','chat_messages'));

}

public function updatetargetrange(Request $request, $patient_id)
{
    $patient = Patient::findOrFail($patient_id);

    // Example: Retrieving the input from the form
    $minCarbs = $request->input('patient-update-targetrange-mincarbs');
    $maxCarbs = $request->input('patient-update-targetrange-maxcarbs');
    $minWeight = $request->input('patient-update-targetrange-minweight');
    $maxWeight = $request->input('patient-update-targetrange-maxweight');
    $minBMI = $request->input('patient-update-targetrange-minbmi');
    $maxBMI = $request->input('patient-update-targetrange-maxbmi');
    $totalActivity = $request->input('patient-update-targetrange-totalactivity');

    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'patient-update-targetrange-mincarbs' => 'required|numeric',
        'patient-update-targetrange-maxcarbs' => 'required|numeric',
        'patient-update-targetrange-minweight' => 'required|numeric',
        'patient-update-targetrange-maxweight' => 'required|numeric',
        'patient-update-targetrange-minbmi' => 'required|numeric',
        'patient-update-targetrange-maxbmi' => 'required|numeric',
        'patient-update-targetrange-totalactivity' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Example: Update the target range data in the database
    $targetRangeData = [
        'mincarb' => $minCarbs,
        'maxcarb' => $maxCarbs,
        'minweight' => $minWeight,
        'maxweight' => $maxWeight,
        'minbmi' => $minBMI,
        'maxbmi' => $maxBMI,
        'totalactivity' => $totalActivity,
    ];

    $condition = [
        // Define your conditions here, for example:
        'patient_id' => $patient_id, // Assuming you have the patient ID available
    ];

    // Example: Update the specific fields in the patients table
    DB::table('patients')->where($condition)->update($targetRangeData);

    // Redirect to the patient's details page or any other appropriate page
    $organizations = Organization::all();
    $chat_messages = ChatMessage::all();
    $professional_id = $request->input('professional_id');
   
    $user = Professional::find($professional_id);
    // Pass the patient information to the view
    return view('aboutpatient', compact('patient','organizations','user','chat_messages'));
}


public function updatetargetrangeorg(Request $request)
{
    
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
    } else {
        $patientId = session('patient_id');
        $patient = Patient::find($patient_id);
    }
    $user = session('authenticated_user');
    $professionalId = $user->professional_id;
$organizationid = session('organizationid');
    // Example: Retrieving the input from the form
    $minCarbs = $request->input('patient-update-targetrange-mincarbs');
    $maxCarbs = $request->input('patient-update-targetrange-maxcarbs');
    $minWeight = $request->input('patient-update-targetrange-minweight');
    $maxWeight = $request->input('patient-update-targetrange-maxweight');
    $minBMI = $request->input('patient-update-targetrange-minbmi');
    $maxBMI = $request->input('patient-update-targetrange-maxbmi');
    $totalActivity = $request->input('patient-update-targetrange-totalactivity');

    // Example: Validating the input data
    $validator = Validator::make($request->all(), [
        'patient-update-targetrange-mincarbs' => 'required|numeric',
        'patient-update-targetrange-maxcarbs' => 'required|numeric',
        'patient-update-targetrange-minweight' => 'required|numeric',
        'patient-update-targetrange-maxweight' => 'required|numeric',
        'patient-update-targetrange-minbmi' => 'required|numeric',
        'patient-update-targetrange-maxbmi' => 'required|numeric',
        'patient-update-targetrange-totalactivity' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    if ($patient) {
        $patient->mincarb = $minCarbs;
        $patient->maxcarb = $maxCarbs;
        $patient->minweight = $minWeight;
        $patient->maxweight = $maxWeight;
        $patient->minbmi = $minBMI;
        $patient->maxbmi = $maxBMI;
        $patient->totalactivity = $totalActivity;
    
        $patient->save();
    }

    // Redirect to the patient's details page or any other appropriate page
    $organizations = Organization::all();
    $chat_messages = ChatMessage::all();
    // Pass the patient information to the view
    session(['patient' => $patient]);

    // Redirect to the patient's details page
    return redirect()->route('aboutpatientorg');

}


    
}
