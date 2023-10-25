<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\TableController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CreateController;
use App\Models\Organization;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MedicationController;
use App\Http\Controllers\DiagnosisController;
use App\Http\Controllers\AllergyController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\LogbookController;
use Illuminate\Http\Request;
use App\Http\Controllers\RemarkController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
})->middleware('web')->name('/');


Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/all-organization', [TableController::class, 'index'])->name('all_organization');
Route::get('/all_user', [TableController::class, 'index2'])->name('all_user');
Route::get('/all_role', [TableController::class, 'index3'])->name('all_role');
Route::get('/all_permission', [TableController::class, 'index4'])->name('all_permission');
Route::get('/all_patient', [TableController::class, 'index5'])->name('all_patient');
Route::get('/orgall_patients/{organization_id}', [TableController::class, 'index5org'])->name('orgall_patients');

Route::get('/all_patient2', [TableController::class, 'index6'])->name('all_patient2');
Route::get('/orgall_patient2/{organization_id}', [TableController::class, 'index6org'])->name('orgall_patient2');

Route::get('/create_org', [TableController::class, 'index7'])->name('create_org');




Route::get('/create_user', [TableController::class, 'index8'])->name('create_user');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/orglogout', [LoginController::class, 'logout2'])->name('logout2');
Route::get('organizations/{organizationid_FK}', [TableController::class, 'show'])->name('organizations.show');
Route::post('create', [CreateController::class, 'insert'])->name('insert.create');
Route::get('create_patient', [TableController::class, 'index11'])->name('create_patient');
Route::post('create2', [CreateController::class, 'insert2'])->name('insert2.create');
Route::post('/update/{patient_id}', [CreateController::class, 'update'])->name('update-patient');




Route::post('/editpage', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    
    $organizations = Organization::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('editpage', compact('patient','organizations','user'));
})->name('editpage');


Route::any('/aboutpatient',function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('aboutpatient', compact('patient','organizations','user','chat_messages'));


})->name('aboutpatient');

Route::get('/aboutpatient_glucosetarget/{patientId}', function ($patientId) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $patient = App\Models\Patient::find($patientId);
    // Pass the patient information to the view
    return view('edit_patient_glucose_target', compact('patient','organizations'));


})->name('edit_patient_glucose_target');

Route::get('/aboutpatient_targetrange/{patientId}', function ($patientId) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $patient = App\Models\Patient::find($patientId);
    // Pass the patient information to the view
    return view('edit_patient_target_range', compact('patient','organizations'));


})->name('edit_patient_target_range');
Route::get('/patient/{patientId}/{organization_id}', function ($patientId, $organization_id) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $patient = App\Models\Patient::find($patientId);

    // Pass the patient information to the view
    return view('/orgadminview/aboutpatient', [
        'patient' => $patient,
        'organizations' => $organizations,
        'organizationid' => $organization_id,
    ]);
})->name('patient');


Route::get('/myuser/{professional_id}', function ($professional_id) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $professionalss = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('myuser', compact('professionalss','organizations'));

})->name('myuser');


Route::get('/editmyuser/{professionalid}', function ($professional_id) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::pluck('organization_name')->all();
    $roles = Role::pluck('name', 'organizationid')->all();
    $professionalss = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('users.editmyuser', compact('professionalss','roles','organizations'));

})->name('editmyuser');
Route::post('/editmyuser/{id}/update', [UserController::class, 'update'])->name('updateuser');
Route::get('/editrole/{id}', function ($id) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::pluck('organization_name')->all();
    $role = Spatie\Permission\Models\Role::find($id);
    $permission = Permission::get();
    // Pass the patient information to the view
    return view('editrole', compact('role','permission','organizations'));

})->name('/editrole');

Route::post('editrole/{id}/update', [RoleController::class, 'update'])->name('updaterole');

Route::get('/updateorganization/{organizationid}', function ($organizationid) {
    // Retrieve the patient information based on the $patientId
 
    $organization = App\Models\organization::find($organizationid);
    // Pass the patient information to the view
    return view('updateorganization', compact('organization'));
})->name('updateorganization');


Route::get('/editorg/{organizationid}', function ($organizationid) {
    // Retrieve the patient information based on the $patientId
 
    $organization = App\Models\organization::find($organizationid);
    // Pass the patient information to the view
    return view('editorg', compact('organization'));
})->name('editorg');
Route::post('/editorg/{organizationid}', [CreateController::class, 'update2'])->name('update-org');

