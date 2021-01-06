<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CovidDataController;
use App\Models\vaccination; 

class FrontEndController extends Controller
{
    // Home/Index page
    public function index(Request $request)
    {
        $CovidData = new CovidDataController();
        
        $last_update = $CovidData->last_update('M d, Y, H:i e');

        $world = $CovidData->world();
        
        $countries = $CovidData->countries_data();
        $affected = $CovidData->affected(5);
        $affect_ratio = $CovidData->affected_ratio(7);

        $daily_history = $CovidData->daily_history('world', 60);
        $timeline_history = $CovidData->timeline_history('world', 60);

        $graphs = [
            'map' => $CovidData->graph_map($countries, 'jvmap'),
            'world_daily' => $CovidData->graph_chart($daily_history),
            'world_timeline' => $CovidData->graph_chart($timeline_history)
        ];
        $vaccines = vaccination::orderBy('total_vaccinations','desc')->take(100)->get();
       
        return view('home', compact('world', 'graphs', 'countries', 'affected', 'affect_ratio', 'last_update','vaccines'));
    }



    public function countries(Request $request) 
    {
        $CovidData = new CovidDataController();

        $last_update = $CovidData->last_update('M d, Y, H:i e');

        $countries = $CovidData->countries_data();
        
        $affect_ratio = $CovidData->affected_ratio(7);

        $daily_history = $CovidData->daily_history('world', 60);
        $timeline_history = $CovidData->timeline_history('world', 60);

        $graphs = [
            'map' => $CovidData->graph_map($countries, 'jvmap'),
            'world_daily' => $CovidData->graph_chart($daily_history),
            'world_timeline' => $CovidData->graph_chart($timeline_history)
        ];

        return view('countries', compact('countries', 'graphs', 'affect_ratio', 'last_update'));
    }



    public function country_details(Request $request, $code='')
    {
        $ajax = $country = $graphs = []; $last_update = '';

        if(empty($code)) {
            $code = (isset($request->code)) ? $request->code : false;
        }

        $CovidData = new CovidDataController(); 
        $last_update = $CovidData->last_update('M d, Y, H:i e');

        if(!empty($code)) {
            $country = $CovidData->countries_data($code);
            $daily_history = $CovidData->daily_history($code, 60);
            $timeline_history = $CovidData->timeline_history($code, 60);

            $graphs = [
                'daily' => $CovidData->graph_chart($daily_history),
                'timeline' => $CovidData->graph_chart($timeline_history)
            ];


            $ajax['modal'] = view('country-modal', compact('country', 'graphs'))->render();
        }

        if($request->ajax()){
            return response()->json((empty($ajax) ? [] : $ajax));
        }
        return view('country', compact('country', 'graphs', 'last_update'));
    }

}