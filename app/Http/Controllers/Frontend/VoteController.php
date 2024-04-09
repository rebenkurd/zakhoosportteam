<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\Team;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // Start Vote Best Player Page Method
    public function VoteBestPlayerPage(Poll $poll)
    {
        $poll = $poll->load('options');
        $selectedOption = $poll->votes()->where('user_id', auth()->id())->first()?->option_id;
        if ($poll->user->is(auth()->user())) {
            return view('frontend.pages.poll.poll_player', compact('poll' ,'selectedOption'));
        }
        return view('frontend.pages.poll.poll_player',compact('poll', 'selectedOption'));
    }
    // End Vote Best Player Page Method


    public function StoreVote(request $request, Poll $poll)
   {

        abort_if($poll->status != 'started',404);
        $existingVote = $poll->votes()->where('user_id', auth()->id())->first();
        if ($existingVote) {
            $selectedOption = $existingVote->option;
        } else {
            $selectedOption = null;
        }
        $poll->votes()->updateOrCreate(['user_id'=>auth()->id()],['option_id'=>$request->option_id]);


        $newOption =  PollOption::find($request->option_id);
        $newOption->increment('votes_count');

        if ($selectedOption) {
            $selectedOption->decrement('votes_count');
        }

        $selectedOption = $newOption;
        $notify = [
            'message' => 'Voted Successfully',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notify);
    }


    // Start Vote Best goal Page Method
    public function VoteBestGoalPage(Poll $poll)
    {
        $poll = $poll->load('options');
        $selectedOption = $poll->votes()->where('user_id', auth()->id())->first()?->option_id;
        if ($poll->user->is(auth()->user())) {
            return view('frontend.pages.poll.poll_goal', compact('poll' ,'selectedOption'));
        }
        return view('frontend.pages.poll.poll_goal',compact('poll', 'selectedOption'));
    }
    // End Vote Best goal Page Method


}