Route::get('myorganization', [TableController::class, 'show'])->name('myorganization');
Route::middleware(['auth'])->group(function () {
    Route::any('/myprofile', function () {
        // Retrieve the currently authenticated user
        $user = auth()->user();

        // Pass the user information to the view
        return view('myprofile', compact('user'));
    })->name('myprofile');
    // Other authenticated routes
});

Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    
});
Route::get('loadRoles', [UserController::class, 'loadRoles'])->name('loadRoles');
Route::get('loadPermissions', [UserController::class, 'loadPermissions'])->name('loadPermissions');
Route::get('/hyper', [TableController::class, 'viewhyper'])->name('hyper');
Route::get('/hypo', [TableController::class, 'viewhypo'])->name('hypo');

Route::get('/hyperreport', [TableController::class, 'viewhyperreport'])->name('hyperreport');
Route::get('/hyporeport', [TableController::class, 'viewhyporeport'])->name('hyporeport');


Route::post('/logbookbg', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    
    // Pass the patient information to the view
    return view('logbook_bg', compact('patient','logbook','user'));
})->name('logbook_bg');

Route::post('/logbook_bg2',  function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('logbook_bg2', compact('patient','logbook','user'));
})->name('logbook_bg2');

Route::post('/logbookbp', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('logbook_bp', compact('patient','logbook','user'));
})->name('logbook_bp');

Route::any('/healthdata', function (Request $request) {
    $healthdata = App\Models\healthdata::all();
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $singleHealthData = App\Models\healthdata::where('patient_id_FK', $patientId)->first();
    return view('healthdata', compact('patient', 'healthdata', 'singleHealthData','user'));
})->name('healthdata');

Route::POST('/addhealthdata', function (Request $request) {
    $healthdata = App\Models\healthdata::all();
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $singleHealthData = App\Models\healthdata::where('patient_id_FK', $patientId)->first();
    return view('addhealthdata', compact('patient', 'healthdata', 'singleHealthData','user'));
})->name('addhealthdata');
Route::delete('/healthdata/{healthdata_id}', [HealthDataController::class, 'delete'])->name('deleteHealthData');

Route::POST('/edithealthdata/{healthdata_id}', function (Request $request, $healthdata_id) {
    $healthdata = App\Models\healthdata::all();
    
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    
    $patient = App\Models\Patient::find($patientId);
  
    $user = App\Models\Professional::find($professional_id);
    $singleHealthData = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->where('healthdata_id', $healthdata_id)
    ->first();

    return view('edithealthdata', compact('patient', 'healthdata', 'singleHealthData','user','healthdata_id'));
})->name('edithealthdata');



Route::get('/logbookbg/{patientId}/{organizationid}', function ($patientId,$organizationid) {
    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
    $patient = App\Models\patient::find($patientId);
    // Pass the patient information to the view
    return view('/orgadminview/logbook_bg', ['patient'=>$patient,'organizationid'=>$organizationid,'logbook'=>$logbook]);
})->name('logbook_bgorg');

Route::get('/logbookbp/{patientId}/{organizationid}', function ($patientId,$organizationid) {
    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
    $patient = App\Models\patient::find($patientId);
    // Pass the patient information to the view
    return view('/orgadminview/logbook_bp', ['patient'=>$patient,'organizationid'=>$organizationid,'logbook'=>$logbook]);
})->name('logbook_bporg');

Route::get('/healthdata/{patientId}/{organizationid}', function ($patientId,$organizationid) {
    // Retrieve the patient information based on the $patientId
    $healthdata = App\Models\healthdata::all();
    $patient = App\Models\patient::find($patientId);
    // Pass the patient information to the view
    return view('/orgadminview/healthdata', ['patient'=>$patient,'healthdata'=>$healthdata,'organizationid'=>$organizationid]);
})->name('healthdataorg');


Route::get('/dashboard_bg/{patientId}/{organizationid}', function ($patientId,$organizationid) {
    // Retrieve the patient information based on the $patientId

    $patient = App\Models\patient::find($patientId);
    // Pass the patient information to the view
    return view('/orgadminview/dashboard_bg', ['patient'=>$patient,'organizationid'=>$organizationid]);
})->name('dashboard_bgorg');

