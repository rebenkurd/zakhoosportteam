<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FixtureController extends Controller
{
    public function allFixtures()
    {
        $response = Http::withOptions([
            'verify' => false, // Disable SSL certificate verification
        ])->get('https://livescore-api.com/api-client/fixtures/matches.json?&key=zdvX6RifZasYXJ7h&secret=wRAy3YVJnYP9hcKQqfNw76L7ge5eXdwu');

        $fixtures = $response->json();

        // dd($fixtures);
        // return $fixtures;
        return view('backend.pages.fixture.fixture_all', compact('fixtures'));
    }
}


