<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SponsorRequest;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class SponsorController extends Controller
{

    // Start List of Sponsor method
    public function ListOfSponsors(Request $request){
        if($request->ajax()){
            $data = Sponsor::query();
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->logo)? asset($row->logo) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.$row->link.'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->title)->apa().'</span></a></div>'.
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
                '<li><a href="'.route("edit.sponsor",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
        return view('backend.pages.sponsor.list_of_sponsors');
    }
    // end List of Sponsor method

    // Start Add Sponsor method
    public function AddSponsor(){
        return view('backend.pages.sponsor.add_sponsor');
    }
    // end Add Sponsor method

    // Start Store sponsor method
    public function StoreSponsor(SponsorRequest $request){

        if($request->file('logo')){
            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->logo->getClientOriginalExtension();
            $image = $manager->read($request->file('logo'));
            $image->resize( 100, 100);
            $image->toPng()->save(base_path('public/Backend/assets/images/sponsors/'.$name_gen));
            $image_path = 'Backend/assets/images/sponsors/'.$name_gen;

            Sponsor::create([
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
                'status' => $request->status,
                'logo' => $image_path,
                'type' => $request->type,
                'created_at' => now(),
            ]);
            $notify = [
                'message' => 'Sponsor Added Successfully',
                'alert-type' => 'success',
            ];
        return redirect()->route('list.sponsor')->with($notify);

        }else{

        $notify = [
            'message' => 'Plesae Select an Logo Image',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notify);

        }

    }
    // end Store sponsor method


    // Start sponsor Edit method
    public function EditSponsor($id){
        $sponsor = Sponsor::findOrFail($id);
        return view('backend.pages.sponsor.edit_sponsor',compact('sponsor'));

    }
    // end sponsor Edit method

    // Start sponsor Update method
    public function UpdateSponsor(Request $request){

        $sponsor=Sponsor::findOrFail($request->id);
        if($request->file('logo')){

            if(file_exists($sponsor->logo)){
                unlink($sponsor->logo);
            }

            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->logo->getClientOriginalExtension();
            $image = $manager->read($request->file('logo'));
            $image->resize( 100, 100);
            $image->toPng()->save(base_path('public/Backend/assets/images/sponsors/'.$name_gen));
            $image_path = 'Backend/assets/images/sponsors/'.$name_gen;

            $sponsor->update([
                'title' => $request->title,
                'link' => $request->link,
                'description' => $request->description,
                'status' => $request->status,
                'logo' => $image_path,
                'type' => $request->type,
            'updated_at' => now(),
            ]);
            }else{
                $sponsor->update([
                    'title' => $request->title,
                    'link' => $request->link,
                    'description' => $request->description,
                    'status' => $request->status,
                    'type' => $request->type,
                    'updated_at' => now(),
                ]);
            }

            $notify = [
                'message' => 'Sponsor Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('list.sponsor')->with($notify);

    }
    // end sponsor Update method


      // Start Sponsor Ban method
      public function BanSponsor(Request $request){
        Sponsor::findOrFail($request->id)->delete();
        $notify = [
            'message' => 'Sponsor Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Sponsor Ban method


    // Start List of Recycle Sponsor method
    public function ListOfRecycleSponsor( Request $request){
        if($request->ajax()){
            $data = Sponsor::query()->onlyTrashed();
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->logo)? asset($row->logo) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><a href="'.$row->link.'"'.
                        'class="text-body text-truncate"><span'.
                            'class="fw-medium">'.Str::of($row->title)->apa().'</span></a></div>'.
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
                '<li><a href="'.route("edit.sponsor",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
        return view('backend.pages.sponsor.recycle_sponsor');
    }
    // end List of Recycle Sponsor method


    // Start Sponsor Restore method
    public function RestoreSponsor(Request $request){
        Sponsor::onlyTrashed()->findOrFail($request->id)->restore();
        $notify = [
            'message' => 'Sponsor Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Sponsor Restore method

    // Start Sponsor Delete method
    public function DeleteSponsor(Request $request){

        $sponsor = Sponsor::where('id',$request->id)->withTrashed()->first();

        if ($sponsor) {
            if(file_exists($sponsor->logo)){
                unlink($sponsor->logo);
            }
            $sponsor->forceDelete();

            $notify = [
                'message' => 'Sponsor Deleted Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notify = [
                'message' => 'Sponsor not found',
                'alert-type' => 'error',
            ];
        }

        return response()->json($notify);
    }
    // End sponsor Delete method


    // Start sponsor Change Status method
    public function SponsorStatus($id){
        $sponsor = Sponsor::findOrFail($id);
        if($sponsor->status == 'active'){
            $sponsor->update([
                'status' => 'inactive',
            ]);
            $notify = [
                'message' => 'Sponsor Status is Inactive Now',
                'alert-type' => 'success',
            ];
        }else{
            $sponsor->update([
                'status' => 'active',
            ]);
            $notify = [
                'message' => 'Sponsor Status is Active Now',
                'alert-type' => 'success',
            ];
        }

        return response()->json(['status'=>$sponsor->status,'notify'=>$notify]);
    }
    // end sponsor Change Status method


        // Start Delete Multiple Sponsor method
        public function DeleteMultipleSponsor(Request $request){

            $ids = $request->ids;
            $datas = Sponsor::whereIn('id',$ids)->withTrashed()->get();
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
                        'message' => 'Sponsor Deleted Successfully',
                        'alert-type' => 'success',
                    ];
                } else {
                    $notify = [
                        'message' => 'Sponsor not found',
                        'alert-type' => 'error',
                    ];
                }
            }
            return response()->json($notify);

        }
        // end Delete Multiple Sponsor method

        // Start Multiple Sponsor Ban method
        public function BanMultipleSponsor(Request $request){
            $ids = $request->ids;
            $datas = Sponsor::whereIn('id',$ids)->withTrashed()->get();
            foreach($datas as $data){
                $data->delete();
            }
            $notify = [
                'message' => 'Sponsor Baned Successfully',
                'alert-type' => 'error',
            ];
            return response()->json($notify);
        }
        // end Multiple Sponsor Ban method

        // Start Multiple Sponsor Ban method
        public function RestoreMultipleSponsor(Request $request){
            $ids = $request->ids;
            $datas = Sponsor::onlyTrashed()->whereIn('id',$ids)->get();
            foreach($datas as $data){
                $data->restore();
            }
            $notify = [
                'message' => 'Sponsor Restored Successfully',
                'alert-type' => 'success',
            ];
            return response()->json($notify);
        }
        // end Multiple Sponsor Ban method
}
