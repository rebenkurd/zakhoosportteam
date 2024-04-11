<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class UserController extends Controller
{
    // Start User Logout method
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    // end User Logout method

    // Start List of User method

    public function ListOfUsers(Request $request){

        if($request->ajax()){

            $data = Cache::rememberForever('users', function () {
                return User::all();
            });

            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.route("detail.user",$row->id).'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->name)->apa().'</span></a><small'.
                       'class="text-muted"> '.$row->email.'</small></div>'.
            '</div>';
            return $image;
            })->
            addColumn('action',function($row){
                $btn ='<button type="button"'.
                'class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"'.
                'data-bs-toggle="dropdown" aria-expanded="false">'.
                '<i class="ti ti-dots"></i>'.
            '</button>'.
            '<ul class="dropdown-menu dropdown-menu-end">'.
                '<li><a href="'.route("detail.user",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Detail</a></li>'.
                '<li><a href="'.route("edit.user",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item ban-btn" data-id="'.$row->id.'"><i class="ti ti-ban"></i> Ban</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item delete-btn" data-id="'.$row->id.'"><i class="ti ti-trash"></i> Delete</a></li>'.
            '</ul>'
                ;

                return $btn;
            },)->
            addColumn('statusBtn',function($row){
                if($row->status == 'active'){
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="inactive"><span class="badge bg-label-success">Active</span></a>';
                }else{
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="active"><span class="badge bg-label-danger">Inactive</span></a>';
                }
                return $statusBtn;
            })->
            addColumn('roleBtn',function($row){
                return !empty($row->getRoleNames()->first())? Str::of($row->getRoleNames()->first())->apa() : 'Subscriber';
            })->
            rawColumns(['image','action','statusBtn','roleBtn'])->
            make(true);
        }
        return view('backend.pages.user.list_of_users');
    }
    // end List of User method

    // Start Add User method
    public function AddUser(){
        $roles = Role::all();
        return view('backend.pages.user.add_user',compact('roles'));
    }
    // end Add User method

    // Start Store User method
    public function StoreUser(UserRequest $request){

        if($request->file('image')){
            $manager = new ImageManager(new Driver());

            $name_gen=hexdec(uniqid()).'.'.

            $request->image->getClientOriginalExtension();

            $image = $manager->read($request->file('image'));

            $image->resize( 300, 300);

            $image->toJpeg(60)->save(base_path('public/Backend/assets/images/users/'.$name_gen));

            $image_path = 'Backend/assets/images/users/'.$name_gen;

            $user=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'image' => $image_path,
                'created_at' => now(),
            ]);
            $user->assignRole($request->role);
        }else{
            $user=User::create([
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'status' => $request->status,
                'created_at' => now(),
            ]);
            $user->assignRole($request->role);
        }

        $notify = [
            'message' => 'User Added Successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('list.user')->with($notify);
    }
    // end Store User method


    // Start User Edit method
    public function EditUSer($user_id){
        $user = User::findOrFail($user_id);
        $roles = Role::all();
        return view('backend.pages.user.edit_user',compact('user','roles'));

    }
    // end User Edit method

    // Start User Update method
    public function UpdateUser(Request $request){

        $user=User::findOrFail($request->id);
        if($request->file('image')){

            if(file_exists($user->image)){
                unlink($user->image);
            }

            $manager = new ImageManager(new Driver());

            $name_gen=hexdec(uniqid()).'.'.

            $request->image->getClientOriginalExtension();

            $image = $manager->read($request->file('image'));

            $image->resize( 300, 300);

            $image->toJpeg(60)->save(base_path('public/Backend/assets/images/users/'.$name_gen));

            $image_path = 'Backend/assets/images/users/'.$name_gen;
            $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'status' => $request->status,
            'image' => $image_path,
            'updated_at' => now(),
            ]);
            $user->roles()->detach();
            $user->assignRole($request->role);
            }else{
                $user->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'username' => $request->username,
                    'status' => $request->status,
                    'updated_at' => now(),
                ]);
                $user->roles()->detach();
                $user->assignRole($request->role);
            }

            $notify = [
                'message' => 'User Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('list.user')->with($notify);

    }
    // end User Update method

    // Start User Ban method
    public function BanUser(Request $request){
        User::findOrFail($request -> id)->delete();
        $notify = [
            'message' => 'User Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json(['notify'=>$notify]);
    }
    // end User Ban method

    // Start User Detail method
    public function DetailUser($user_id){
        $user = User::findOrFail($user_id);
        return view('backend.pages.user.detail_user',compact('user'));
    }
    // end User Detail method

    // Start List of Recycle User method
    public function ListOfRecycleUser(Request $request){

        if($request->ajax()){
            $data = Cache::rememberForever('trashed_users', function () {
                return User::onlyTrashed()->get();
            });

            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.route("detail.user",$row->id).'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->name)->apa().'</span></a><small'.
                       'class="text-muted"> '.$row->email.'</small></div>'.
            '</div>';
            return $image;
            })->
            addColumn('action',function($row){
                $btn ='<button type="button"'.
                'class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"'.
                'data-bs-toggle="dropdown" aria-expanded="false">'.
                '<i class="ti ti-dots"></i>'.
            '</button>'.
            '<ul class="dropdown-menu dropdown-menu-end">'.
                '<li><a href="'.route("detail.user",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Detail</a></li>'.
                '<li><a href="'.route("edit.user",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item restore-btn" data-id="'.$row->id.'"><i class="ti ti-restore"></i> Restore</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item delete-btn" data-id="'.$row->id.'"><i class="ti ti-trash"></i> Delete</a></li>'.
            '</ul>'
                ;

                return $btn;
            },)->
            addColumn('statusBtn',function($row){
                if($row->status == 'active'){
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="inactive"><span class="badge bg-label-success">Active</span></a>';
                }else{
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="active"><span class="badge bg-label-danger">Inactive</span></a>';
                }
                return $statusBtn;
            })->
            addColumn('roleBtn',function($row){
                return !empty($row->getRoleNames()->first())? Str::of($row->getRoleNames()->first())->apa() : 'Subscriber';
            })->
            rawColumns(['image','action','statusBtn','roleBtn'])->
            make(true);
        }
        return view('backend.pages.user.recycle_user');
    }
    // end List of Recycle User method

    // Start User Restore method
    public function RestoreUser(Request $request){
        User::onlyTrashed()->findOrFail($request->id)->restore();
        $notify = [
            'message' => 'User Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json(['notify'=>$notify]);
    }
    // end User Restore method

    // Start User Delete method
    public function DeleteUser(Request $request){

        $user = User::where('id',$request->id)->withTrashed()->first();

        if ($user) {
            if(file_exists($user->image)){
                unlink($user->image);
            }
            $user->forceDelete();

            $notify = [
                'message' => 'user Deleted Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notify = [
                'message' => 'user not found',
                'alert-type' => 'error',
            ];
        }

        return response()->json($notify);
    }
    // end User Delete method

    // Start User Detail method
    public function ProfileUser($user_id){
        $user = Auth::user();
        return view('backend.pages.profile.auth_profile',compact('user'));
    }
    // end User Detail method

    // Start User Change Status method
    public function UserStatus($id){
        $user = User::findOrFail($id);
        if($user->status == 'active'){
            $user->update([
                'status' => 'inactive',
            ]);
        }else{
            $user->update([
                'status' => 'active',
            ]);
        }
        $notify = [
            'message' => 'User Status Changed Successfully',
            'alert-type' => 'success',
        ];
        return response()->json(['status'=>$user->status,'notify'=>$notify]);

    }
    // end User Change Status method

    // Start Delete Multiple User method
    public function DeleteMultipleUser(Request $request){

        $ids = $request->ids;
        $datas = User::whereIn('id',$ids)->withTrashed()->get();
        foreach($datas as $data){
            if(file_exists($data->image)){
                unlink($data->image);
            }
            if ($data) {
                if(file_exists($data->image)){
                    unlink($data->image);
                }
                $data->forceDelete();

                $notify = [
                    'message' => 'User Deleted Successfully',
                    'alert-type' => 'success',
                ];
            } else {
                $notify = [
                    'message' => 'User not found',
                    'alert-type' => 'error',
                ];
            }
        }
        return response()->json($notify);

    }
    // end Delete Multiple User method

    // Start Multiple User Ban method
    public function BanMultipleUser(Request $request){
        $ids = $request->ids;
        $datas = User::whereIn('id',$ids)->withTrashed()->get();
        foreach($datas as $data){
            $data->delete();
        }
        $notify = [
            'message' => 'User Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Multiple User Ban method

    // Start Multiple User Ban method
    public function RestoreMultipleUser(Request $request){
        $ids = $request->ids;
        $datas = User::onlyTrashed()->whereIn('id',$ids)->get();
        foreach($datas as $data){
            $data->restore();
        }
        $notify = [
            'message' => 'User Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Multiple User Ban method
}
