<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\SponsorRequest;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class SponsorController extends Controller
{

    // Start List of Sponsor method
    public function ListOfSponsors(){
        $sponsors = Sponsor::all();
        return view('backend.pages.sponsor.list_of_sponsors',compact('sponsors'));
    // end List of Sponsor method
    }

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
            $image->resize( 150, 150);
            $image->toJpeg(50)->save(base_path('public/Backend/assets/images/sponsors/'.$name_gen));
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
            $image->resize( 150, 150);
            $image->toJpeg(50)->save(base_path('public/Backend/assets/images/sponsors/'.$name_gen));
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
    public function ListOfRecycleSponsor(){
        $sponsors = Sponsor::onlyTrashed()->get();
        return view('backend.pages.sponsor.recycle_sponsor',compact('sponsors'));
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
}
