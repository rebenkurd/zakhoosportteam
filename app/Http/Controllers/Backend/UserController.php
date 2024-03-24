<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

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
    public function ListOfUsers(){
        $users = User::all();
        return view('backend.pages.user.list_of_users',compact('users'));
    // end List of User method
    }

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
    public function ListOfRecycleUser(){
        $users = User::onlyTrashed()->get();
        return view('backend.pages.user.recycle_user',compact('users'));
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

}
