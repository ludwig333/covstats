<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CovidDataController extends Controller
{

	protected $api_key, $env_code, $api_url;

	public function __construct()
    {
        $this->api_key = (env('SOFTNIO_API', '')) ? env('SOFTNIO_API', '') : 'NIODUMMYLOAD';
        $this->env_code = env('ENVATO_CODE', '');
        $this->api_url = 'https://covid.softnio.com/api';

    }

	public function world()
	{
		$data = $this->countries_data('world');

		return $data;
	}

	public function last_update($format='')
	{
		$data = $this->countries_data('world');
		if(!empty($format)) {
			$updated = isset($data['update']) ? date($format, $data['update']) : '';
		} else {
			$updated = isset($data['update']) ? $data['update'] : '';
		}
		return $updated;
	}

	public function affected($limit=5)
	{
		$data = $this->countries_data('', 'cases', false);

		$affected = array_slice($data, 0, $limit);

		return $affected;
	}

	public function affected_ratio($limit=7)
	{
		$data = $this->countries_data('', 'cases', false);
		$total = $this->world();

		$count = 0;
		$colors = ['#0064ec', '#0971fe', '#3a8dfe', '#6baafe', '#6baafe', '#a9cdff', '#e1eeff'];
		$ratio = [];
		foreach ($data as $code => $country) {
			$count++;
			$ratio[] = [
				'name' => $country['country']['name'],
				'percent' => round( (($country['cases'] * 100) / $total['cases']), 2),
				'color' => isset($colors[$count-1]) ? $colors[$count-1] : '#e1eeff',
				'cases' => number_format($country['cases']),
			];

			if($count == $limit) break;
		}

		return $ratio;
	}


	public function graph_map($all_data, $format='jvmap')
    {
        if($all_data) {
            $items = [];
            foreach ($all_data as $code => $data) {
                if($format=='jvmap') {
                    if($data['cases'] && $code!=='world') {
                        $items[] = '"'.$code.'": "'.$data['cases'].'"';
                    }
                }
            }
            $map_data = implode(",", $items);
            return '{'.$map_data.'}'; 
        }
        return '{}';
    }



    public function graph_chart($all_data, $format='chartjs')
    {
        $history = isset($all_data['history']) ? $all_data['history'] :  false;
        $data = ['labels' => '', 'data' => []];

        if ($history) {
            $collection = collect($history);
            if($format=='chartjs') {
                $labels = $set_cases = $set_death = $set_recover = []; 
                $day_first = $day_last = ''; $count = 0; $total = count($history);

                foreach ($collection as $day) {
                    $count++;

                    $set_cases[] = $day['cases'];
                    $set_death[] = $day['deaths'];
                    $set_recover[] = $day['recovered'];
                    $labels[] = '"'.date('d M', strtotime($day['date'])).'"';

                    if($count==1) $day_first = date('d M, Y', strtotime($day['date']));
                    if($count==$total) $day_last = date('d M, Y', strtotime($day['date']));
                }
                $data['first'] = $day_first;
                $data['last'] = $day_last;
                $data['labels'] = implode(",", $labels);
                $data['data']['cases'] = implode(",", $set_cases);
                $data['data']['deaths'] = implode(",", $set_death);
                $data['data']['recovered'] = implode(",", $set_recover);
                $data['max']['cases'] = $collection->max('cases');
                $data['max']['deaths'] = $collection->max('deaths');
                $data['max']['recovered'] = $collection->max('recovered');
                $data['avg']['cases'] = (int)$collection->avg('cases');
                $data['avg']['deaths'] = (int)$collection->avg('deaths');
                $data['avg']['recovered'] = (int)$collection->avg('recovered');
            }
        }

        return (object) $data;
    } 


	public function history($code='', $days=30, $type='timeline')
	{
		$data = ($type=='timeline') ? $this->timeline_data($code, $days) : $this->daily_data($code, $days);

		return (!empty($data)) ? $data : [];
	}

	public function daily_history($code, $days=30)
	{
		if(!empty($code)) {
			return $this->history($code, $days, 'daily');
		}
		return [];
	}

	public function timeline_history($code, $days=30)
	{
		if(!empty($code)) {
			return $this->history($code, $days, 'timeline');
		}
		return [];
	}



	public function countries_data($code='', $ordered='cases', $world=true)
	{

		$code = strtolower($code);
		$data = cache()->remember('covid_countries', 900, function(){
            return $this->get_live_data('country');
        });
		
		$return = [];

        if(!empty($data)) {
        	$countries = collect($data);
			
			if(!empty($code)) {
				$return = (isset($countries[$code]) && !empty(isset($countries[$code]))) ? $countries[$code] : false;
			} else {
        		$return = $countries->whereNotIn('cases', [0])->sortByDesc($ordered)->all();
        		if($world==false) unset($return['world']);
			}
        }

        return $return;
	}


	public function daily_data($code='', $days=30)
	{
		$code = strtolower($code);
		$data = cache()->remember('covid_daily_history', 21600, function(){
            return $this->get_live_data('daily');
        });

		$return = [];

        if(!empty($data)) {
        	$history = collect($data);

			if(!empty($code)) {
				$daily = (isset($history[$code]) && !empty(isset($history[$code]))) ? $history[$code] : false;

				if($daily && isset($daily['history'])) {
		            $old_history = collect($daily['history']);
		            if(!empty($old_history)) {
						$history_data = $old_history->reverse();
						$history_limit  = $history_data->take($days);
						$new_history = $history_limit->reverse()->all();
		            	$daily['history'] = array_values($new_history);
		            }
		        }
		        $return = $daily;

			} else {
        		$all_history = [];
				foreach ($history as $code => $data) {
					if($data && isset($data['history'])) {
			            $old_history = collect($data['history']);
			            if(!empty($old_history)) {
							$history_data = $old_history->reverse();
							$history_limit  = $history_data->take($days);
							$new_history = $history_limit->reverse()->all();
			            	$data['history'] = array_values($new_history);
			            }
			        }
			        $all_history[$code] = $data;
				}
        		$return = $all_history;
			}

        }
        return $return;
	}


	public function timeline_data($code='', $days=30)
	{
		$code = strtolower($code);
		$data = cache()->remember('covid_timeline_history', 21600, function(){
            return $this->get_live_data('timeline');
        });

		$return = [];

        if(!empty($data)) {
        	$history = collect($data);

			if(!empty($code)) {
				$daily = (isset($history[$code]) && !empty(isset($history[$code]))) ? $history[$code] : false;

				if($daily && isset($daily['history'])) {
		            $old_history = collect($daily['history']);
		            if(!empty($old_history)) {
						$history_data = $old_history->reverse();
						$history_limit  = $history_data->take($days);
						$new_history = $history_limit->reverse()->all();
		            	$daily['history'] = array_values($new_history);
		            }
		        }
		        $return = $daily;

			} else {
				$all_history = [];
				foreach ($history as $code => $data) {
					if($data && isset($data['history'])) {
			            $old_history = collect($data['history']);
			            if(!empty($old_history)) {
							$history_data = $old_history->reverse();
							$history_limit  = $history_data->take($days);
							$new_history = $history_limit->reverse()->all();
			            	$data['history'] = array_values($new_history);
			            }
			        }
			        $all_history[$code] = $data;
				}
        		$return = $all_history;
			}
        }
        return $return;
	}


	// Get Data from API
    public function get_live_data($type='country', $json=true)
    {
    	$api_data = false;
    	$endpoint 	= 'countries/full';
    	$endpoint 	= ($type=='summary') ? 'summary/full' : $endpoint;
    	$endpoint 	= ($type=='daily') ? 'history/daily/all' : $endpoint;
    	$endpoint 	= ($type=='timeline') ? 'history/timeline/all' : $endpoint;

        try {
            $client 	= new Client();

            $response   = $client->request('GET', $this->url_api($endpoint), [ 'query' => ['uri' => $this->uri_app(true), 'code' => $this->env_code, 'endpoint' => $endpoint], 'http_errors' => false, 'idn_conversion' => false, 'headers' => ['nio-apikey' => $this->api_key] ]);
            $status     = $response->getStatusCode();

            if($status == 200) {
            	$api_data = json_decode($response->getBody(), $json);
            } else {
            	$api_data = false;
            }

        } catch (Exception $e) { }

        return $api_data;
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