Route::get('/dashboard_bp/{patientId}/{organizationid}', function ($patientId,$organizationid) {
    // Retrieve the patient information based on the $patientId
    
    $patient = App\Models\patient::find($patientId);
    // Pass the patient information to the view
    return view('/orgadminview/dashboard_bp', ['patient'=>$patient,'organizationid'=>$organizationid]);
})->name('dashboard_bporg');

Route::get('/dashboard_cho/{patientId}/{organizationid}', function ($patientId,$organizationid) {
    // Retrieve the patient information based on the $patientId
   
    $patient = App\Models\patient::find($patientId);
    // Pass the patient information to the view
    return view('/orgadminview/dashboard_cholesterol', ['patient'=>$patient,'organizationid'=>$organizationid]);
})->name('dashboard_choorg');

Route::match(['get', 'post'], '/dashboard_generals', function () {
    // Retrieve the patient information based on the $patientId

    $patientId = request()->query('patientId');
    $organizationid = request()->query('organizationid');
    $professional_id = request()->query('professional_id');
    
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $chat_messages = App\Models\ChatMessage::all();
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();
    function calculateBMI($weight, $height)
{
    if ($weight && $height) {
        // Convert height to meters (assuming height is in cm)
        $heightInMeters = $height / 100;

        // Calculate BMI using the formula: weight (kg) / height^2 (m^2)
        $bmi = $weight / ($heightInMeters * $heightInMeters);

        return round($bmi, 1);
    } else {
        // Handle the case where either weight or height is missing
        return null; // You can return a special value, like null, to indicate the data is incomplete
    }
}

    $latestcarbon = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('carbon');

$secondlatestcarbon = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('carbon');

    $latestactivity = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('activity');

$secondlatestactivity = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('activity');



    $latestweight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('weight');

$secondlatestweight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('weight');

    

$latestHeight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('height');

$latestBMI = calculateBMI($latestweight, $latestHeight);

// Calculate BMI for second latest data


$secondLatestHeight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('height');

$secondLatestBMI = calculateBMI($secondlatestweight, $secondLatestHeight);
    // Pass the patient information to the view
    return view('/orgadminview/dashboard_general', [
        'patient' => $patient,
        'organizationid' => $organizationid,
        'user' => $user,
        'healthdata' => $healthdata,
        'chat_messages' => $chat_messages,
        'latestweight' => $latestweight, 
        'secondlatestweight' => $secondlatestweight,
        'secondLatestBMI' => $secondLatestBMI,
        'latestBMI'=> $latestBMI,
        'secondlatestcarbon' => $secondlatestcarbon,
        'latestcarbon' => $latestcarbon,
        'secondlatestactivity' => $secondlatestactivity,
        'latestactivity' => $latestactivity,
    ]);
})->name('dashboard_generalorg');


