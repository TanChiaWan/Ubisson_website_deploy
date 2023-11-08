<?php
    
namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Organization;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
       
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $roles = Role::orderBy('id','DESC')->paginate(5);
        return view('roles.index',compact('roles'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $organizations = Organization::pluck('organization_name')->all();
        $permission = Permission::get();
        return view('roles.create',compact('permission','organizations'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'organization_name' => 'required|exists:organizations,organizationid',
            'permission' => 'required',
            
        ]);
        $organizationId = $request->input('organization_name');
       
        $role = Role::create(['name' => $request->input('name'),'organizationid' => $organizationId,]);
        $role->syncPermissions($request->input('permission'));
        DB::table("role_has_permissions")
        ->where("role_id", $role->id)
        ->update(['organizationid' => $organizationId]);
        return redirect()->route('all_role')
                        ->with('success','Role created successfully');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
    
        return view('roles.show',compact('role','rolePermissions'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $role = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
    
        return view('roles.edit',compact('role','permission','rolePermissions'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
{
    $this->validate($request, [
        'name' => 'required|unique:roles,name,'.$id,
        'organization_name' => 'required|exists:organizations,organizationid',
        'permission' => 'required',
    ]);

    $role = Role::find($id);
    $role->name = $request->input('name') ?? '';
    $role->organizationid = $request->input('organization_name');
    $role->save();

    $role->syncPermissions($request->input('permission'));

    // Update organization_id in roles_has_permissions table
    $rolePermissions = DB::table("role_has_permissions")
        ->where("role_has_permissions.role_id", $id)
        ->update(['organizationid' => $request->input('organization_name')]);

    return redirect()->route('all_role')->with('success', 'Role updated successfully');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        DB::table("roles")->where('id',$id)->delete();
        return redirect()->route('roles.index')
                        ->with('success','Role deleted successfully');
    }
}
