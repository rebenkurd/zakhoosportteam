<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayerStaffController extends Controller
{
    public function PlayerStaffPage()
    {
        return view('frontend.pages.player_staff.player_staff_page');
    }
}