Route::any('/dashboard_general', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $chat_messages = App\Models\ChatMessage::all();
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();
    function calculateBMI($weight, $height)
{
    if ($weight && $height) {
        // Convert height to meters (assuming height is in cm)
        $heightInMeters = $height / 100;

        // Calculate BMI using the formula: weight (kg) / height^2 (m^2)
        $bmi = $weight / ($heightInMeters * $heightInMeters);

        return round($bmi, 1);
    } else {
        // Handle the case where either weight or height is missing
        return null; // You can return a special value, like null, to indicate the data is incomplete
    }
}
    $latestcarbon = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('carbon');

$secondlatestcarbon = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('carbon');

    $latestactivity = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('activity');

$secondlatestactivity = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('activity');



    $latestweight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('weight');

$secondlatestweight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('weight');

    

$latestHeight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('height');

$latestBMI = calculateBMI($latestweight, $latestHeight);

// Calculate BMI for second latest data


$secondLatestHeight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('height');
    
$secondLatestBMI = calculateBMI($secondlatestweight, $secondLatestHeight);
    // Pass the patient information to the view
    return view('dashboard_general', [
        'patient' => $patient,
        'user' => $user,
        'healthdata' => $healthdata,
        'chat_messages' => $chat_messages,
        'latestweight' => $latestweight, 
        'secondlatestweight' => $secondlatestweight,
        'secondLatestBMI' => $secondLatestBMI,
        'latestBMI'=> $latestBMI,
        'secondlatestcarbon' => $secondlatestcarbon,
        'latestcarbon' => $latestcarbon,
        'secondlatestactivity' => $secondlatestactivity,
        'latestactivity' => $latestactivity,
    ]);
})->name('dashboard_general');
Route::any('/dashboard_generals', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $chat_messages = App\Models\ChatMessage::all();
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();
    function calculateBMI($weight, $height)
    {
        if ($weight && $height) {
            // Convert height to meters (assuming height is in cm)
            $heightInMeters = $height / 100;
    
            // Calculate BMI using the formula: weight (kg) / height^2 (m^2)
            $bmi = $weight / ($heightInMeters * $heightInMeters);
    
            return round($bmi, 1);
        } else {
            // Handle the case where either weight or height is missing
            return null; // You can return a special value, like null, to indicate the data is incomplete
        }
    }
    $latestcarbon = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('carbon');

$secondlatestcarbon = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('carbon');

    $latestactivity = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('activity');

$secondlatestactivity = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('activity');



    $latestweight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('weight');

$secondlatestweight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('weight');

    

$latestHeight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->value('height');

$latestBMI = calculateBMI($latestweight, $latestHeight);

// Calculate BMI for second latest data


$secondLatestHeight = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->orderByDesc('date')
    ->skip(1)
    ->take(1)
    ->value('height');
    
$secondLatestBMI = calculateBMI($secondlatestweight, $secondLatestHeight);
    // Pass the patient information to the view
    return view('dashboard_general', [
        'patient' => $patient,
        'user' => $user,
        'healthdata' => $healthdata,
        'chat_messages' => $chat_messages,
        'latestweight' => $latestweight, 
        'secondlatestweight' => $secondlatestweight,
        'secondLatestBMI' => $secondLatestBMI,
        'latestBMI'=> $latestBMI,
        'secondlatestcarbon' => $secondlatestcarbon,
        'latestcarbon' => $latestcarbon,
        'secondlatestactivity' => $secondlatestactivity,
        'latestactivity' => $latestactivity,
    ]);
})->name('dashboard_general2');

Route::any('/dashboard_bg', function (Request $request) {
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $logbook = App\Models\logbook::where('patient_id_FK', $patientId)->get();
    // Retrieve the patient information based on the $patientId
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();
   
   





    // Pass the patient information to the view
    return view('dashboard_bg', ['patient'=>$patient,'healthdata'=>$healthdata,'logbook'=>$logbook,'user'=>$user]);
})->name('dashboard_bg');

Route::POST('/dashboard_bp', function (Request $request) {
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    // Retrieve the patient information based on the $patientId
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();
  
    // Pass the patient information to the view
    return view('dashboard_bp', ['patient'=>$patient,'healthdata'=>$healthdata,'user'=>$user]);
})->name('dashboard_bp');

Route::POST('/dashboard_cho', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();

    // Pass the patient information to the view
    return view('dashboard_cholesterol', ['patient'=>$patient,'healthdata'=>$healthdata,'user'=>$user]);
})->name('dashboard_cho');



Route::get('/createpermission', [TableController::class, 'index14'])->name('createpermission');
Route::post('create3', [CreateController::class, 'insert3'])->name('insert3.create3');
Route::post('/healthdata/{patient_id}', [CreateController::class, 'inserthealthdata'])->name('create.healthdata');
Route::post('/healthdata-update/{patient_id}-{healthdata_id}', [CreateController::class, 'updatehealthdata'])->name('update-healthdata');

Route::get('prac3', [TableController::class, 'index17'])->name('prac3');
Route::get('/prac4/{practice_group_id}', function ($practice_group_id) {
    // Retrieve the patient information based on the $patientId
    $professionalingroup = App\Models\professionalingroup::all();
    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);
    $professional = App\Models\professional::all();
 // Pass the patient information to the view
 return view('practice_group_add_professional', compact('practicegroup','professional','professionalingroup'));


})->name('prac4');


