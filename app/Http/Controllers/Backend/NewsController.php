<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\NewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class NewsController extends Controller
{

    // Start List of News method
    public function ListOfNews( Request $request){
        if($request->ajax()){
            $data = Cache::rememberForever('news', function () {
                return News::all();
            });
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><span'.
                            'class="fw-medium">'.Str::substr($row->title_en,0,30).'</span></div>'.
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
                '<li><a href="'.route("detail.news",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Detail</a></li>'.
                '<li><a href="'.route("edit.news",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
            addColumn('creator',function($row){
                return $row->user->name;
            })->
            rawColumns(['image','action','statusBtn','creator'])->
            make(true);
        }
        return view('backend.pages.news.list_of_news');
    }
    // end List of News method

    // Start Add News method
    public function AddNews(){
        return view('backend.pages.news.add_news');
    }
    // end Add News method

    // Start Store News method
    public function StoreNews(NewsRequest $request){

        if($request->file('image')){
            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize( 500, 450);
            $image->toJpeg(80)->save(base_path('public/Backend/assets/images/news/'.$name_gen));
            $image_path = 'Backend/assets/images/news/'.$name_gen;

            News::create([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'title_ckb' => $request->title_ckb,
                'title_ku' => $request->title_ku,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'description_ckb' => $request->description_ckb,
                'description_ku' => $request->description_ku,
                'status' => $request->status,
                'image' => $image_path,
                'user_id' => Auth::user()->id,
                'created_at' => now(),
            ]);
            $notify = [
                'message' => 'News Added Successfully',
                'alert-type' => 'success',
            ];
        return redirect()->route('list.news')->with($notify);

        }else{

        $notify = [
            'message' => 'Please Select an Image',
            'alert-type' => 'error',
        ];
        return redirect()->back()->with($notify);

        }

    }
    // end Store News method


    // Start News Edit method
    public function EditNews($id){
        $news = News::findOrFail($id);
        return view('backend.pages.news.edit_news',compact('news'));

    }
    // end News Edit method

    // Start News Update method
    public function UpdateNews(Request $request){

        $news=News::findOrFail($request->id);
        if($request->file('image')){

            if(file_exists($news->image)){
                unlink($news->image);
            }

            $manager = new ImageManager(new Driver());
            $name_gen=hexdec(uniqid()).'.'.$request->image->getClientOriginalExtension();
            $image = $manager->read($request->file('image'));
            $image->resize( 500, 450);
            $image->toJpeg(50)->save(base_path('public/Backend/assets/images/news/'.$name_gen));
            $image_path = 'Backend/assets/images/news/'.$name_gen;

            $news->update([
                'title_en' => $request->title_en,
                'title_ar' => $request->title_ar,
                'title_ckb' => $request->title_ckb,
                'title_ku' => $request->title_ku,
                'description_en' => $request->description_en,
                'description_ar' => $request->description_ar,
                'description_ckb' => $request->description_ckb,
                'description_ku' => $request->description_ku,
                'status' => $request->status,
                'image' => $image_path,
                'updated_at' => now(),
            ]);
            }else{
                $news->update([
                    'title_en' => $request->title_en,
                    'title_ar' => $request->title_ar,
                    'title_ckb' => $request->title_ckb,
                    'title_ku' => $request->title_ku,
                    'description_en' => $request->description_en,
                    'description_ar' => $request->description_ar,
                    'description_ckb' => $request->description_ckb,
                    'description_ku' => $request->description_ku,
                    'status' => $request->status,
                    'updated_at' => now(),
                ]);
            }

            $notify = [
                'message' => 'News Updated Successfully',
                'alert-type' => 'success',
            ];

            return redirect()->route('list.news')->with($notify);

    }
    // end News Update method


      // Start News Ban method
      public function BanNews(Request $request){
        News::findOrFail($request->id)->delete();
        $notify = [
            'message' => 'News Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end News Ban method


    // Start List of Recycle News method
    public function ListOfRecycleNews( Request $request){
        if($request->ajax()){
            $data = Cache::rememberForever('trashed_news', function () {
                return News::onlyTrashed()->get();
            });
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            $image='<div class="d-flex justify-content-start align-items-center user-name">'.
                '<div class="avatar-wrapper">'.
                    '<div class="avatar me-3"><img src="'. (!empty($row->image)? asset($row->image) : "https://via.placeholder.com/150x150") .'" alt="Avatar"'.
                    'class="rounded-circle"></div>'.
                '</div>'.
                '<div class="d-flex flex-column"><span'.
                            'class="fw-medium">'.Str::substr($row->title_en,0,30).'</span></div>'.
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
                '<li><a href="'.route("detail.news",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Detail</a></li>'.
                '<li><a href="'.route("edit.news",$row->id).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
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
            addColumn('creator',function($row){
                return $row->user->name;
            })->
            rawColumns(['image','action','statusBtn','creator'])->
            make(true);
        }
        return view('backend.pages.news.recycle_news');
    }
    // end List of Recycle News method


    // Start News Restore method
    public function RestoreNews(Request $request){
        News::onlyTrashed()->findOrFail($request->id)->restore();
        $notify = [
            'message' => 'News Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end News Restore method

    public function DeleteNews(Request $request){

        $news = News::where('id',$request->id)->withTrashed()->first();

        if ($news) {
            if(file_exists($news->image)){
                unlink($news->image);
            }
            $news->forceDelete();

            $notify = [
                'message' => 'News Deleted Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notify = [
                'message' => 'News not found',
                'alert-type' => 'error',
            ];
        }

        return response()->json($notify);
    }


    // Start News Change Status method
    public function NewsStatus($id){
        $news = News::findOrFail($id);
        if($news->status == 'active'){
            $news->update([
                'status' => 'inactive',
            ]);
            $notify = [
                'message' => 'News Status is Inactive Now',
                'alert-type' => 'success',
            ];
        }else{
            $news->update([
                'status' => 'active',
            ]);
            $notify = [
                'message' => 'News Status is Active Now',
                'alert-type' => 'success',
            ];
        }

        return response()->json(['status'=>$news->status,'notify'=>$notify]);
    }
    // end News Change Status method}

    // Start News detail method
    public function DetailNews($id){
        $news = News::findOrFail($id);
        return view('backend.pages.news.detail_news',compact('news'));
    }
    // end News detail method}


    // Start Delete Multiple News method
    public function DeleteMultipleNews(Request $request){

        $ids = $request->ids;
        $datas = News::whereIn('id',$ids)->withTrashed()->get();
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
                    'message' => 'News Deleted Successfully',
                    'alert-type' => 'success',
                ];
            } else {
                $notify = [
                    'message' => 'News not found',
                    'alert-type' => 'error',
                ];
            }
        }
        return response()->json($notify);

    }
    // end Delete Multiple News method

    // Start Multiple News Ban method
    public function BanMultipleNews(Request $request){
        $ids = $request->ids;
        $datas = News::whereIn('id',$ids)->withTrashed()->get();
        foreach($datas as $data){
            $data->delete();
        }
        $notify = [
            'message' => 'News Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Multiple News Ban method

    // Start Multiple News Ban method
    public function RestoreMultipleNews(Request $request){
        $ids = $request->ids;
        $datas = News::onlyTrashed()->whereIn('id',$ids)->get();
        foreach($datas as $data){
            $data->restore();
        }
        $notify = [
            'message' => 'News Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Multiple News Ban method



}
