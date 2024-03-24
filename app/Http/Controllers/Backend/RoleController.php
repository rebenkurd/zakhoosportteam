<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    //Start List of Role Method
    public function ListOfRoles(){
        $roles = Role::all();
        return view('backend.pages.role.list_of_roles',compact('roles'));
    }
    //End List of Role Method

    //Start Add New Role Method
    public function AddRole(){
        return view('backend.pages.role.add_role');
    }
    //End Add New Role Method

    //Start Store Role Method
    public function StoreRole(Request $request){
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::create([
            'name' => Str::of($request->name)->apa() ,
            'created_at' => now(),
        ]);

        $notify = [
            'message' => 'Role Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('list.role')->with($notify);
    }
    //End Store Role Method

    //Start Delete Role Method
    public function DeleteRole(Request $request){
        Role::findOrFail($request->id)->delete();
        $notify = [
            'message' => 'Role Deleted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notify);
    }
    //End Delete Role Method

    //Start Edit Role Method
    public function EditRole($id){
        $role = Role::findOrFail($id);
        return view('backend.pages.role.edit_role',compact('role'));
    }
    //End Edit Role Method

    //Start Update Role Method
    public function UpdateRole(Request $request){
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        Role::findOrFail($request->id)->update([
            'name' => Str::of($request->name)->apa(),
            'updated_at' => now(),
        ]);

        $notify = [
            'message' => 'Role Updated Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('list.role')->with($notify);
    }
    //End Update Role Method


    //Start Assign Permission to Role Method
    public function AssignPermissionToRole($id){
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('backend.pages.role.assign_permission_to_role',compact('role','permissions'));
    }
    //End Assign Permission to Role Method

    //Start Store Permission to Role Method
    public function StoreAssignPermissionToRole(Request $request){
        $role = Role::findOrFail($request->id);
        $role->permissions()->detach();
        if ($request->has('permissions')) {
            $role->givePermissionTo($request->permissions);
        }
        $notify = [
            'message' => 'Permission Assigned to Role Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->route('list.role')->with($notify);
    }
    //End Store Permission to Role Method

}
