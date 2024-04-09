<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Team;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function NewsPage()
    {
        $news = News::where('status','active')->get();
        return view('frontend.pages.news.news_page',compact('news','team'));
    }
}
