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

Route::any('/orghome', [TableController::class, 'indexorg'])->name('homeorg');
Route::get('/all-organization', [TableController::class, 'index'])->name('all_organization');
Route::get('/all_user', [TableController::class, 'index2'])->name('all_user');
Route::any('/organization-all_user', [TableController::class, 'index2org'])->name('all_userorg');
Route::get('/all_role', [TableController::class, 'index3'])->name('all_role');
Route::get('/all_permission', [TableController::class, 'index4'])->name('all_permission');
Route::get('/all_patient', [TableController::class, 'index5'])->name('all_patient');
Route::get('/orgall_patients', [TableController::class, 'index5org'])->name('orgall_patients');

Route::get('/all_patient2', [TableController::class, 'index6'])->name('all_patient2');
Route::get('/orgall_patient2', [TableController::class, 'index6org'])->name('orgall_patient2');

Route::get('/create_org', [TableController::class, 'index7'])->name('create_org');




Route::get('/create_user', [TableController::class, 'index8'])->name('create_user');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/orglogout', [LoginController::class, 'logout2'])->name('logout2');
Route::get('organizations/{organizationid_FK}', [TableController::class, 'show'])->name('organizations.show');
Route::post('create', [CreateController::class, 'insert'])->name('insert.create');
Route::get('create_patient', [TableController::class, 'index11'])->name('create_patient');
Route::get('/organization-create_patient', [TableController::class, 'index11org'])->name('create_patientorg');
Route::post('create2', [CreateController::class, 'insert2'])->name('insert2.create');
Route::post('/org-create-patient', [CreateController::class, 'insert2org'])->name('insert2.createorg');
Route::post('/update/{patient_id}', [CreateController::class, 'update'])->name('update-patient');
Route::post('/updateorg', [CreateController::class, 'updateorg'])->name('update-patientorg');



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


Route::post('/org-editpage', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patientId;
    } else {
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
    }
  
        $professionalId = session('professional_id');
        $organizationid = session('organization_id');
    $organizations = Organization::all();
    $user = session('authenticated_user');
   $professional_id = $user->professional_id;
 

    // Pass the patient information to the view
    return view('/orgadminview/editpage', compact('patient','organizations','user'));
})->name('editpageorg');
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

Route::any('/org-aboutpatient_glucosetarget', function (Request $request) {
    $user = session('authenticated_user');
  
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
    } else {
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
    }
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
   
    // Pass the patient information to the view
    return view('/orgadminview/edit_patient_glucose_target', compact('patient','organizations','user'));


})->name('edit_patient_glucose_targetorg');

Route::any('/org-aboutpatient_targetrange', function (Request $request) {
    $user = session('authenticated_user');
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patientId;
    } else {
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
    }
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    // Pass the patient information to the view
    return view('/orgadminview/edit_patient_target_range', compact('patient','organizations','user'));


})->name('edit_patient_target_rangeorg');
Route::any('organization/aboutpatient/', function (Request $request) {
    // Retrieve the patient information based on the $patientId

       
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patientId;
    } else {
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
    }
  
        $professionalId = session('professional_id');
        $organizationid = session('organization_id');
    $organizations = Organization::all();
    $user = session('authenticated_user');
   $professional_id = $user->professional_id;
    $organizationid = $request->input('organization_id');

    $organization_id = $request->input('organization_id');
    session(['organization_id' => $organization_id]);
    // Pass the patient information to the view
    return view('/orgadminview/aboutpatient', compact(
        'patient',
        'user',
        'organizations',
        'organizationid',
        'organization_id',
        'patientId',
        'professionalId'
    ));
    
})->name('aboutpatientorg');


 Route::get('/myuser/{professional_id}', function ($professional_id) {

    $organizations = Organization::all();
     $professionalss = App\Models\Professional::find($professional_id);
     // Pass the patient information to the view
    return view('myuser', compact('professionalss','organizations'));

 })->name('myuser');