Route::get('/prac5/{practice_group_id}', function ($practice_group_id) {
    // Retrieve the patient information based on the $patientId
    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);
    $patient = App\Models\Patient::all();
    $patientingroup = App\Models\patientingroup::all();
    
    return view('practice_group_add_patient',compact('patient', 'practicegroup','patientingroup'));


})->name('prac5');
Route::get('/addpracticegroup/{organization_id}', [TableController::class, 'practice'])->name('practice');
Route::get('/professionalingroupadd/{practice_group_id}-{organization_id}', function ($practice_group_id,$organization_id) {
    // Retrieve the patient information based on the $patientId
    $professionalingroup = App\Models\professionalingroup::all();
    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);
    $professional = App\Models\Professional::where('organizationid_FK', $organization_id)->get();
 // Pass the patient information to the view
 return view('/orgadminview/practice_group_add_professional', [
    'practicegroup' => $practicegroup,
    'professional' => $professional,
    'professionalingroup' => $professionalingroup,
    'organizationid' => $organization_id,
]);


})->name('orgprac4');


Route::get('/patientingroupadd/{practice_group_id}-{organization_id}', function ($practice_group_id,$organization_id) {
    // Retrieve the patient information based on the $patientId
    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);
    $patient = App\Models\Patient::where('organizationid_FK', $organization_id)->get();;
    $patientingroup = App\Models\patientingroup::all();
    
    return view('/orgadminview/practice_group_add_patient',[
        'patient' => $patient,
        'practicegroup' => $practicegroup,
        'patientingroup' => $patientingroup,
        'organizationid' => $organization_id]
    );


})->name('orgprac5');

Route::get('/editglucose/{patientId}', function ($patientId) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $patient = App\Models\Patient::find($patientId);
    // Pass the patient information to the view
    return view('edit_patient_glucose_target', compact('patient','organizations'));


})->name('editglucose');

Route::get('/edittargetedittarget/{patientId}', function ($patientId) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $patient = App\Models\Patient::find($patientId);
    // Pass the patient information to the view
    return view('edit_patient_target_range', compact('patient','organizations'));


})->name('edittarget');


Route::post('/redirect-to-previous', function () {
    return redirect()->back()->orDefault(route('aboutpatient'));
})->name('redirect-to-previous');

Route::get('/practicegroup', [TableController::class, 'practicegroup'])->name('practicegroup');
Route::post('/createpracticegroup', [UserController::class, 'practicegroupadd'])->name('insert4.createpracticegroup');
Route::post('/createpracticegrouporg/{organization_id}', [UserController::class, 'practicegroupaddorg'])->name('orginsert4.createpracticegroup');
Route::get('/praticegroupdetail/{practice_group_id}', function ($practice_group_id) {
    // Retrieve the patient information based on the $patientId
   
    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);
    $patientingroup = App\Models\patientingroup::all();
    $patient = App\Models\Patient::all();
    $logbook = App\Models\logbook::all();
    // Pass the patient information to the view
    $user = auth()->user();
    return view('practice_group_detail', [
        'user' => $user,
        'practicegroup' => $practicegroup,
        'patientingroup' => $patientingroup,
        'logbook' => $logbook,
        'patient' => $patient,
    ]);

})->name('practice_group_detail');


Route::post('/practicegroupdetailadd/{practice_group_id}', [TableController::class, 'addPatientInGroup'])->name('practice_group_detailadd');
Route::post('/practicegroupdetailadd2/{practice_group_id}', [TableController::class, 'addProfessionalInGroup'])->name('practice_group_detailadd2');
Route::get('/practicegroupdetaildelete/{practice_group_id}', [TableController::class, 'deletePracticeGroup'])->name('practice_group_detaildelete');
Route::get('/export/{practice_group_id}', [TableController::class, 'export'])->name('export');
Route::get('/exports/{patientId}', [TableController::class, 'exports'])->name('exports');
Route::post('/deletes', [TableController::class, 'deletehealthdata'])->name('deletes');
Route::get('/deletemedication/{medicationId}', [TableController::class, 'deletemedication'])->name('deletemedication');
Route::get('/14.167.2.15/organization/{organizationId}', [LoginController::class, 'ipaddress'])
    ->where('organizationId', '[0-9]+')
    ->middleware(['redirect.organization']) // Use the middleware here
    ->name('custom.login');
Route::post('/orglogin/{organizationId}', [LoginController::class, 'orglogin'])->name('orglogin');

Route::get('/orgpracticegroup/{organization_id}', [TableController::class, 'orgpracticegroup'])->name('orgpracticegroup');


