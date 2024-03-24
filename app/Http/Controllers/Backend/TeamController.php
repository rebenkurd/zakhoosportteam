<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class TeamController extends Controller
{

    // Start Detail Team method
    public function DetailTeam(){
        $data = Team::first();
        return view('backend.pages.team.detail_team',compact('data'));
    }
    // end Detail Team method

        // Start Team Update method
        public function UpdateTeam(Request $request){

            $data=Team::findOrFail($request->id);
            if($request->file('logo')){

                if(file_exists($data->logo)){
                    unlink($data->logo);
                }

                $manager = new ImageManager(new Driver());
                $name_gen=hexdec(uniqid()).'.'.$request->logo->getClientOriginalExtension();
                $image = $manager->read($request->file('logo'));
                $image->resize( 150, 150);
                $image->toJpeg(50)->save(base_path('public/Backend/assets/images/team/'.$name_gen));
                $image_path = 'Backend/assets/images/team/'.$name_gen;

                $data->update([
                    'name' => $request->name,
                    'stadium' => $request->stadium,
                    'city' => $request->city,
                    'country' => $request->country,
                    'founded' => $request->founded,
                    'president' => $request->president,
                    'coach' => $request->coach,
                    'captain' => $request->captain,
                    'vice_captain' => $request->vice_captain,
                    'description' => $request->description,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'facebook' => $request->facebook,
                    'twitter' => $request->twitter,
                    'instagram' => $request->instagram,
                    'youtube' => $request->youtube,
                    'status' => $request->status,
                    'logo' => $image_path,
                    'updated_at' => now(),
                ]);
                }else{
                    $data->update([
                        'name' => $request->name,
                        'stadium' => $request->stadium,
                        'city' => $request->city,
                        'country' => $request->country,
                        'founded' => $request->founded,
                        'president' => $request->president,
                        'coach' => $request->coach,
                        'captain' => $request->captain,
                        'vice_captain' => $request->vice_captain,
                        'description' => $request->description,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'address' => $request->address,
                        'facebook' => $request->facebook,
                        'twitter' => $request->twitter,
                        'instagram' => $request->instagram,
                        'youtube' => $request->youtube,
                        'status' => $request->status,
                        'updated_at' => now(),
                    ]);
                }

                $notify = [
                    'message' => 'Team Updated Successfully',
                    'alert-type' => 'success',
                ];

                return redirect()->back()->with($notify);

        }
        // end Team Update method

}