Route::get('/org-myprofile', function () {
    $user = session('authenticated_user'); // Replace with your method of getting the authenticated user
    $professional_id = $user->professional_id;
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $professionalss = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('/orgadminview/myprofile', compact('professionalss','organizations','user'));

})->name('myprofileorg');
Route::any('/org-myuser', function (Request $request) {
    $user = session('authenticated_user');
    if ($request->has('professional_id')) {
        $professional_id = $request->input('professional_id');
        session(['professional_id' => $professional_id]);
    }elseif (session()->has('professional_id')) {
        $professional_id = session('professional_id');
        session(['professional_id' => $professional_id]);
        $user =  App\Models\Professional::where('professional_id', $professional_id)->first();
    }else {
        $user = session('authenticated_user');
        $professional_id = $user->professional_id;
    }
 
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $professionalss = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('/orgadminview/myuser', compact('professionalss','organizations','user'));

})->name('myuserorg');

Route::any('/org-myprofile', function (Request $request) {
   if (session()->has('professional_id')) {
        $professional_id = session('professional_id');
        session(['professional_id' => $professional_id]);
        $user =  App\Models\Professional::where('professional_id', $professional_id)->first();
    }else {
        $user = session('authenticated_user');
        $professional_id = $user->professional_id;
    }
 
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $professionalss = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('/orgadminview/myprofile', compact('professionalss','organizations'));

})->name('myprofileorgs');
Route::get('/editmyuser/{professionalid}', function ($professional_id) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::pluck('organization_name')->all();
    $roles = Role::pluck('name', 'organizationid')->all();
    $professionalss = App\Models\Professional::find($professional_id);
    // Pass the patient information to the view
    return view('users.editmyuser', compact('professionalss','roles','organizations'));

})->name('editmyuser');
Route::post('/org-editmyuser-update', [UserController::class, 'updateorg'])->name('updateuserorg');
Route::post('/org-editmyuser-updatemyprofile', [UserController::class, 'updateorgmyprofile'])->name('updateorgmyprofile');
Route::any('/org-editmyuser', function (Request $request) {
    
    if ($request->has('professional_id')) {
        $professional_id = $request->input('professional_id');
        $user = session('authenticated_user');
    } elseif (session()->has('professional_id')) {
        $user = session('authenticated_user');
        $professional_id = $user->professional_id;
    
        $user = App\Models\Professional::where('professional_id', $professional_id)->first();
        
    }
    $organizationid = session('organizationid');
 
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::pluck('organization_name')->all();
    $roles = Role::pluck('name', 'organizationid')->all();
    $professionalss = App\Models\Professional::find($professional_id);
  
    // Pass the patient information to the view
    return view('/orgadminview/editmyuser', compact('professionalss','roles','organizations','organizationid','user'));

})->name('editmyuserorg');


Route::any('/org-editmyprofile', function (Request $request) {
    
    if ($request->has('professional_id')) {
        $professional_id = $request->input('professional_id');
        $user = session('authenticated_user');
    } elseif (session()->has('professional_id')) {
        $user = session('authenticated_user');
        $professional_id = $user->professional_id;
    
        $user = App\Models\Professional::where('professional_id', $professional_id)->first();
        
    }
    $organizationid = session('organizationid');
 
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::pluck('organization_name')->all();
    $roles = Role::pluck('name', 'organizationid')->all();
    $professionalss = App\Models\Professional::find($professional_id);
  
    // Pass the patient information to the view
    return view('/orgadminview/editmyprofile', compact('professionalss','roles','organizations','organizationid','user'));

})->name('editmyprofile');
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
Route::any('/org-myorganization', [TableController::class, 'showorg'])->name('myorganizationorg');
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
Route::get('/org-hyper', [TableController::class, 'viewhyperorg'])->name('hyperorg');
Route::get('/org-hypo', [TableController::class, 'viewhypoorg'])->name('hypoorg');
Route::get('/hyperreport', [TableController::class, 'viewhyperreport'])->name('hyperreport');
Route::get('/hyporeport', [TableController::class, 'viewhyporeport'])->name('hyporeport');
Route::any('/org-create', [UserController::class, 'createorg'])->name('createuser');
Route::any('/org-createuser', [UserController::class, 'storeuserorg'])->name('storeuserorg');
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
Route::any('/organization/logbook_bg2', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
    } elseif (session()->has('patient_id')){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;

    // Additional code
    $organizations = App\Models\Organization::all();


    // Pass the patient information, logbook, and other data to the view
    return view('/orgadminview/logbook_bg2', [
        'patient' => $patient,
        'logbook' => $logbook,
        'user' => $user,
        'organizations' => $organizations,
        'organization_id' => $organization_id,
        'patientId' => $patientId,
        'professional_id' => $professional_id,
    ]);
})->name('logbook_bg2org');

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




