<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class RoleController extends Controller
{

    //Start List of Role Method
    public function ListOfRoles(Request $request){

        if($request->ajax()){
            $data = Role::query();
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
                return Str::of($row->name)->apa();
            })->
            addColumn('action',function($row){
                $btn ='<button type="button"'.
                'class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"'.
                'data-bs-toggle="dropdown" aria-expanded="false">'.
                '<i class="ti ti-dots"></i>'.
            '</button>'.
            '<ul class="dropdown-menu dropdown-menu-end">'.
                '<li><a href="'.route("edit.role",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item delete-btn" data-id="'.$row->id.'"><i class="ti ti-trash"></i> Delete</a></li>'.
            '</ul>'
                ;

                return $btn;
            },)->
            rawColumns(['image','action'])->
            make(true);
        }
        return view('backend.pages.role.list_of_roles');
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


    // Start Delete Multiple User method
    public function DeleteMultipleRole(Request $request){

        $ids = $request->ids;
        $datas = Role::whereIn('id',$ids)->get();
        foreach($datas as $data){
                $data->delete();

                $notify = [
                    'message' => 'User Deleted Successfully',
                    'alert-type' => 'success',
                ];
        }
        return response()->json($notify);

    }
    // end Delete Multiple User method
}
