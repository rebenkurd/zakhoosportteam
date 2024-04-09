<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Poll;
use App\Models\Reklam;
use App\Models\Sponsor;
use App\Models\Team;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //Start Home Page Method
    public function HomePage()
    {
        $polls = Poll::with('category')->where('display', 'show')->get();
        $reklams = Reklam::where('status','active')->get();
        $sponsors = Sponsor::where('status','active')->get();
        $news = News::where('status','active')->limit(14)->get();
        $breaknews = News::where('status','active')->limit(5)->latest()->get();
        return view('frontend.pages.home', compact('polls','reklams','sponsors','news','breaknews'));
    }
    //End Home Page Method

}
