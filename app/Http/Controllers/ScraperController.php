<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\vaccination;
use Illuminate\Support\Facades\Log;
// use GuzzleHttp\Client;
// use Symfony\Component\DomCrawler\Crawler;
class ScraperController extends Controller
{

	public function scrape(){

		$url = 'https://github.com/owid/covid-19-data/tree/master/public/data/vaccinations/country_data';
		$client  = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);
        $links = $crawler->filter('.Details-content--hidden-not-important div.position-relative a.js-navigation-open')->each(function ($node) {
            $href  = 'https://github.com' . $node->attr('href');
            $title = $node->attr('title');
            $text  = $node->text();
            return compact('href', 'title', 'text');
        });
    $array[] = '';  
        foreach ($links as $key => $value) {
            Log::info($value['href']);

            $crawler = $client->request('GET', $value['href']);  

            $data = $crawler->filter('table tbody tr:last-child')->each(function ($node) {

                $location = "";
                $date = "";
                $vaccine = "";
                $total_vaccinations = "";
                $location = $node->filter('td:nth-child(2)')->each(function($node){
                    return $node->text();
                });
                
                $date = $node->filter('td:nth-child(3)')->each(function($node){
                   return $node->text();
                });
                $vaccine = $node->filter('td:nth-child(4)')->each(function($node){
                    return $node->text();
                });
                $total_vaccinations = $node->filter('td:nth-child(6)')->each(function($node){
                    return $node->text();
                });     
              
                $location = $location[0];
                $date = $date[0];
                $vaccine = $vaccine[0];
                $total_vaccinations = $total_vaccinations[0];  
                $row = vaccination::where('location',$location)->first();
                if(!empty($row)){
                    $vaccine_data = $row;
                    $vaccine_data->location = $location; 
                    $vaccine_data->date = $date; 
                    $vaccine_data->vaccine = $vaccine;
                    $vaccine_data->total_vaccinations = $total_vaccinations;
                    $vaccine_data->save();
                }else{
                    $vaccine_data = new vaccination();
                    $vaccine_data->location = $location; 
                    $vaccine_data->date = $date; 
                    $vaccine_data->vaccine = $vaccine;
                    $vaccine_data->total_vaccinations = $total_vaccinations;
                    $vaccine_data->save();
                }                                        
        //    return compact('location', 'date', 'vaccine', 'total_vaccinations');
            }); 
        //    array_push($array,$data);
        }
        var_dump($array);
        die();
        // foreach ($array as $key => $value) {
        // var_dump($value);
        // die();
        // }
	}

}
