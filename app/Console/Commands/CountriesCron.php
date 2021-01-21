<?php

namespace App\Console\Commands;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Console\Command;
use App\Models\countries;
class CountriesCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:countries';
    protected $api_key, $env_code, $api_url;
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
        $this->api_key = (env('SOFTNIO_API', '')) ? env('SOFTNIO_API', '') : 'NIODUMMYLOAD';
        $this->env_code = env('ENVATO_CODE', '');
        $this->api_url = 'https://covid.softnio.com/api';        
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $api_data = false;
        $endpoint   = 'countries/full';

        try {
            $client     = new Client();

            $response   = $client->request('GET', $this->url_api($endpoint), [ 'query' => ['uri' => $this->uri_app(true), 'code' => $this->env_code, 'endpoint' => $endpoint], 'http_errors' => false, 'idn_conversion' => false, 'headers' => ['nio-apikey' => $this->api_key] ]);
            $status     = $response->getStatusCode();

            if($status == 200) {
                $api_data = json_decode($response->getBody(), true);
                foreach ($api_data as $key => $value) {
                    $country_data = new countries();
                    $country_data->code = $value['country']['code']; 
                    $country_data->name = $value['country']['name']; 
                    $country_data->cases = $value['cases'];
                    $country_data->death = $value['death'];
                    $country_data->recovered = $value['recovered']; 
                    $country_data->today_cases = $value['today']['cases']; 
                    $country_data->today_death = $value['today']['death'];
                    $country_data->today_recovered = $value['today']['recovered'];   
                    $country_data->active = $value['active']; 
                    $country_data->mild = $value['mild']; 
                    $country_data->critical = $value['critical'];
                    $country_data->update = $value['update'];                                      
                    $country_data->save();                    
                    
                }
                
            } else {
                $api_data = false;
            }

        } catch (Exception $e) { }
    }

    private function url_api($ext='')
    {
        if($ext) {
            return $this->api_url.'/'.$ext;
        }
        return $this->api_url;
    }

    public function uri_app($enc=false)
    {
        $host = str_replace('www.', '', request()->getHost());
        $path = str_replace('/index.php', '', request()->getScriptName());
        if($path == "") { $path = "/"; }
        return ($enc===true) ? base64_encode($host.$path) : $host.$path;
    }    
}
