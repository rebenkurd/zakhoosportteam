<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\StorePollRequest;
use App\Http\Requests\Backend\UpdatePollRequest;
use App\Models\Player;
use App\Models\Poll;
use App\Models\PollCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
class PollController extends Controller
{

    // Start List of Poll method
    public function ListOfPoll(Request $request)
    {
        if($request->ajax()){
            $data = Cache::rememberForever('polls', function () {
                return Poll::with('category','user')->get();
            });
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            return Str::of($row->category->name)->apa();
            })->
            addColumn('action',function($row){
                $btn ='<button type="button"'.
                'class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"'.
                'data-bs-toggle="dropdown" aria-expanded="false">'.
                '<i class="ti ti-dots"></i>'.
            '</button>'.
            '<ul class="dropdown-menu dropdown-menu-end">'.
                '<li><a href="'.route("poll.options",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Options</a></li>'.
                '<li><a href="'.route("edit.poll",[$row]).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item ban-btn" data-id="'.$row->id.'"><i class="ti ti-ban"></i> Ban</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item delete-btn" data-id="'.$row->id.'"><i class="ti ti-trash"></i> Delete</a></li>'.
            '</ul>'
                ;

                return $btn;
            },)->
            addColumn('statusBtn',function($row){
                if($row->status == 'started'){
                    $statusBtn = '<span class="badge bg-label-success">Started</span>';
                }elseif($row->status == 'pending'){
                    $statusBtn = '<span class="badge bg-label-warning">Pending</span>';
                }else{
                    $statusBtn = '<span class="badge bg-label-danger">Finished</span>';
                }
                return $statusBtn;
            })->
            addColumn('displayBtn',function($row){
                if($row->display == 'show'){
                    $statusBtn = '<a href="javascript:void(0);" class="display-toggle" data-id="'.$row->id.'" data-display="show"><span class="badge bg-label-success">Show</span></a>';
                }else{
                    $statusBtn = '<a href="javascript:void(0);" class="display-toggle" data-id="'.$row->id.'" data-display="hide"><span class="badge bg-label-warning">Hide</span></a>';
                }
                return $statusBtn;
            })->
            addColumn('creator',function($row){
                return $row->user->name;
            })->
            rawColumns(['image','action','creator','statusBtn','displayBtn'])->
            make(true);
        }
        return view('backend.pages.poll.list_of_polls');
    }
    // End List of Poll method



    // Start Add Poll method
    public function AddPoll()
    {
        $categories =PollCategory::all();
        $players =Player::all();
        return view('backend.pages.poll.add_poll',compact('categories','players'));
    }
    // End Add Poll method

    // Start Store Poll method
    public function StorePoll(StorePollRequest $request)
    {
        $poll = auth()->user()->polls()->create($request->safe()->except('options'));

        $poll->options()->createMany($request->options);

        return redirect()->route('list.poll');

        // dd($request->all());

    }
    // End Store Poll method

    // Start Edit Poll method
    public function EditPoll(Poll $poll)
    {
        abort_if(auth()->user()->isNot($poll->user), 403);
        abort_if($poll->status != 'pending', 404);

        $players = Player::all();
        $poll = $poll->load('options');
        $categories = PollCategory::all();
        return view('backend.pages.poll.edit_poll', compact('poll','players','categories'));
    }
    // End Edit Poll method

    // Start Update Poll method
    public function UpdatePoll(UpdatePollRequest $request, Poll $poll)
    {
        $data = $request->safe()->except('options');
        $poll->update($data);
        $poll->options()->delete();
        $poll->options()->createMany($request->options);
        return redirect()->route('list.poll');
    }
    // End Update Poll method


    // Start Update Game Statuses method
    public static function updateGameStatuses()
    {
        Poll::query()
            ->where('status', 'pending')
            ->where('start_at', '<=', now())
            ->update(['status' => 'started']);


        Poll::query()
            ->where('status', 'started')
            ->where('end_at', '<=', now())
            ->update(['status' => 'finished']);
    }
    // End Update Game Statuses method

    // Start Ban Poll method
    public function BanPoll(Request $request)
    {
        $poll = Poll::findOrFail($request->id);
        if ($poll->status != 'pending' ) {
            abort(404,'No Pending poll');
        }
        if ($poll->status != 'finished' ) {
            abort(404,'No Finished poll');
        }

        $poll->options()->delete();

        $poll->delete();

        $notify = [
            'message' => 'Player Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // End Band Poll method


    // Start List of Recycle Poll method
    public function ListOfRecyclePoll(Request $request){
        if($request->ajax()){
            $data = Cache::rememberForever('trashed_polls', function () {
                return Poll::with('category','user')->onlyTrashed()->get();
            });
            return DataTables::of($data)->addIndexColumn()->
            addColumn('image',function($row){
            return Str::of($row->category->name)->apa();
            })->
            addColumn('action',function($row){
                $btn ='<button type="button"'.
                'class="btn text-primary btn-icon rounded-2 dropdown-toggle hide-arrow"'.
                'data-bs-toggle="dropdown" aria-expanded="false">'.
                '<i class="ti ti-dots"></i>'.
            '</button>'.
            '<ul class="dropdown-menu dropdown-menu-end">'.
                '<li><a href="'.route("poll.options",$row->id).'"class="dropdown-item"><i class="ti ti-user"></i> Options</a></li>'.
                '<li><a href="'.route("edit.poll",[$row]).'" class="dropdown-item"><i class="ti ti-edit"></i> Edit</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item restore-btn" data-id="'.$row->id.'"><i class="ti ti-restore"></i> Restore</a></li>'.
                '<li><a href="javascript:void(0);" class="dropdown-item delete-btn" data-id="'.$row->id.'"><i class="ti ti-trash"></i> Delete</a></li>'.
            '</ul>'
                ;

                return $btn;
            },)->
            addColumn('statusBtn',function($row){
                if($row->status == 'started'){
                    $statusBtn = '<span class="badge bg-label-success">Started</span>';
                }elseif($row->status == 'pending'){
                    $statusBtn = '<span class="badge bg-label-warning">Pending</span>';
                }else{
                    $statusBtn = '<span class="badge bg-label-danger">Finished</span>';
                }
                return $statusBtn;
            })->
            addColumn('displayBtn',function($row){
                if($row->display == 'show'){
                    $statusBtn = '<a href="javascript:void(0);" class="display-toggle" data-id="'.$row->id.'" data-display="show"><span class="badge bg-label-success">Show</span></a>';
                }else{
                    $statusBtn = '<a href="javascript:void(0);" class="display-toggle" data-id="'.$row->id.'" data-display="hide"><span class="badge bg-label-warning">Hide</span></a>';
                }
                return $statusBtn;
            })->
            addColumn('creator',function($row){
                return $row->user->name;
            })->
            rawColumns(['image','action','creator','statusBtn','displayBtn'])->
            make(true);
        }
        return view('backend.pages.poll.recycle_poll');
    }
    // end List of Recycle Poll method


    // Start Poll Restore method
    public function RestorePoll(Request $request){
        $poll=Poll::onlyTrashed()->findOrFail($request->id);
        $poll->options()->restore();
        $poll->restore();
        $notify = [
            'message' => 'Poll Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Poll Restore method

    // Start Poll Delete method
    public function DeletePoll(Request $request){

        $data = Poll::where('id',$request->id)->withTrashed()->first();

        if ($data) {
            $data->options()->forceDelete();
            $data->forceDelete();
            $notify = [
                'message' => 'Poll Deleted Successfully',
                'alert-type' => 'success',
            ];
        } else {
            $notify = [
                'message' => 'Poll not found',
                'alert-type' => 'error',
            ];
        }

        return response()->json($notify);
    }
    // End Poll Delete method

    // Start poll Options method
    public function PollOptions(Request $request)
    {
        $poll = Poll::findOrFail($request->id);
        $data = $poll->load('options');
        return view('backend.pages.poll.poll_options',compact('data'));
    }
    // End poll Options method


    // Start Poll Display method
    public function PollDisplay($id){
        $data = Poll::findOrFail($id);
        if($data->display == 'show'){
            $data->update([
                'display' => 'hide',
            ]);
            $notify = [
                'message' => 'Poll is Hided Now',
                'alert-type' => 'success',
            ];
        }else{
            $data->update([
                'display' => 'show',
            ]);
            $notify = [
                'message' => 'Poll is Showed Now',
                'alert-type' => 'success',
            ];
        }

        return response()->json(['display'=>$data->display,'notify'=>$notify]);
    }
    // end Poll Display method

            // Start Delete Multiple Poll method
    public function DeleteMultiplePoll(Request $request){

        $ids = $request->ids;
        $datas = Poll::whereIn('id',$ids)->withTrashed()->get();
        foreach($datas as $data){
            if ($data) {
                $data->options()->forceDelete();
                $data->forceDelete();
                $notify = [
                    'message' => 'Poll Deleted Successfully',
                    'alert-type' => 'success',
                ];
            } else {
                $notify = [
                    'message' => 'Poll not found',
                    'alert-type' => 'error',
                ];
            }
        }
        return response()->json($notify);

    }
    // end Delete Multiple Poll method

    // Start Multiple Poll Ban method
    public function BanMultiplePoll(Request $request){
        $ids = $request->ids;
        $datas = Poll::whereIn('id',$ids)->withTrashed()->get();
        foreach($datas as $data){
            if ($data->status != 'finished' && $data->status != 'pending' ) {
                abort(404,'No Finished or Pending poll');
            }

            $data->options()->delete();

            $data->delete();

        }
        $notify = [
            'message' => 'Poll Baned Successfully',
            'alert-type' => 'error',
        ];
        return response()->json($notify);
    }
    // end Multiple Poll Ban method

    // Start Multiple Poll Ban method
    public function RestoreMultiplePoll(Request $request){
        $ids = $request->ids;
        $datas = Poll::onlyTrashed()->whereIn('id',$ids)->get();
        foreach($datas as $data){
            $data->options()->restore();
            $data->restore();
        }
        $notify = [
            'message' => 'Poll Restored Successfully',
            'alert-type' => 'success',
        ];
        return response()->json($notify);
    }
    // end Multiple Poll Ban method
}
