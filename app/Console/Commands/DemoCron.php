<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;
use App\Models\vaccination;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $url = 'https://github.com/owid/covid-19-data/tree/master/public/data/vaccinations/country_data';
        $client  = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', $url);
        $links = $crawler->filter('.Details-content--hidden-not-important div.position-relative a')->each(function ($node) {
            $href  = 'https://github.com' . $node->attr('href');
            $title = $node->attr('title');
            $text  = $node->text();
            return compact('href', 'title', 'text');
        });
    $array[] = '';     
        foreach ($links as $key => $value) {

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
                $total_vaccinations = $node->filter('td:nth-child(5)')->each(function($node){
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
            return compact('location', 'date', 'vaccine', 'total_vaccinations');
            }); 
            array_push($array,$data);
        }
         \Log::info("Cron is working fine!");
    }
}
