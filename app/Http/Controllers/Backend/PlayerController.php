<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class PlayerController extends Controller
{
    // Start List of Player method
    public function ListOfPlayer(){
        $datas = Player::all();
        return view('backend.pages.player.list_of_player',compact('datas'));
    // end List of Player method
    }


    // Start Add Player method
    public function AddPlayer(){
        return view('backend.pages.player.add_player');
    }
    // end Add Player method

    // Start Store Player method
    public function StorePlayer(Request $request){

        if($request->file('image')){
            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize( 150, 150);
            $image->toJpeg(50)->save(base_path('public/Backend/assets/images/players/'.$name_gen));
            $image_path = 'Backend/assets/images/players/'.$name_gen;

            Player::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'national' => $request->national,
                'position' => $request->position,
                'team_id' => 1,
                'description' => $request->description,
                'height' => $request->height,
                'weight' => $request->weight,
                'foot' => $request->foot,
                'joined' => $request->joined,
                'contract_expires' => $request->contract_expires,
                'shirt_number' => $request->shirt_number,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $image_path,
                'created_at' => now(),
            ]);
            $notify = [
                'message' => 'Player Added Successfully',
                'alert-type' => 'success',
            ];
        return redirect()->route('list.player')->with($notify);

        }else{

            Player::create([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'national' => $request->national,
                'position' => $request->position,
                'team_id' => 1,
                'description' => $request->description,
                'height' => $request->height,
                'weight' => $request->weight,
                'foot' => $request->foot,
                'joined' => $request->joined,
                'contract_expires' => $request->contract_expires,
                'shirt_number' => $request->shirt_number,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'status' => $request->status,
                'created_at' => now(),
            ]);
            $notify = [
                'message' => 'Player Added Successfully',
                'alert-type' => 'success',
            ];

        return redirect()->route('list.player')->with($notify);


        }

    }
    // end Store player method



    // Start player Edit method
    public function EditPlayer($id){
        $data = Player::findOrFail($id);
        return view('backend.pages.player.edit_player',compact('data'));

    }
    // end player Edit method


       // Start Player Update method
       public function UpdatePlayer(Request $request){

        $data=Player::findOrFail($request->id);
        if($request->file('image')){

            if(file_exists($data->image)){
                unlink($data->image);
            }

            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize( 150, 150);
            $image->toJpeg(50)->save(base_path('public/Backend/assets/images/players/'.$name_gen));
            $image_path = 'Backend/assets/images/players/'.$name_gen;

            $data->update([
                'first_name' => $request->first_name,
                'middle_name' => $request->middle_name,
                'last_name' => $request->last_name,
                'age' => $request->age,
                'national' => $request->national,
                'position' => $request->position,
                'description' => $request->description,
                'height' => $request->height,
                'weight' => $request->weight,
                'foot' => $request->foot,
                'joined' => $request->joined,
                'contract_expires' => $request->contract_expires,
                'shirt_number' => $request->shirt_number,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $image_path,
                'updated_at' => now(),
            ]);
            }else{
                $data->update([
                    'first_name' => $request->first_name,
                    'middle_name' => $request->middle_name,
                    'last_name' => $request->last_name,
                    'age' => $request->age,
                    'national' => $request->national,
                    'position' => $request->position,
                    'description' => $request->description,
                    'height' => $request->height,
                    'weight' => $request->weight,
                    'foot' => $request->foot,
                    'joined' => $request->joined,
                    'contract_expires' => $request->contract_expires,
                    'shirt_number' => $request->shirt_number,
                    'address' => $request->address,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'description' => $request->description,
                    'status' => $request->status,
                    'updated_at' => now(),
                ]);
            }

            $notify = [
                'message' => 'Player Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('list.player')->with($notify);

    }
    // end player Update method

    // Start Player Ban method
    public function BanPlayer(Request $request){
        Player::findOrFail($request->id)->delete();
        $notify = [
            'message' => 'Player Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Player Ban method



    // Start List of Recycle Player method
    public function ListOfRecyclePlayer(){
        $datas = Player::onlyTrashed()->get();
        return view('backend.pages.player.recycle_player',compact('datas'));
    }
    // end List of Recycle Player method


    // Start Player Restore method
    public function RestorePlayer(Request $request){
        Player::onlyTrashed()->findOrFail($request->id)->restore();
        $notify = [
            'message' => 'Player Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Player Restore method

    // Start player Delete method
    public function DeletePlayer(Request $request){

        $data = Player::where('id',$request->id)->withTrashed()->first();

        if ($data) {
            if(file_exists($data->logo)){
                unlink($data->logo);
            }
            $data->forceDelete();

            $notify = [
                'message' => 'player Deleted Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notify = [
                'message' => 'player not found',
                'alert-type' => 'error',
            ];
        }

        return response()->json($notify);
    }
    // End player Delete method


        // Start Player Change Status method
        public function PlayerStatus($id){
            $data = Player::findOrFail($id);
            if($data->status == 'active'){
                $data->update([
                    'status' => 'inactive',
                ]);
                $notify = [
                    'message' => 'Player Status is Inactive Now',
                    'alert-type' => 'success',
                ];
            }else{
                $data->update([
                    'status' => 'active',
                ]);
                $notify = [
                    'message' => 'Player Status is Active Now',
                    'alert-type' => 'success',
                ];
            }

            return response()->json(['status'=>$data->status,'notify'=>$notify]);
        }
        // end player Change Status method

}