Route::any('/organization/healthdata', function (Request $request) {
    $healthdata = App\Models\healthdata::all();

    if (session('patient') !== null) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
        
    } elseif (session('patient_id') !== null){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;
    // Additional code
    $organizations = App\Models\Organization::all();
    $organizationid = session('organization_id');
    $singleHealthData = App\Models\healthdata::where('patient_id_FK', $patientId)->first();

    return view('/orgadminview/healthdata', compact(
        'patient',
        'user',
        'organizations',
        'organizationid',
        'patientId',
        'singleHealthData',
        'healthdata',
        'professional_id',
        'patientId'
    ));
})->name('healthdataorg');
Route::any('/organization/addhealthdata', function (Request $request) {
    $healthdata = App\Models\healthdata::all();
  
    if (session('patient') !== null) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
        
    } elseif (session('patient_id') !== null){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    
    $organizations = App\Models\Organization::all();
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;
    $singleHealthData = App\Models\healthdata::where('patient_id_FK', $patientId)->first();
    return view('/orgadminview/addhealthdata', [
        'patient' => $patient,
        'user' => $user,
        'organizations' => $organizations,
        'organizationid' => $organization_id,
        'patientId' => $patientId,
       'singleHealthData' => $singleHealthData,
        'healthdata' => $healthdata,
        'professional_id' => $professional_id,
    ]);
})->name('addhealthdataorg');
Route::any('/healthdata', function (Request $request) {
    $healthdata = App\Models\healthdata::all();
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
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
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
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
Route::any('/org-edithealthdata', function (Request $request) {
    $healthdata = App\Models\healthdata::all();
 
    $healthdata_id = $request->input('healthdata_id');
    if (session('patient') !== null) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
        
    } elseif (session('patient_id') !== null){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
      
        $organization_id = session('organizationid');
    }
  $user = session('authenticated_user');
  $organizationid = session('organizationid');
    $singleHealthData = App\Models\healthdata::where('patient_id_FK', $patientId)
    ->where('healthdata_id', $healthdata_id)
    ->first();

    return view('/orgadminview/edithealthdata', compact('patient', 'healthdata', 'singleHealthData','user','healthdata_id','organizationid'));
})->name('edithealthdataorg');


Route::any('organization/logbookbg', function (Request $request) {

    
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
    } elseif (session()->has('patient_id')){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;
    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
  
    // Pass the patient information to the view
    return view('/orgadminview/logbook_bg', ['patient'=>$patient,'logbook'=>$logbook,
    'organization_id' => $organization_id,
    'user' => $user,
'professional_id' => $professional_id,
]);
})->name('logbook_bgorg');

Route::any('organization/logbookbp', function (Request $request) {

    
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
    } elseif (session()->has('patient_id')){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;

    // Retrieve the patient information based on the $patientId
    $logbook = App\Models\logbook::all();
  
    // Pass the patient information to the view
    return view('/orgadminview/logbook_bp', ['patient'=>$patient,'patientId' => $patientId,
    'organization_id' => $organization_id,
    'logbook' => $logbook,
    'user' => $user,
'professional_id' => $professional_id]);
})->name('logbook_bporg');


Route::any('organization/dashboard_bg', function (Request $request) {
    // Retrieve the patient information based on the $patientId

    if (session('patient') !== null) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
    } elseif (session('patient_id') !== null){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;

    $logbook = App\Models\logbook::where('patient_id_FK', $patientId)->get();
    // Retrieve the patient information based on the $patientId
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();

    // Pass the patient information to the view
    return view('/orgadminview/dashboard_bg', compact('patient', 'organization_id', 'user', 'healthdata', 'logbook'));

})->name('dashboard_bgorg');

Route::any('organization/dashboard_bp', function (Request $request) {
    // Retrieve the patient information based on the $patientId


    if (session('patient') !== null) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
        
    } elseif (session('patient_id') !== null){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;
  

    $logbook = App\Models\logbook::where('patient_id_FK', $patientId)->get();
    // Retrieve the patient information based on the $patientId
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();    
 
    // Pass the patient information to the view
    return view('/orgadminview/dashboard_bp', ['patient'=>$patient,
    'organization_id' => $organization_id,
    
    'user' => $user,
    'healthdata' => $healthdata,'logbook' => $logbook]);
})->name('dashboard_bporg');
Route::any('organization/dashboard_cho', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    if (session('patient') !== null) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
        
    } elseif (session('patient_id') !== null){
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    }
    $user = session('authenticated_user');
    $professional_id = $user->professional_id;
  

    $logbook = App\Models\logbook::where('patient_id_FK', $patientId)->get();
    // Retrieve the patient information based on the $patientId
    $healthdata = App\Models\healthdata::where('patient_id_FK', $patientId)->get();
    

    // Pass the patient information to the view
    return view('/orgadminview/dashboard_cholesterol', ['patient'=>$patient,
    'organization_id' => $organization_id,
    'user' => $user,
    'healthdata' => $healthdata,'logbook' => $logbook]);
})->name('dashboard_choorg');
Route::match(['get', 'post'], '/dashboard_generals', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    if ($request->has('patient_id')) {
        $patientId = $request->input('patient_id');
        $professional_id = $request->input('professional_id');
        $organizationid = $request->input('organization_id');
        $organization_id = $request->input('organization_id');
        $patient = App\Models\Patient::find($patientId);
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
        session(['organization_id' => $organizationid]);
        session(['organization_id' => $organization_id]);
        session(['patient' => $patient]);
    } elseif (session('patient_id') !== null) {
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
        $organization_id = session('organizationid');
    } else if (session('patient') !== null) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
        $organization_id = session('organizationid');
    }

    $user = session('authenticated_user');
    $professional_id = $user->professional_id;
   
   
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
    return view('/orgadminview/dashboard_general', compact(
        'patient',
        'organization_id',
        'user',
        'healthdata',
        'chat_messages',
        'latestweight',
        'secondlatestweight',
        'secondLatestBMI',
        'latestBMI',
        'secondlatestcarbon',
        'latestcarbon',
        'secondlatestactivity',
        'latestactivity'
    ));
    
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
Route::any('/dashboard_generalss', function (Request $request) {
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
Route::post('/organization/healthdatas/{patient_id}', [CreateController::class, 'inserthealthdataorg'])->name('create.healthdataorg');
Route::post('/healthdata-update/{patient_id}-{healthdata_id}', [CreateController::class, 'updatehealthdata'])->name('update-healthdata');
Route::post('/org-healthdata-update', [CreateController::class, 'updatehealthdataorgs'])->name('update-healthdataorg');
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
Route::get('/addpracticegroup', [TableController::class, 'practice'])->name('practice');
Route::post('/professionalingroupadd/{practice_group_id}', function ($practice_group_id) {
    $organization_id = session('organizationid');
    $user = session('authenticated_user');
    // Retrieve the patient information based on the $patientId
    $professionalingroup = App\Models\professionalingroup::all();
    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);
    $professional = App\Models\Professional::where('organizationid_FK', $organization_id)->get();
 // Pass the patient information to the view
 return view('/orgadminview/practice_group_add_professional', [
    'user' => $user,
    'practicegroup' => $practicegroup,
    'professional' => $professional,
    'professionalingroup' => $professionalingroup,
    'organizationid' => $organization_id,
]);


})->name('orgprac4');


Route::post('/patientingroupadd/{practice_group_id}', function ($practice_group_id) {
    // Retrieve the patient information based on the $patientId
    $organization_id = session('organizationid');
    $user = session('authenticated_user');

    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);
    $patient = App\Models\Patient::where('organizationid_FK', $organization_id)->get();;
    $patientingroup = App\Models\patientingroup::all();
    
    return view('/orgadminview/practice_group_add_patient',[
        'user'=>$user,
        'patient' => $patient,
        'practicegroup' => $practicegroup,
        'patientingroup' => $patientingroup,
        ]
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
Route::post('/createpracticegrouporg', [UserController::class, 'practicegroupaddorg'])->name('orginsert4.createpracticegroup');
Route::any('/praticegroupdetail/{practice_group_id}', function ($practice_group_id) {
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
Route::post('/org-deletes', [TableController::class, 'deletehealthdataorg'])->name('deletesorg');
Route::get('/deletemedication/{medicationId}', [TableController::class, 'deletemedication'])->name('deletemedication');
Route::get('/organization/{organizationId}', [LoginController::class, 'ipaddress'])
    ->where('organizationId', '[0-9]+')
    ->name('custom.login');
Route::any('/orghome{organizationId}', [LoginController::class, 'orglogin'])->name('orglogin');

Route::get('/orgpracticegroup', [TableController::class, 'orgpracticegroup'])->name('orgpracticegroup');


Route::any('/praticegroupdetails/{practice_group_id}', function (Request $request, $practice_group_id) {
    // Retrieve the patient information based on the $patientId
    $organizationid = session('organizationid');

    $practicegroup = App\Models\PracticeGroup::find($practice_group_id);

    $user = session('authenticated_user');
    
    $patientingroup = App\Models\patientingroup::where('group_id', $practice_group_id)->get();
    $patient = App\Models\Patient::all();
    $logbook = App\Models\logbook::all();
    // Pass the patient information to the view
   
    return view('/orgadminview/practice_group_detail', [
        'user' => $user,
        'practicegroup' => $practicegroup,
        'patientingroup' => $patientingroup,
        'logbook' => $logbook,
        'patient' => $patient,
        'organizationid' => $organizationid
    ]);

})->name('orgpractice_group_detail');

Route::post('/update_logbook/{logbook_id}', [LogbookController::class, 'updateLogbook'])->name('update.logbook');
Route::post('/practicegroupdetailadd/{practice_group_id}', [TableController::class, 'orgaddPatientInGroup'])->name('orgpractice_group_detailadd');
Route::post('/practicegroupdetailadd2/{practice_group_id}/{organization_id}', [TableController::class, 'orgaddProfessionalInGroup'])->name('orgpractice_group_detailadd2');
Route::get('/practicegroupdetaildelete/{practice_group_id}/{organization_id}', [TableController::class, 'orgdeletePracticeGroup'])->name('orgpractice_group_detaildelete');
Route::get('/download_template', [TableController::class, 'downloadTemplate'])->name('download_template');
Route::get('/download_templateuser', [TableController::class, 'downloadTemplateorg'])->name('download_templateuser');
Route::any('/org-export', [TableController::class, 'exportorg'])->name('exportorg');
Route::get('/importform', [TableController::class, 'showForm'])->name('import.form');
Route::post('/import', [TableController::class, 'import'])->name('import');
Route::post('/importuser', [TableController::class, 'importuser'])->name('importuser');
Route::post('/import_medication', [TableController::class, 'import_medication'])->name('import_medication');
Route::post('/{patient_id}/updateglucosetarget', [CreateController::class, 'updateglucosetarget'])->name('healthdata.update');
Route::post('/{patient_id}/updatetargetrange', [CreateController::class, 'updatetargetrange'])->name('healthdata.update2');
Route::any('/org-updateglucosetarget', [CreateController::class, 'updateglucosetargetorg'])->name('healthdata.updateorg');
Route::any('/org-updatetargetrange', [CreateController::class, 'updatetargetrangeorg'])->name('healthdata.update2org');
Route::post('/send-message/{patient_id}', [ChatController::class, 'sendMessage'])->name('sendMessage');
Route::any('/remark',function (Request $request) {
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
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
Route::any('/organization-remark',function (Request $request) {

        
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
    } else {
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
    }

$user = session('authenticated_user');
$professionalId = $user->professional_id;
    $organizationid = session('organization_id');
    
  
 
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $user = App\Models\Professional::find($professionalId);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();

    // Pass the patient information to the view
    return view('/orgadminview/remark', compact(
        'patientId',
        'professionalId',
        
        'organizationid',
      
        'patient',
        'user',
        'organizations',
        'chat_messages',
        'remark',
        'professional'
    ));
    


})->name('remarkorg');

Route::any('/medication',function (Request $request) {
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
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

Route::any('/organizations-medication', function (Request $request) {

if (session()->has('patient')) {
    $patient = session('patient');
    $patientId = $patient->patient_id;
} else {
    $patientId = session('patient_id');
    $patient = App\Models\Patient::find($patientId);
}

$user = session('authenticated_user');
$professionalId = $user->professional_id;

    $organizationid = session('organizationid');
  



  
   
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $medication = App\Models\Medication::inRandomOrder()->first();
    $singleDiagnosis = $request->input('diagnosisid');
    

    $diagnosis = \App\Models\Diagnosis::where('patient_id_FK', $patientId)
    ->where('diagnosis_id', $singleDiagnosis)
    ->first();
    $medicationindiagnosis = App\Models\MedicationInDiagnosis::all();
    $professional =App\Models\Professional::all();
    $allergy = App\Models\Allergy::where('patient_id_FK', $patientId)->get();
    $singleallergy =App\Models\Allergy::where('patient_id_FK', $patientId)->first();
    $diagnosis = App\Models\Diagnosis::where('patient_id_FK', $patientId)->get();

    return view('/orgadminview/medication', compact(
        'patient',
        'medication',
        'organizations',
        'user',
        'patientId',
        'professionalId',
        'organizationid',
       
        'chat_messages',
        'professional',
        'allergy',
        'diagnosis',
        'singleallergy',
        'medicationindiagnosis'
    ));
    
})->name('medicationreportorg');


Route::post('/addallergy',function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
    }
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    // Pass the patient information to the view
    return view('addallergy', compact('patient','organizations','user','chat_messages','remark','professional'));


})->name('addallergy');

Route::any('/organization-addallergy', function (Request $request) {
  
        $organizations = Organization::all();
        $chat_messages = App\Models\ChatMessage::all();
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
        $patient = App\Models\Patient::find($patientId);
        
        $user = App\Models\Professional::find($professional_id);
        $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
        $professional = App\Models\Professional::all();
    
        // Pass the patient information to the view
        return view('/orgadminview/addallergy', compact(
            'patient',
            'organizations',
            'user',
            'chat_messages',
            'remark',
            'professional',
            'patientId',
            'professional_id', // Assuming these are the same
            'professionalId',  // Assuming these are the same
            'organizationid',
            'organization_id', // Assuming these are the same
        ));
        
        
})->name('addallergyorg');
    

Route::any('/addremark',function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
        
    }
    $patient = App\Models\Patient::find($patientId);
    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    // Pass the patient information to the view
    return view('addremark', compact('patient','organizations','user','chat_messages','remark','professional'));
})->name('addremark');

Route::any('/organization-addremark', function (Request $request) {
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    
    if (session()->has('patient')) {
        $patient = session('patient');
        $patientId = $patient->patient_id;
    } else {
        $patientId = session('patient_id');
        $patient = App\Models\Patient::find($patientId);
    }

$user = session('authenticated_user');
$professionalId = $user->professional_id;
$organizationid = session('organizationid');

    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();

    // Pass all the variables to the view
    return view('/orgadminview/addremark',['organizationid'=>$organizationid,'user'=>$user],);
})->name('addremarkorg');

Route::any('/adddiagnosis',function (Request $request) {
    // Retrieve the patient information based on the $patientId
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
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

Route::any('/organization-adddiagnosis',function (Request $request) {     
    // Retrieve the patient information based on the $patientId
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $patientId = $request->input('patient_id');
        $professional_id = $request->input('professional_id');
        $organizationid = $request->input('organization_id');
     
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
        session(['organization_id' => $organizationid]);
        $organization_id = $request->input('organization_id');
        session(['organization_id' => $organization_id]);
    } else {
        $patientId = session('patient_id');
        $organization_id = session('organization_id');
        $organizationid = session('organization_id');
        $professional_id = session('professional_id');
      
    
    }
    $medication = App\Models\Medication::all();


    $medicationindiagnosis   = App\Models\MedicationInDiagnosis::all();
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
   
   
    $patient = App\Models\Patient::find($patientId);

    $user = App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional = App\Models\Professional::all();
    // Pass the patient information to the view
    return view('/orgadminview/adddiagnosis', [
        'patient' => $patient,
        'organizations' => $organizations,
        'user' => $user,
        'chat_messages' => $chat_messages,
        'remark' => $remark,
        'professional' => $professional,
        'medication' => $medication,

        'medicationindiagnosis' => $medicationindiagnosis,
        'patientId' => $patientId,
        'professionalId' => $professional_id,
        'professional_id' => $professional_id,
        'organizationid' => $organizationid,
        'organization_id' => $organization_id,
    ]);


})->name('adddiagnosisorg');
Route::any('/edit-diagnosis/{diagnosisId}', function (Request $request, $diagnosisId) {
    // Retrieve the patient information based on the $patientId
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
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

Route::any('/organization-edit-diagnosis', function (Request $request) {
    // Retrieve the patient information based on the $patientId
    $organizations = Organization::all();
    $chat_messages = App\Models\ChatMessage::all();
    $organizationid = $request->input('organization_id');

    $patientId = session('patient_id');
    $professional_id = session('professional_id');
    $professionalId = session('professional_id');

    session(['organization_id' => $organizationid]);
    $organization_id = $request->input('organization_id');
    session(['organization_id' => $organization_id]);

    $patient = App\Models\Patient::find($patientId);
    $medication = App\Models\Medication::all();
    $medicationindiagnosis = App\Models\MedicationInDiagnosis::all();
    $organizations = Organization::all();
    $chat_messages =  App\Models\ChatMessage::all();
   

    $diagnosisId = $request->input('diagnosisid'); // Assuming the name of the ID field in your model
    $diagnosis = App\Models\Diagnosis::where('patient_id_FK', $patientId)
    ->where('diagnosis_id', $diagnosisId)
    ->first();
    session(['diagnosisId' => $diagnosisId]);
    $diagnosisId = session('diagnosisId');
    $user =  App\Models\Professional::find($professional_id);
    $remark = App\Models\Remark::where('patient_id_FK', $patientId)->get();
    $professional =  App\Models\Professional::all();

    // Use compact to pass variables to the view
    return view('/orgadminview/editdiagnosis', [
        'patient' => $patient,
        'organizations' => $organizations,
        'user' => $user,
        'chat_messages' => $chat_messages,
        'remark' => $remark,
        'professional' => $professional,
        'medication' => $medication,
        'medicationindiagnosis' => $medicationindiagnosis,
        'diagnosis' => $diagnosis,
        'diagnosisId' => $diagnosisId,
        'patientId' => $patientId,
        'professional_id' => $professional_id, // Assuming these are the same
        'professionalId' => $professionalId,  // Assuming these are the same
        'organizationid' => $organizationid,
        'organization_id' => $organization_id, // Assuming these are the same
    ]);
    
})->name('edit-diagnosisorg');
Route::get('/delete/{patientId}/{allergy_Id}/{professionalId}', [TableController::class, 'deleteallergy'])->name('deleteallergy');
Route::get('/org-delete', [TableController::class, 'deleteallergyorg'])->name('deleteallergyorg');
Route::any('/org-delete-med', [TableController::class, 'deletemedicationorg'])->name('deletemedicationorg');
Route::post('/patients/remark', [RemarkController::class, 'submitForm'])->name('patients.remark.submit');
Route::post('/remark/submit', [RemarkController::class, 'submitForms'])->name('patients.remark.submits');
Route::post('/allergies', [AllergyController::class, 'store'])->name('allergy.store');
Route::post('/organization-allergies-store', [AllergyController::class, 'storeorg'])->name('allergy.storeorg');
Route::post('/store-diagnosis-and-medication', [DiagnosisController::class, 'storeDiagnosisAndMedication'])->name('store.diagnosis.medication');
Route::post('/organization-store-diagnosis-and-medication', [DiagnosisController::class, 'storeDiagnosisAndMedicationorg'])->name('store.diagnosis.medicationorg');
Route::post('/update-diagnosis-and-medication/{diagnosisId}', [DiagnosisController::class, 'updateDiagnosisAndMedication'])->name('update.diagnosis.medication');
Route::post('/organization-update-diagnosis-and-medication', [DiagnosisController::class, 'updateDiagnosisAndMedicationorg'])->name('update.diagnosis.medicationorg');
Route::post('/update-diagnosis-active/{diagnosisId}',[DiagnosisController::class, 'updateActiveStatus']);
Route::post('/update-diagnosis-inuse/{diagnosisId}', [DiagnosisController::class, 'updateInUseStatus']);
Route::any('/medication-list',function (Request $request) {
    if ($request->has('professional_id') && $request->has('patient_id')) {
        $professional_id = $request->input('professional_id');
        $patientId = $request->input('patient_id');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
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
        $singleDiagnosis = $request->input('diagnosisid');
        session(['patient_id' => $patientId]);
        session(['professional_id' => $professional_id]);
        session(['diagnosisid' => $singleDiagnosis]);
    } else {
        $patientId = session('patient_id');
        $professional_id = session('professional_id');
        $singleDiagnosis = session('diagnosisid');
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

Route::any('/organization-patient-medicine}',function (Request $request) {

    $user = session('authenticated_user');
    $organizationid = $request->input('organization_id');

    $patientId = session('patient_id');
    $professional_id = session('professional_id');
    $professionalId = session('professional_id');


    session(['organization_id' => $organizationid]);
    $organization_id = $request->input('organization_id');
    session(['organization_id' => $organization_id]);

    $patient = App\Models\Patient::find($patientId);

        $singleDiagnosis = session('diagnosisid');
    
    $singleDiagnosis = $request->input('diagnosisid');
   
    $medication = App\Models\Medication::all();

    $diagnosis = \App\Models\Diagnosis::where('patient_id_FK', $patientId)
    ->where('diagnosis_id', $singleDiagnosis)
    ->first();

    // Pass the patient information to the view
    return view('/orgadminview/patients-medication-create', [
        'user' => $user,
        'diagnosis' => $diagnosis,
        'singleDiagnosis' => $singleDiagnosis,
        'medication' => $medication,
        'patient' => $patient,
        'patientId' => $patientId,
        'professional_id' => $professional_id,
        'professionalId' => $professionalId, // If you want to pass both 'professional_id' and 'professionalId'
        'organizationid' => $organizationid,
        'organization_id' => $organization_id,
    ]);
})->name('patient-medicine-createorg');
Route::post('/medications', [MedicationController::class, 'store'])->name('medications.store');
Route::put('/medications/{medicationId}', [MedicationController::class, 'update'])->name('medications.update');

Route::get('/chat', [TableController::class, 'chatpage'])->name('chat');
Route::any('/search', [LogbookController::class, 'search'])->name('logbook.search');
Route::any('/search2', [LogbookController::class, 'search2'])->name('logbook.search2');
Route::any('/org-search', [LogbookController::class, 'searchorg'])->name('logbook.searchorg');
Route::any('/org-search2', [LogbookController::class, 'search2org'])->name('logbook.search2org');
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
Route::post('/organization-save-medication', [MedicationController::class, 'saveMedicationorg'])->name('saveMedicationorg');

Route::any('/filter-logbook',[LogbookController::class, 'filterLogbook'])->name('filter-logbook');
Route::any('/filter-logbookorg',[LogbookController::class, 'filterLogbookorg'])->name('filter-logbookorg');
Route::any('/mark-as-read',[LogbookController::class, 'markAsRead'])->name('markAsRead');