<?php
    
namespace App\Http\Controllers;
    
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use App\Models\Professional;
use App\Models\Organization;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use App\Models\PracticeGroup;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $roles = Role::pluck('name', 'organizationid')->all();
        $organizations = Organization::pluck('organization_name', 'organizationid')->all();
        $permission = Permission::get();
        return view('users.create', compact('roles', 'permission', 'organizations'));
    }

    public function loadRoles(Request $request)
    {
        $selectedOrganization = $request->input('selectedOrganization');
        // Retrieve roles based on the selected organization
        $roles = Role::where('organizationid', $selectedOrganization)->pluck('name')->toArray();
        return response()->json( $roles);
    }
    
    public function loadPermissions(Request $request)
    {
        $selectedRole = $request->input('selectedRole');
        $selectedOrganization = $request->input('selectedOrganization');
        // Retrieve the role ID based on the selected role name
        $roleId = Role::where('name', $selectedRole)->value('id');

        // Check if the role ID exists
    
        // Retrieve permissions based on the selected role ID, organization, and permission-organization relationship
        $permissions = Permission::whereHas('rolePermissions', function ($query) use ($roleId, $selectedOrganization) {
                $query->where('role_has_permissions.role_id', $roleId)
                    ->where('role_has_permissions.organizationid', $selectedOrganization);
            })
            ->select('name', 'id','permission_category')
            ->get();

        return response()->json(['permissions' => $permissions]);
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
{
    $this->validate($request, [
        'professional_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'professional_name' => 'required|string|max:255',
        'professional_email_address' => 'required|email|unique:professionals,professional_email_address|max:255',
        'password' => 'required|string|min:8|confirmed',
        'professional_mobile_phone' => 'required|string|max:20',
        'organization_name' => 'required|exists:organizations,organizationid',
        'professional_gender' => 'required|in:Male,Female',
        'username'=> 'required|string|max:255',
        'professional_type_of_profession' => 'required|in:Nurse,Therapist,Dietitians,Certified Diabetes Educator,Examiner,Doctor,Administration Staff,Pharmacist,Person In Charge',
        'temperature_unit'=>'required',
        'professional_account_role'=>'required',
        'permissions' => 'required',
    ]);
    $user = new Professional();
    if ($request->hasFile('professional_image')) {
        $imagePath = $request->file('professional_image')->store('professional_image', 'public');
        $user->professional_image = $imagePath;
    }
       // Fetch the selected organization and its name
       $selectedOrganizationId = $request->input('organization_name');
       $selectedOrganization = Organization::where('organizationid', $selectedOrganizationId)->first();
       $selectedOrganizationName = $selectedOrganization ? $selectedOrganization->organization_name : '';
   
       // Merge the selected organization name and ID into the request data
       $request->merge(['organization_name' => $selectedOrganizationName]);
       $request->merge(['organizationid_FK' => $selectedOrganizationId]);
      

       $user->professional_name = $request->input('professional_name');
       $user->professional_email_address = $request->input('professional_email_address');
       $user->password = Hash::make($request->input('password'));
       $user->professional_mobile_phone = $request->input('professional_mobile_phone');
       $user->organization_name = $selectedOrganizationName;
       $user->organizationid_FK = $selectedOrganizationId;
       $user->professional_gender = $request->input('professional_gender');
       $user->username = $request->input('username');
       $user->professional_type_of_profession = $request->input('professional_type_of_profession');
       $user->temperature_unit = $request->input('temperature_unit');
       // Hash the password
       $user->professional_account_role = $request->input('professional_account_role');
       $roleName = $request->input('professional_account_role');
       $role = Role::where('name', $roleName)->first();
       if ($role) {
        $user->role_id = $role->id;

        $user->save();
    }
       
       $input = $request->except('permissions'); // Use $request instead of $input
   
       // Sync user permissions
       $permissions = $request->input('permissions', []); // Assuming the permissions are coming from your form

// Sync the user's permissions
$user->permissions()->sync($permissions);
   
       // Assign role to the user
       $user -> save();
   
       return redirect()->route('all_user')->with('success', 'User created successfully');
   }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id): View
    {
        $user = Professional::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
    
        return view('users.edit',compact('user','roles','userRole'));
    }

    public function show($id): View
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
        ->where("role_has_permissions.role_id",$id)
            ->get();
        $user = professional::find($id);
        return view('users.show',compact('user','role','rolePermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

     public function update(Request $request, $id): RedirectResponse
{
    $user = Professional::findOrFail($id);
    $this->validate($request, [
        'professional_image' => 'required|image|mimes:jpeg,png,jpg,gif',
        'professional_name' => [
            'required',
            'string',
            'max:255',
            Rule::unique('professionals', 'professional_name')->ignore($user->professional_id,'professional_id'),
        ],
        'professional_email_address' => [
            'required',
            'email',
            'max:255',
            Rule::unique('professionals', 'professional_email_address')->ignore($user->professional_id,'professional_id'),
        ],
        'password' => 'required|string|min:6|confirmed',
        'professional_mobile_phone' => 'required|string|max:20',
        'organization_name' => 'required|exists:organizations,organizationid',
        'professional_gender' => 'required|in:Male,Female',
        'username'=> 'required|string|max:255',
        'professional_type_of_profession' => 'required|in:Nurse,Therapist,Dietitians,Certified Diabetes Educator,Examiner,Doctor,Administration Staff,Pharmacist,Person In Charge',
        'professional_account_role'=>'required',
        'permissions' => 'required',
     ]);

    
     if ($request->hasFile('professional_image')) {
        $imagePath = $request->file('professional_image')->store('professional_image', 'public');
        $user->professional_image = $imagePath;
    }
    // Update user information
    $user->professional_name = $request->input('professional_name');
    $user->professional_email_address = $request->input('professional_email_address');
    $user->professional_mobile_phone = $request->input('professional_mobile_phone');

    // Fetch the selected organization and its name
    $selectedOrganizationId = $request->input('organization_name');
    $selectedOrganization = Organization::where('organizationid', $selectedOrganizationId)->first();
    $selectedOrganizationName = $selectedOrganization ? $selectedOrganization->organization_name : '';

    // Update organization information
    $user->organization_name = $selectedOrganizationName;
    $user->organizationid_FK = $selectedOrganizationId;

    $user->professional_gender = $request->input('professional_gender');
    $user->username = $request->input('username');
    $user->professional_type_of_profession = $request->input('professional_type_of_profession');
    $user->temperature_unit = $request->input('temperature_unit');
    $user->professional_account_role = $request->input('professional_account_role');

    // Hash the password (if it's being updated)
    if ($request->filled('password')) {
        $user->password = Hash::make($request->input('password'));
    }

    // Assign role to the user
    $roleName = $request->input('professional_account_role');
    $role = Role::where('name', $roleName)->first();
    if ($role) {
        $user->role_id = $role->id;
    }

    $user->save();

    // Sync user permissions
    $permissions = $request->input('permissions', []);
    $user->permissions()->sync($permissions);
    DB::table('model_has_roles')->where('model_id', $id)->delete();
    $user->save();
    return redirect()->route('myuser', ['professional_id' => $id])->with('success', 'User updated successfully');

}

    //  public function update(Request $request, $id): RedirectResponse
    //  {
    //     $professionalss = Professional::findOrFail($id);
        
    //      $this->validate($request, [
    //         'professional_image' => 'required|image|mimes:jpeg,png,jpg,gif',
    //         'professional_name' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             Rule::unique('professionals', 'professional_name')->ignore($professionalss->professional_id,'professional_id'),
    //         ],
    //         'professional_email_address' => [
    //             'required',
    //             'email',
    //             'max:255',
    //             Rule::unique('professionals', 'professional_email_address')->ignore($professionalss->professional_id,'professional_id'),
    //         ],
    //         'password' => 'required|string|min:6|confirmed',
    //         'professional_mobile_phone' => 'required|string|max:20',
    //         'organization_name' => 'required|exists:organizations,organizationid',
    //         'professional_gender' => 'required|in:Male,Female',
    //         'username'=> 'required|string|max:255',
    //         'professional_type_of_profession' => 'required|in:Nurse,Therapist,Dietitians,Certified Diabetes Educator,Examiner,Doctor,Administration Staff,Pharmacist,Person In Charge',
    //         'professional_account_role'=>'required',
    //         'permissions' => 'required',
    //      ]);

         

    //      $selectedOrganizationId = $request->input('organization_name');
        
    //      $selectedOrganization = Organization::where('organizationid', $selectedOrganizationId)->first();
         
    //      $selectedOrganizationName = $selectedOrganization ? $selectedOrganization->organization_name : '';
         
    //      $request->merge(['organization_name' => $selectedOrganizationName]);
    //      $request->merge(['organizationid_FK' => $selectedOrganizationId]);
         
    //      if (!empty($input['password'])) {
    //          $input['password'] = Hash::make($input['password']);
    //      } 
    //      $input = $request->except('permissions');
        
    //      $user = Professional::find($id);
    
         
    //      $user->update($input);
         
         
     
    //      $permissions = $request->input('permissions', []);
    //      $user->permissions()->sync($permissions, []);
    //      $roleName = $request->input('professional_account_role');
    //      $role = Role::where('name', $roleName)->first();
         
    //      if ($role) {
    //          $user->role_id = $role->id;
    //          $user->save();
             
    //      }
    //      DB::table('model_has_roles')->where('model_id', $id)->delete();
    
       
    //      return redirect()->route('myprofile')
    //          ->with('success', 'User updated successfully');
    //  }
     
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    /*public function destroy($id): RedirectResponse
    {
        Professional::find($id)->delete();
        return redirect()->route('all_user')
                        ->with('successUser deleted successfully');
    }
    */
    

    public function practicegroupadd(Request $request): RedirectResponse
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'subTitle' => 'nullable|string|max:255',
      
    ]);


    $newPracticeGroup = new PracticeGroup();
    $newPracticeGroup->name = $validatedData['name'];
    $newPracticeGroup->subTitle = $validatedData['subTitle'];


    $newPracticeGroup->save();

    return redirect()->route('practicegroup');
}
public function practicegroupaddorg(Request $request, $organization_id): RedirectResponse
{
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'subTitle' => 'nullable|string|max:255',
    ]);

    $newPracticeGroup = new PracticeGroup();
    $newPracticeGroup->name = $validatedData['name'];
    $newPracticeGroup->subTitle = $validatedData['subTitle'];
    $newPracticeGroup->organizationid_FK = $organization_id; 
    $newPracticeGroup->save();

    return redirect()->route('orgpracticegroup', ['organization_id' => $organization_id]);
}
}
