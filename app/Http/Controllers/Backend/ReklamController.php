<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ReklamRequest;
use App\Models\Reklam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class ReklamController extends Controller
{

    // Start List of Reklam method
    public function ListOfReklams(){
        $reklams = Reklam::all();
        return view('backend.pages.reklam.list_of_reklams',compact('reklams'));
    // end List of reklam method
    }

    // Start Add Reklam method
    public function AddReklam(){
        return view('backend.pages.reklam.add_reklam');
    }
    // end Add Reklam method

    // Start Store Reklam method
    public function StoreReklam(ReklamRequest $request){

        if($request->file('image')){
            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize( 720, 250);
            $image->toJpeg(80)->save(base_path('public/Backend/assets/images/reklams/'.$name_gen));
            $image_path = 'Backend/assets/images/reklams/'.$name_gen;

            Reklam::create([
                'title' => $request->title,
                'url' => $request->url,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $image_path,
                'user_id' => Auth::user()->id,
                'created_at' => now(),
            ]);
            $notify = [
                'message' => 'Reklam Added Successfully',
                'alert-type' => 'success',
            ];
        return redirect()->route('list.reklam')->with($notify);

        }else{

        $notify = [
            'message' => 'Plesae Select an Image',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notify);

        }

    }
    // end Store Reklam method


    // Start Reklam Edit method
    public function EditReklam($id){
        $reklam = Reklam::findOrFail($id);
        return view('backend.pages.reklam.edit_reklam',compact('reklam'));

    }
    // end Reklam Edit method

    // Start Reklam Update method
    public function UpdateReklam(Request $request){

        $reklam=Reklam::findOrFail($request->id);
        if($request->file('image')){

            if(file_exists($reklam->image)){
                unlink($reklam->image);
            }

            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize( 150, 150);
            $image->toJpeg(50)->save(base_path('public/Backend/assets/images/reklams/'.$name_gen));
            $image_path = 'Backend/assets/images/reklams/'.$name_gen;

            $reklam->update([
                'title' => $request->title,
                'url' => $request->url,
                'description' => $request->description,
                'status' => $request->status,
                'image' => $image_path,
                'user_id' => Auth::user()->id,
                'updated_at' => now(),
            ]);
            }else{

                $notify = [
                    'message' => 'Plesae Select an Image',
                    'alert-type' => 'error',
                ];
                return redirect()->back()->with($notify);
            }

            $notify = [
                'message' => 'reklam Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('list.reklam')->with($notify);

    }
    // end reklam Update method


      // Start Reklam Ban method
      public function BanReklam(Request $request){
        Reklam::findOrFail($request->id)->delete();
        $notify = [
            'message' => 'Reklam Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Reklam Ban method


    // Start List of Recycle Reklam method
    public function ListOfRecycleReklam(){
        $reklams = Reklam::onlyTrashed()->get();
        return view('backend.pages.reklam.recycle_reklam',compact('reklams'));
    }
    // end List of Recycle reklam method


    // Start Reklam Restore method
    public function RestoreReklam(Request $request){
        Reklam::onlyTrashed()->findOrFail($request->id)->restore();
        $notify = [
            'message' => 'Reklam Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Reklam Restore method

    public function DeleteReklam(Request $request){

        $reklam = Reklam::where('id',$request->id)->withTrashed()->first();

        if ($reklam) {
            if(file_exists($reklam->image)){
                unlink($reklam->image);
            }
            $reklam->forceDelete();
            $notify = [
                'message' => 'Reklam Deleted Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notify = [
                'message' => 'Reklam not found',
                'alert-type' => 'error',
            ];
        }

        return response()->json($notify);
    }


    // Start Reklam Change Status method
    public function ReklamStatus($id){
        $reklam = Reklam::findOrFail($id);
        if($reklam->status == 'active'){
            $reklam->update([
                'status' => 'inactive',
            ]);
            $notify = [
                'message' => 'Reklam Status is Inactive Now',
                'alert-type' => 'success',
            ];
        }else{
            $reklam->update([
                'status' => 'active',
            ]);
            $notify = [
                'message' => 'Reklam Status is Active Now',
                'alert-type' => 'success',
            ];
        }

        return response()->json(['status'=>$reklam->status,'notify'=>$notify]);
    }
    // end Reklam Change Status method
}