Route::get('/praticegroupdetails/{practice_group_id}-{organization_id}', function ($practice_group_id,$organization_id) {
    // Retrieve the patient information based on the $patientId
   
    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);

    $user = session('authenticated_user');
    $patientingroup = App\Models\patientingroup::all();
    $patient = App\Models\Patient::all();
    $logbook = App\Models\logbook::all();
    // Pass the patient information to the view
   
    return view('/orgadminview/practice_group_detail', [
        'user' => $user,
        'practicegroup' => $practicegroup,
        'patientingroup' => $patientingroup,
        'logbook' => $logbook,
        'patient' => $patient,
        'organizationid' => $organization_id,
    ]);

})->name('orgpractice_group_detail');

Route::post('/update_logbook/{logbook_id}', [LogbookController::class, 'updateLogbook'])->name('update.logbook');
Route::post('/practicegroupdetailadd/{practice_group_id}/{organization_id}', [TableController::class, 'orgaddPatientInGroup'])->name('orgpractice_group_detailadd');
Route::post('/practicegroupdetailadd2/{practice_group_id}/{organization_id}', [TableController::class, 'orgaddProfessionalInGroup'])->name('orgpractice_group_detailadd2');
Route::get('/practicegroupdetaildelete/{practice_group_id}/{organization_id}', [TableController::class, 'orgdeletePracticeGroup'])->name('orgpractice_group_detaildelete');
Route::get('/download_template', [TableController::class, 'downloadTemplate'])->name('download_template');

Route::get('/export/{practice_group_id}/{organization_id}', [TableController::class, 'exportorg'])->name('exportorg');
Route::get('/importform', [TableController::class, 'showForm'])->name('import.form');
Route::post('/import', [TableController::class, 'import'])->name('import');
Route::post('/import_medication', [TableController::class, 'import_medication'])->name('import_medication');
Route::post('/{patient_id}/updateglucosetarget', [CreateController::class, 'updateglucosetarget'])->name('healthdata.update');
Route::post('/{patient_id}/updatetargetrange', [CreateController::class, 'updatetargetrange'])->name('healthdata.update2');
Route::post('/send-message/{patient_id}', [ChatController::class, 'sendMessage'])->name('sendMessage');
Route::any('/remark',function (Request $request) {
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
  
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();

    // Pass the patient information to the view
    return view('remark', compact('patient','organizations','user','chat_messages','remark','professional'));


})->name('remark');

Route::any('/medication',function (Request $request) {
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $medication = App\Models\Medication::inRandomOrder()->first();
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $medicationindiagnosis   = App\Models\MedicationInDiagnosis::all();
     //= App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    $allergy = App\Models\Allergy::where('patient_id_FK', $patientId)->get();
    $singleallergy = App\Models\Allergy::where('patient_id_FK', $patientId)->first();
    $diagnosis = App\Models\Diagnosis::where('patient_id_FK', $patientId)->get();
 
    // Pass the patient information to the view
    return view('medication', compact('patient','medication','organizations','user','chat_messages','professional','allergy','diagnosis','singleallergy','medicationindiagnosis'));


})->name('medicationreport');

Route::post('/addallergy',function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    // Pass the patient information to the view
    return view('addallergy', compact('patient','organizations','user','chat_messages','remark','professional'));


})->name('addallergy');

Route::any('/addremark',function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    // Pass the patient information to the view
    return view('addremark', compact('patient','organizations','user','chat_messages','remark','professional'));


})->name('addremark');

