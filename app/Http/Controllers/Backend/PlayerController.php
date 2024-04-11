<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class PlayerController extends Controller
{
    // Start List of Player method
    public function ListOfPlayer(Request $request){
        if($request->ajax()){
            $data = Cache::rememberForever('players', function () {
                return Player::all();
            });
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.route("detail.player",$row->id).'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->full_name)->apa().'</span></a></div>'.
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
                '<li><a href="'.route("detail.player",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Detail</a></li>'.
                '<li><a href="'.route("edit.player",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
            rawColumns(['image','action','statusBtn'])->
            make(true);
        }
        return view('backend.pages.player.list_of_player');
    }
    // end List of Player method


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
    public function ListOfRecyclePlayer( Request $request){
        if($request->ajax()){
            $data = Cache::rememberForever('trashed_players', function () {
                return Player::onlyTrashed()->get();
            });
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.route("detail.player",$row->id).'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->full_name)->apa().'</span></a></div>'.
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
                '<li><a href="'.route("detail.player",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Detail</a></li>'.
                '<li><a href="'.route("edit.player",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
            rawColumns(['image','action','statusBtn'])->
            make(true);
        }
        return view('backend.pages.player.recycle_player');
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
            if(file_exists($data->image)){
                unlink($data->image);
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

    // Start Delete Multiple Player method
    public function DeleteMultiplePlayer(Request $request){

        $ids = $request->ids;
        $datas = Player::whereIn('id',$ids)->withTrashed()->get();
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
                    'message' => 'Player Deleted Successfully',
                    'alert-type' => 'success',
                ];
            } else {
                $notify = [
                    'message' => 'Player not found',
                    'alert-type' => 'error',
                ];
            }
        }
        return response()->json($notify);

    }
    // end Delete Multiple Player method

    // Start Multiple Player Ban method
    public function BanMultiplePlayer(Request $request){
        $ids = $request->ids;
        $datas = Player::whereIn('id',$ids)->withTrashed()->get();
        foreach($datas as $data){
            $data->delete();
        }
        $notify = [
            'message' => 'Player Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Multiple Player Ban method

    // Start Multiple Player Ban method
    public function RestoreMultiplePlayer(Request $request){
        $ids = $request->ids;
        $datas = Player::onlyTrashed()->whereIn('id',$ids)->get();
        foreach($datas as $data){
            $data->restore();
        }
        $notify = [
            'message' => 'Player Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Multiple Player Ban method

}
