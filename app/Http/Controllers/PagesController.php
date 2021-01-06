<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CovidDataController;

class PagesController extends Controller
{
	// Symptoms page
	public function symptoms(Request $request)
    {
        $CovidData = new CovidDataController();

        $last_update = $CovidData->last_update('M d, Y, H:i e');

        return view('symptoms', compact('last_update'));
    }

    // Prevention page
	public function prevention(Request $request)
    {
        $CovidData = new CovidDataController();

        $last_update = $CovidData->last_update('M d, Y, H:i e');

        return view('prevention', compact('last_update'));
    }

    // Faqs page
	public function faqs(Request $request)
    {
        $CovidData = new CovidDataController();;

        $last_update = $CovidData->last_update('M d, Y, H:i e');

        return view('faqs', compact('last_update'));
    }
}