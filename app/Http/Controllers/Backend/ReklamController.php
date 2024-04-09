<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\ReklamRequest;
use App\Models\Reklam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class ReklamController extends Controller
{

    // Start List of Reklam method
    public function ListOfReklams(Request $request){

        if($request->ajax()){
            $data = Reklam::query()->with('user');
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3 rounded-none"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.route("detail.user",$row->id).'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->title)->apa().'</span></a><small'.
                       'class="text-muted"> '.$row->email.'</small></div>'.
            '</div>';
            return $image;
            })
            ->addColumn('created_by',function($row)  {
                return $row->user->name;
            })
            ->
            addColumn('statusBtn',function($row){
                if($row->status == 'active'){
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="inactive"><span class="badge bg-label-success">Active</span></a>';
                }else{
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="active"><span class="badge bg-label-danger">Inactive</span></a>';
                }
                return $statusBtn;
            })->
            addColumn('action',function($row){
                $btn ='<button type="button"'.
                'class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"'.
                'data-bs-toggle="dropdown" aria-expanded="false">'.
                '<i class="ti ti-dots"></i>'.
            '</button>'.
            '<ul class="dropdown-menu dropdown-menu-end">'.
                '<li><a href="'.route("edit.reklam",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item ban-btn" data-id="'.$row->id.'"><i class="ti ti-ban"></i> Ban</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item delete-btn" data-id="'.$row->id.'"><i class="ti ti-trash"></i> Delete</a></li>'.
            '</ul>'
                ;

                return $btn;
            },)->
            rawColumns(['image','statusBtn','created_by','action'])->
            make(true);
        }
        return view('backend.pages.reklam.list_of_reklams');
    }
    // end List of reklam method

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
            $image->resize( 970, 250);
            $image->save(base_path('public/Backend/assets/images/reklams/'.$name_gen));
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
            $image->resize( 970, 250);
            $image->save(base_path('public/Backend/assets/images/reklams/'.$name_gen));
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
    public function ListOfRecycleReklam(Request $request){
        if($request->ajax()){
            $data = Reklam::query()->with('user')->onlyTrashed();
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3 rounded-none"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.route("detail.user",$row->id).'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->title)->apa().'</span></a><small'.
                       'class="text-muted"> '.$row->email.'</small></div>'.
            '</div>';
            return $image;
            })
            ->addColumn('created_by',function($row)  {
                return $row->user->name;
            })
            ->
            addColumn('statusBtn',function($row){
                if($row->status == 'active'){
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="inactive"><span class="badge bg-label-success">Active</span></a>';
                }else{
                    $statusBtn = '<a href="javascript:void(0);" class="status-toggle" data-id="'.$row->id.'" data-status="active"><span class="badge bg-label-danger">Inactive</span></a>';
                }
                return $statusBtn;
            })->
            addColumn('action',function($row){
                $btn ='<button type="button"'.
                'class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"'.
                'data-bs-toggle="dropdown" aria-expanded="false">'.
                '<i class="ti ti-dots"></i>'.
            '</button>'.
            '<ul class="dropdown-menu dropdown-menu-end">'.
                '<li><a href="'.route("edit.reklam",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item restore-btn" data-id="'.$row->id.'"><i class="ti ti-restore"></i> Restore</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item delete-btn" data-id="'.$row->id.'"><i class="ti ti-trash"></i> Delete</a></li>'.
            '</ul>'
                ;

                return $btn;
            },)->
            rawColumns(['image','statusBtn','created_by','action'])->
            make(true);
        }
        return view('backend.pages.reklam.recycle_reklam');
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


        // Start Delete Multiple Reklam method
        public function DeleteMultipleReklam(Request $request){

            $ids = $request->ids;
            $datas = Reklam::whereIn('id',$ids)->withTrashed()->get();
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
                        'message' => 'Reklam Deleted Successfully',
                        'alert-type' => 'success',
                    ];
                } else {
                    $notify = [
                        'message' => 'Reklam not found',
                        'alert-type' => 'error',
                    ];
                }
            }
            return response()->json($notify);

        }
        // end Delete Multiple Reklam method

        // Start Multiple Reklam Ban method
        public function BanMultipleReklam(Request $request){
            $ids = $request->ids;
            $datas = Reklam::whereIn('id',$ids)->withTrashed()->get();
            foreach($datas as $data){
                $data->delete();
            }
            $notify = [
                'message' => 'Reklam Baned Successfully',
                'alert-type' => 'error',
            ];
            return response()->json($notify);
        }
        // end Multiple Reklam Ban method

        // Start Multiple Reklam Ban method
        public function RestoreMultipleReklam(Request $request){
            $ids = $request->ids;
            $datas = Reklam::onlyTrashed()->whereIn('id',$ids)->get();
            foreach($datas as $data){
                $data->restore();
            }
            $notify = [
                'message' => 'Reklam Restored Successfully',
                'alert-type' => 'success',
            ];
            return response()->json($notify);
        }
        // end Multiple Reklam Ban method
}