Route::any('/adddiagnosis',function (Request $request) {
    // Retrieve the patient information based on the $patientId
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    $medication = App\Models\Medication::all();

    $medicationindiagnosis   = App\Models\MedicationInDiagnosis::all();
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
 
    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    // Pass the patient information to the view
    return view('adddiagnosis', ['patient'=>$patient,'organizations'=>$organizations,'user'=>$user,'chat_messages'=>$chat_messages,'remark'=>$remark,'professional'=>$professional,'medication'=>$medication,'medicationindiagnosis'=>$medicationindiagnosis]);


})->name('adddiagnosis');
Route::any('/edit-diagnosis/{diagnosisId}', function (Request $request, $diagnosisId) {
    // Retrieve the patient information based on the $patientId
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    $medication = App\Models\Medication::all();

    $medicationindiagnosis   = App\Models\MedicationInDiagnosis::all();
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $professional_id = $request->input('professional_id');
    $patientId = $request->input('patient_id');
    $patient = App\Models\Patient::find($patientId);
    $diagnosis = App\Models\Diagnosis::where('patient_id_FK', $patientId)->get();
    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    // Pass the patient information to the view
    return view('editdiagnosis', [
        'diagnosisId' => $diagnosisId,
        'patient' => $patient,
        'organizations' => $organizations,
        'user' => $user,
        'chat_messages' => $chat_messages,
        'remark' => $remark,
        'professional' => $professional,
        'medication' => $medication,
        'medicationindiagnosis' => $medicationindiagnosis,
        'diagnosis' => $diagnosis,
    ]);
})->name('edit-diagnosis');
Route::get('/delete/{patientId}/{allergy_Id}/{professionalId}', [TableController::class, 'deleteallergy'])->name('deleteallergy');
Route::post('/patients/remark', [RemarkController::class, 'submitForm'])->name('patients.remark.submit');
Route::post('/allergies', [AllergyController::class, 'store'])->name('allergy.store');
Route::post('/store-diagnosis-and-medication', [DiagnosisController::class, 'storeDiagnosisAndMedication'])->name('store.diagnosis.medication');
Route::post('/update-diagnosis-and-medication/{diagnosisId}', [DiagnosisController::class, 'updateDiagnosisAndMedication'])->name('update.diagnosis.medication');
Route::post('/update-diagnosis-active/{diagnosisId}',[DiagnosisController::class, 'updateActiveStatus']);
Route::post('/update-diagnosis-inuse/{diagnosisId}', [DiagnosisController::class, 'updateInUseStatus']);
Route::any('/medication-list',function (Request $request) {
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    // Retrieve the patient information based on the $patientId
    $medicationCount = App\Models\Medication::count();
    $medication = App\Models\Medication::all();
  
    

    // Pass the patient information to the view
    return view('medication-all', [
        'medication' => $medication,
        'medicationCount' =>$medicationCount,
    ]);


})->name('medication_list');

Route::any('/patient-medicine}',function (Request $request) {
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    session(['patient_id' => $patientId, 'professional_id' => $professional_id]);
    $singleDiagnosis = $request->input('diagnosisid');
    $patient = App\Models\Patient::find($patientId);
    $medication = App\Models\Medication::all();

    $diagnosis = \App\Models\Diagnosis::where('patient_id_FK', $patientId)
    ->where('diagnosis_id', $singleDiagnosis)
    ->first();

    // Pass the patient information to the view
    return view('patients-medication-create', [
        'diagnosis'=> $diagnosis,
        'singleDiagnosis' => $singleDiagnosis,
        'medication' => $medication,
        'patient' => $patient,
        'patientId' => $patientId,
        'professional_id'=> $professional_id,
       
    ]);


})->name('patient-medicine-create');


Route::post('/medications', [MedicationController::class, 'store'])->name('medications.store');
Route::put('/medications/{medicationId}', [MedicationController::class, 'update'])->name('medications.update');

Route::get('/chat', [TableController::class, 'chatpage'])->name('chat');
Route::any('/search', [LogbookController::class, 'search'])->name('logbook.search');
Route::post('/search2', [LogbookController::class, 'search2'])->name('logbook.search2');
Route::get('/report', [LogbookController::class, 'report'])->name('logbook.report');
Route::any('/reset-password', function (Request $request) {
    $professional_id = $request->input('professional_id');
    $user = App\Models\Professional::find($professional_id);
    return view('auth.passwords.reset', compact('user'));
})->name('resetpassword');
Route::post('/resetpassword/{professionalid}',function (Request $request, $professionalid){
   
    // Validate the form data
    $request->validate([
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    // Update the user's password
    $user = App\Models\Professional::find($professionalid);
    
    
    $user->password = Hash::make($request->password);
    $user->plain_password = ($request->password);
    $user->save();

    return redirect()->route('home')->with('success', 'Password reset successfully!');





})->name('resetpasswords');

Route::post('/save-medication', [MedicationController::class, 'saveMedication'])->name('saveMedication');
// routes/web.php


Route::any('/filter-logbook',[LogbookController::class, 'filterLogbook'])->name('filter-logbook');
