<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PollCategory;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PollCategoryController extends Controller
{
        // Start List of PollCategory method
        public function ListOfPollCategory(Request $request){
            if($request->ajax()){
                $data = PollCategory::query();
                return DataTables::of($data)->addIndexColumn()->
                addColumn('image',function($row){
                $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                    '<div class="avatar-wrapper">'.
                        '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                        'class="rounded-circle"></div>'.
                    '</div>'.
                    '<div class="d-flex flex-column"><span'.
                                'class="fw-medium">'.Str::of($row->name)->apa().'</span></div>'.
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
                    '<li><a href="'.route("edit.poll.category",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
            return view('backend.pages.poll_category.list_of_poll_category');
        }
        // end List of PollCategory method


        // Start Add PollCategory method
        public function AddPollCategory(){
            return view('backend.pages.poll_category.add_poll_category');
        }
        // end Add PollCategory method

        // Start Store PollCategory method
        public function StorePollCategory(Request $request){

            if($request->file('image')){
                $manager = new ImageManager(new Driver());
                $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
                $image = $manager->read($request->file('image'));
                $image->resize( 150, 150);
                $image->toJpeg(50)->save(base_path('public/Backend/assets/images/poll_categories/'.$name_gen));
                $image_path = 'Backend/assets/images/poll_categories/'.$name_gen;

                PollCategory::create([
                    'name' => $request->name,
                    'slug' =>  Str::slug($request->name) ,
                    'description' => $request->description,
                    'image' => $image_path,
                    'status' => $request->status,
                    'created_at' => now(),
                ]);
                $notify = [
                    'message' => 'Poll Category Added Successfully',
                    'alert-type' => 'success',
                ];
            return redirect()->route('list.poll.category')->with($notify);

            }else{

                PollCategory::create([
                    'name' => $request->name,
                    'slug' =>  Str::slug($request->name) ,
                    'description' => $request->description,
                    'status' => $request->status,
                    'created_at' => now(),
                ]);
                $notify = [
                    'message' => 'Poll Category Added Successfully',
                    'alert-type' => 'success',
                ];

            return redirect()->route('list.poll.category')->with($notify);


            }

        }
        // end Store PollCategory method


    // Start PollCategory Edit method
    public function EditPollCategory($id){
        $data = PollCategory::findOrFail($id);
        return view('backend.pages.poll_category.edit_poll_category',compact('data'));

    }
    // end PollCategory Edit method


       // Start PollCategory Update method
       public function UpdatePollCategory(Request $request){

        $data=PollCategory::findOrFail($request->id);
        if($request->file('image')){

            if(file_exists($data->image)){
                unlink($data->image);
            }

            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize( 150, 150);
            $image->toJpeg(50)->save(base_path('public/Backend/assets/images/poll_categories/'.$name_gen));
            $image_path = 'Backend/assets/images/poll_categories/'.$name_gen;

            $data->update([
                'name' => $request->name,
                'slug' =>  Str::slug($request->name) ,
                'description' => $request->description,
                'image' => $image_path,
                'status' => $request->status,
                'updated_at' => now(),
            ]);
            }else{
                $data->update([
                    'name' => $request->name,
                    'slug' =>  Str::slug($request->name) ,
                    'description' => $request->description,
                    'status' => $request->status,
                    'updated_at' => now(),
                ]);
            }

            $notify = [
                'message' => 'PollCategory Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('list.poll.category')->with($notify);

    }
    // end PollCategory Update method

    // Start PollCategory Ban method
    public function BanPollCategory(Request $request){
        PollCategory::findOrFail($request->id)->delete();
        $notify = [
            'message' => 'PollCategory Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end PollCategory Ban method



    // Start List of Recycle PollCategory method
    public function ListOfRecyclePollCategory(Request $request){
        if($request->ajax()){
            $data = PollCategory::query()->onlyTrashed();
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><span'.
                            'class="fw-medium">'.Str::of($row->name)->apa().'</span></div>'.
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
                '<li><a href="'.route("edit.poll.category",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
        return view('backend.pages.poll_category.recycle_poll_category');
    }
    // end List of Recycle PollCategory method


    // Start PollCategory Restore method
    public function RestorePollCategory(Request $request){
        PollCategory::onlyTrashed()->findOrFail($request->id)->restore();
        $notify = [
            'message' => 'PollCategory Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end PollCategory Restore method

    // Start PollCategory Delete method
    public function DeletePollCategory(Request $request){

        $data = PollCategory::where('id',$request->id)->withTrashed()->first();

        if ($data) {
            if(file_exists($data->image)){
                unlink($data->image);
            }
            $data->forceDelete();

            $notify = [
                'message' => 'PollCategory Deleted Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notify = [
                'message' => 'PollCategory not found',
                'alert-type' => 'error',
            ];
        }

        return response()->json($notify);
    }
    // End PollCategory Delete method


        // Start PollCategory Change Status method
        public function PollCategoryStatus($id){
            $data = PollCategory::findOrFail($id);
            if($data->status == 'active'){
                $data->update([
                    'status' => 'inactive',
                ]);
                $notify = [
                    'message' => 'PollCategory Status is Inactive Now',
                    'alert-type' => 'success',
                ];
            }else{
                $data->update([
                    'status' => 'active',
                ]);
                $notify = [
                    'message' => 'PollCategory Status is Active Now',
                    'alert-type' => 'success',
                ];
            }

            return response()->json(['status'=>$data->status,'notify'=>$notify]);
        }
        // end PollCategory Change Status method

    // Start Delete Multiple PollCategory method
    public function DeleteMultiplePollCategory(Request $request){

        $ids = $request->ids;
        $datas = PollCategory::whereIn('id',$ids)->withTrashed()->get();
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
                    'message' => 'PollCategory Deleted Successfully',
                    'alert-type' => 'success',
                ];
            } else {
                $notify = [
                    'message' => 'PollCategory not found',
                    'alert-type' => 'error',
                ];
            }
        }
        return response()->json($notify);

    }
    // end Delete Multiple PollCategory method

    // Start Multiple PollCategory Ban method
    public function BanMultiplePollCategory(Request $request){
        $ids = $request->ids;
        $datas = PollCategory::whereIn('id',$ids)->withTrashed()->get();
        foreach($datas as $data){
            $data->delete();
        }
        $notify = [
            'message' => 'PollCategory Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Multiple PollCategory Ban method

    // Start Multiple PollCategory Ban method
    public function RestoreMultiplePollCategory(Request $request){
        $ids = $request->ids;
        $datas = PollCategory::onlyTrashed()->whereIn('id',$ids)->get();
        foreach($datas as $data){
            $data->restore();
        }
        $notify = [
            'message' => 'PollCategory Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Multiple PollCategory Ban method
}
