<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CovidDataController;
use App\Models\vaccination; 
use App\Models\countries;
use Carbon\Carbon;

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
        $vaccines = vaccination::orderBy('total_vaccinations','desc')->get();
        $graphs = [
            'map' => $CovidData->graph_map($countries, 'jvmap'),
            'world_daily' => $CovidData->graph_chart($daily_history),
            'world_timeline' => $CovidData->graph_chart($timeline_history)
        ];

        return view('countries', compact('countries', 'graphs', 'affect_ratio', 'last_update', 'vaccines'));
    }

    public function countries_ajax(Request $request) 
    {
        $CovidData = new CovidDataController();

        $last_update = $CovidData->last_update('M d, Y, H:i e');
        if($request->date == "today"){
        $countries = $CovidData->countries_data();
        $ajax['tbody'] = view('countries-table', compact('countries'))->render();   
       
        }
        else if($request->date == "yesterday"){
        $countries = countries::whereDate('created_at',Carbon::yesterday())->orderBy('cases', 'DESC')->get();
                 \Log::info($countries);
        $ajax['tbody'] = view('countries-table-other', compact('countries'))->render(); 
       
        }
        else if($request->date == "twodaysago"){
        $countries = countries::whereDate('created_at',Carbon::today()->subDays(2))->orderBy('cases', 'DESC')->get();
                 \Log::info($countries);
        $ajax['tbody'] = view('countries-table-other', compact('countries'))->render();        
        }
        else{
        $countries = countries::whereDate('created_at',Carbon::today()->subDays(7))->orderBy('cases', 'DESC')->get();
                 \Log::info($countries);
        $ajax['tbody'] = view('countries-table-other', compact('countries'))->render();        
        }

        return response()->json((empty($ajax) ? [] : $ajax));
    }

    public function country_details(Request $request, $code='', $location='')
    {
            $countrycodes = array (
              'AF' => 'Afghanistan',
              'AX' => 'Åland Islands',
              'AL' => 'Albania',
              'DZ' => 'Algeria',
              'AS' => 'American Samoa',
              'AD' => 'Andorra',
              'AO' => 'Angola',
              'AI' => 'Anguilla',
              'AQ' => 'Antarctica',
              'AG' => 'Antigua and Barbuda',
              'AR' => 'Argentina',
              'AU' => 'Australia',
              'AT' => 'Austria',
              'AZ' => 'Azerbaijan',
              'BS' => 'Bahamas',
              'BH' => 'Bahrain',
              'BD' => 'Bangladesh',
              'BB' => 'Barbados',
              'BY' => 'Belarus',
              'BE' => 'Belgium',
              'BZ' => 'Belize',
              'BJ' => 'Benin',
              'BM' => 'Bermuda',
              'BT' => 'Bhutan',
              'BO' => 'Bolivia',
              'BA' => 'Bosnia and Herzegovina',
              'BW' => 'Botswana',
              'BV' => 'Bouvet Island',
              'BR' => 'Brazil',
              'IO' => 'British Indian Ocean Territory',
              'BN' => 'Brunei Darussalam',
              'BG' => 'Bulgaria',
              'BF' => 'Burkina Faso',
              'BI' => 'Burundi',
              'KH' => 'Cambodia',
              'CM' => 'Cameroon',
              'CA' => 'Canada',
              'CV' => 'Cape Verde',
              'KY' => 'Cayman Islands',
              'CF' => 'Central African Republic',
              'TD' => 'Chad',
              'CL' => 'Chile',
              'CN' => 'China',
              'CX' => 'Christmas Island',
              'CC' => 'Cocos (Keeling) Islands',
              'CO' => 'Colombia',
              'KM' => 'Comoros',
              'CG' => 'Congo',
              'CD' => 'Zaire',
              'CK' => 'Cook Islands',
              'CR' => 'Costa Rica',
              'CI' => 'Côte D\'Ivoire',
              'HR' => 'Croatia',
              'CU' => 'Cuba',
              'CY' => 'Cyprus',
              'CZ' => 'Czech Republic',
              'DK' => 'Denmark',
              'DJ' => 'Djibouti',
              'DM' => 'Dominica',
              'DO' => 'Dominican Republic',
              'EC' => 'Ecuador',
              'EG' => 'Egypt',
              'SV' => 'El Salvador',
              'GQ' => 'Equatorial Guinea',
              'ER' => 'Eritrea',
              'EE' => 'Estonia',
              'ET' => 'Ethiopia',
              'FK' => 'Falkland Islands (Malvinas)',
              'FO' => 'Faroe Islands',
              'FJ' => 'Fiji',
              'FI' => 'Finland',
              'FR' => 'France',
              'GF' => 'French Guiana',
              'PF' => 'French Polynesia',
              'TF' => 'French Southern Territories',
              'GA' => 'Gabon',
              'GM' => 'Gambia',
              'GE' => 'Georgia',
              'DE' => 'Germany',
              'GH' => 'Ghana',
              'GI' => 'Gibraltar',
              'GR' => 'Greece',
              'GL' => 'Greenland',
              'GD' => 'Grenada',
              'GP' => 'Guadeloupe',
              'GU' => 'Guam',
              'GT' => 'Guatemala',
              'GG' => 'Guernsey',
              'GN' => 'Guinea',
              'GW' => 'Guinea-Bissau',
              'GY' => 'Guyana',
              'HT' => 'Haiti',
              'HM' => 'Heard Island and Mcdonald Islands',
              'VA' => 'Vatican City State',
              'HN' => 'Honduras',
              'HK' => 'Hong Kong',
              'HU' => 'Hungary',
              'IS' => 'Iceland',
              'IN' => 'India',
              'ID' => 'Indonesia',
              'IR' => 'Iran, Islamic Republic of',
              'IQ' => 'Iraq',
              'IE' => 'Ireland',
              'IM' => 'Isle of Man',
              'IL' => 'Israel',
              'IT' => 'Italy',
              'JM' => 'Jamaica',
              'JP' => 'Japan',
              'JE' => 'Jersey',
              'JO' => 'Jordan',
              'KZ' => 'Kazakhstan',
              'KE' => 'KENYA',
              'KI' => 'Kiribati',
              'KP' => 'Korea, Democratic People\'s Republic of',
              'KR' => 'Korea, Republic of',
              'KW' => 'Kuwait',
              'KG' => 'Kyrgyzstan',
              'LA' => 'Lao People\'s Democratic Republic',
              'LV' => 'Latvia',
              'LB' => 'Lebanon',
              'LS' => 'Lesotho',
              'LR' => 'Liberia',
              'LY' => 'Libyan Arab Jamahiriya',
              'LI' => 'Liechtenstein',
              'LT' => 'Lithuania',
              'LU' => 'Luxembourg',
              'MO' => 'Macao',
              'MK' => 'Macedonia, the Former Yugoslav Republic of',
              'MG' => 'Madagascar',
              'MW' => 'Malawi',
              'MY' => 'Malaysia',
              'MV' => 'Maldives',
              'ML' => 'Mali',
              'MT' => 'Malta',
              'MH' => 'Marshall Islands',
              'MQ' => 'Martinique',
              'MR' => 'Mauritania',
              'MU' => 'Mauritius',
              'YT' => 'Mayotte',
              'MX' => 'Mexico',
              'FM' => 'Micronesia, Federated States of',
              'MD' => 'Moldova, Republic of',
              'MC' => 'Monaco',
              'MN' => 'Mongolia',
              'ME' => 'Montenegro',
              'MS' => 'Montserrat',
              'MA' => 'Morocco',
              'MZ' => 'Mozambique',
              'MM' => 'Myanmar',
              'NA' => 'Namibia',
              'NR' => 'Nauru',
              'NP' => 'Nepal',
              'NL' => 'Netherlands',
              'AN' => 'Netherlands Antilles',
              'NC' => 'New Caledonia',
              'NZ' => 'New Zealand',
              'NI' => 'Nicaragua',
              'NE' => 'Niger',
              'NG' => 'Nigeria',
              'NU' => 'Niue',
              'NF' => 'Norfolk Island',
              'MP' => 'Northern Mariana Islands',
              'NO' => 'Norway',
              'OM' => 'Oman',
              'PK' => 'Pakistan',
              'PW' => 'Palau',
              'PS' => 'Palestinian Territory, Occupied',
              'PA' => 'Panama',
              'PG' => 'Papua New Guinea',
              'PY' => 'Paraguay',
              'PE' => 'Peru',
              'PH' => 'Philippines',
              'PN' => 'Pitcairn',
              'PL' => 'Poland',
              'PT' => 'Portugal',
              'PR' => 'Puerto Rico',
              'QA' => 'Qatar',
              'RE' => 'Réunion',
              'RO' => 'Romania',
              'RU' => 'Russia',
              'RW' => 'Rwanda',
              'SH' => 'Saint Helena',
              'KN' => 'Saint Kitts and Nevis',
              'LC' => 'Saint Lucia',
              'PM' => 'Saint Pierre and Miquelon',
              'VC' => 'Saint Vincent and the Grenadines',
              'WS' => 'Samoa',
              'SM' => 'San Marino',
              'ST' => 'Sao Tome and Principe',
              'SA' => 'Saudi Arabia',
              'SN' => 'Senegal',
              'RS' => 'Serbia',
              'SC' => 'Seychelles',
              'SL' => 'Sierra Leone',
              'SG' => 'Singapore',
              'SK' => 'Slovakia',
              'SI' => 'Slovenia',
              'SB' => 'Solomon Islands',
              'SO' => 'Somalia',
              'ZA' => 'South Africa',
              'GS' => 'South Georgia and the South Sandwich Islands',
              'ES' => 'Spain',
              'LK' => 'Sri Lanka',
              'SD' => 'Sudan',
              'SR' => 'Suriname',
              'SJ' => 'Svalbard and Jan Mayen',
              'SZ' => 'Swaziland',
              'SE' => 'Sweden',
              'CH' => 'Switzerland',
              'SY' => 'Syrian Arab Republic',
              'TW' => 'Taiwan, Province of China',
              'TJ' => 'Tajikistan',
              'TZ' => 'Tanzania, United Republic of',
              'TH' => 'Thailand',
              'TL' => 'Timor-Leste',
              'TG' => 'Togo',
              'TK' => 'Tokelau',
              'TO' => 'Tonga',
              'TT' => 'Trinidad and Tobago',
              'TN' => 'Tunisia',
              'TR' => 'Turkey',
              'TM' => 'Turkmenistan',
              'TC' => 'Turks and Caicos Islands',
              'TV' => 'Tuvalu',
              'UG' => 'Uganda',
              'UA' => 'Ukraine',
              'AE' => 'United Arab Emirates',
              'GB' => 'United Kingdom',
              'US' => 'United States',
              'UM' => 'United States Minor Outlying Islands',
              'UY' => 'Uruguay',
              'UZ' => 'Uzbekistan',
              'VU' => 'Vanuatu',
              'VE' => 'Venezuela',
              'VN' => 'Viet Nam',
              'VG' => 'Virgin Islands, British',
              'VI' => 'Virgin Islands, U.S.',
              'WF' => 'Wallis and Futuna',
              'EH' => 'Western Sahara',
              'YE' => 'Yemen',
              'ZM' => 'Zambia',
              'ZW' => 'Zimbabwe',
            );
       
        $ajax = $country = $graphs = []; $last_update = '';

        if(empty($code)) {
            $code = (isset($request->code)) ? $request->code : false;
            if($code == false){
                $code = array_search($request->location, $countrycodes);
            }
            
        }

        if(empty($location)) {
            $location = (isset($request->location)) ? $request->location : false;
        }
        $CovidData = new CovidDataController(); 
        $last_update = $CovidData->last_update('M d, Y, H:i e');

        if(!empty($code)) {
        $location = $this->countryCodeToCountry($code);
        $vaccine = vaccination::where('location',$location)->first();
            if(!empty($vaccine)){
            $vaccine = $vaccine->total_vaccinations;
            }
            else{
            $vaccine = ''; 
            }
                }
        else{
            $vaccine = '';    
        }
        if(!empty($code)) {
            $country = $CovidData->countries_data($code);
            $daily_history = $CovidData->daily_history($code, 60);
            $timeline_history = $CovidData->timeline_history($code, 60);

            $graphs = [
                'daily' => $CovidData->graph_chart($daily_history),
                'timeline' => $CovidData->graph_chart($timeline_history)
            ];


            $ajax['modal'] = view('country-modal', compact('country', 'graphs', 'vaccine'))->render();
        }

        if($request->ajax()){
            return response()->json((empty($ajax) ? [] : $ajax));
        }
        return view('country', compact('country', 'graphs', 'last_update', 'vaccine'));
    }

    protected function countryCodeToCountry($code) {
        $code = strtoupper($code);
        if ($code == 'AF') return 'Afghanistan';
        if ($code == 'AX') return 'Aland Islands';
        if ($code == 'AL') return 'Albania';
        if ($code == 'DZ') return 'Algeria';
        if ($code == 'AS') return 'American Samoa';
        if ($code == 'AD') return 'Andorra';
        if ($code == 'AO') return 'Angola';
        if ($code == 'AI') return 'Anguilla';
        if ($code == 'AQ') return 'Antarctica';
        if ($code == 'AG') return 'Antigua and Barbuda';
        if ($code == 'AR') return 'Argentina';
        if ($code == 'AM') return 'Armenia';
        if ($code == 'AW') return 'Aruba';
        if ($code == 'AU') return 'Australia';
        if ($code == 'AT') return 'Austria';
        if ($code == 'AZ') return 'Azerbaijan';
        if ($code == 'BS') return 'Bahamas the';
        if ($code == 'BH') return 'Bahrain';
        if ($code == 'BD') return 'Bangladesh';
        if ($code == 'BB') return 'Barbados';
        if ($code == 'BY') return 'Belarus';
        if ($code == 'BE') return 'Belgium';
        if ($code == 'BZ') return 'Belize';
        if ($code == 'BJ') return 'Benin';
        if ($code == 'BM') return 'Bermuda';
        if ($code == 'BT') return 'Bhutan';
        if ($code == 'BO') return 'Bolivia';
        if ($code == 'BA') return 'Bosnia and Herzegovina';
        if ($code == 'BW') return 'Botswana';
        if ($code == 'BV') return 'Bouvet Island (Bouvetoya)';
        if ($code == 'BR') return 'Brazil';
        if ($code == 'IO') return 'British Indian Ocean Territory (Chagos Archipelago)';
        if ($code == 'VG') return 'British Virgin Islands';
        if ($code == 'BN') return 'Brunei Darussalam';
        if ($code == 'BG') return 'Bulgaria';
        if ($code == 'BF') return 'Burkina Faso';
        if ($code == 'BI') return 'Burundi';
        if ($code == 'KH') return 'Cambodia';
        if ($code == 'CM') return 'Cameroon';
        if ($code == 'CA') return 'Canada';
        if ($code == 'CV') return 'Cape Verde';
        if ($code == 'KY') return 'Cayman Islands';
        if ($code == 'CF') return 'Central African Republic';
        if ($code == 'TD') return 'Chad';
        if ($code == 'CL') return 'Chile';
        if ($code == 'CN') return 'China';
        if ($code == 'CX') return 'Christmas Island';
        if ($code == 'CC') return 'Cocos (Keeling) Islands';
        if ($code == 'CO') return 'Colombia';
        if ($code == 'KM') return 'Comoros the';
        if ($code == 'CD') return 'Congo';
        if ($code == 'CG') return 'Congo the';
        if ($code == 'CK') return 'Cook Islands';
        if ($code == 'CR') return 'Costa Rica';
        if ($code == 'CI') return 'Cote d\'Ivoire';
        if ($code == 'HR') return 'Croatia';
        if ($code == 'CU') return 'Cuba';
        if ($code == 'CY') return 'Cyprus';
        if ($code == 'CZ') return 'Czech';
        if ($code == 'DK') return 'Denmark';
        if ($code == 'DJ') return 'Djibouti';
        if ($code == 'DM') return 'Dominica';
        if ($code == 'DO') return 'Dominican';
        if ($code == 'EC') return 'Ecuador';
        if ($code == 'EG') return 'Egypt';
        if ($code == 'SV') return 'El Salvador';
        if ($code == 'GQ') return 'Equatorial Guinea';
        if ($code == 'ER') return 'Eritrea';
        if ($code == 'EE') return 'Estonia';
        if ($code == 'ET') return 'Ethiopia';
        if ($code == 'FO') return 'Faroe Islands';
        if ($code == 'FK') return 'Falkland Islands (Malvinas)';
        if ($code == 'FJ') return 'Fiji the Fiji Islands';
        if ($code == 'FI') return 'Finland';
        if ($code == 'FR') return 'France';
        if ($code == 'GF') return 'French Guiana';
        if ($code == 'PF') return 'French Polynesia';
        if ($code == 'TF') return 'French Southern Territories';
        if ($code == 'GA') return 'Gabon';
        if ($code == 'GM') return 'Gambia the';
        if ($code == 'GE') return 'Georgia';
        if ($code == 'DE') return 'Germany';
        if ($code == 'GH') return 'Ghana';
        if ($code == 'GI') return 'Gibraltar';
        if ($code == 'GR') return 'Greece';
        if ($code == 'GL') return 'Greenland';
        if ($code == 'GD') return 'Grenada';
        if ($code == 'GP') return 'Guadeloupe';
        if ($code == 'GU') return 'Guam';
        if ($code == 'GT') return 'Guatemala';
        if ($code == 'GG') return 'Guernsey';
        if ($code == 'GN') return 'Guinea';
        if ($code == 'GW') return 'Guinea-Bissau';
        if ($code == 'GY') return 'Guyana';
        if ($code == 'HT') return 'Haiti';
        if ($code == 'HM') return 'Heard Island and McDonald Islands';
        if ($code == 'VA') return 'Holy See (Vatican City State)';
        if ($code == 'HN') return 'Honduras';
        if ($code == 'HK') return 'Hong Kong';
        if ($code == 'HU') return 'Hungary';
        if ($code == 'IS') return 'Iceland';
        if ($code == 'IN') return 'India';
        if ($code == 'ID') return 'Indonesia';
        if ($code == 'IR') return 'Iran';
        if ($code == 'IQ') return 'Iraq';
        if ($code == 'IE') return 'Ireland';
        if ($code == 'IM') return 'Isle of Man';
        if ($code == 'IL') return 'Israel';
        if ($code == 'IT') return 'Italy';
        if ($code == 'JM') return 'Jamaica';
        if ($code == 'JP') return 'Japan';
        if ($code == 'JE') return 'Jersey';
        if ($code == 'JO') return 'Jordan';
        if ($code == 'KZ') return 'Kazakhstan';
        if ($code == 'KE') return 'Kenya';
        if ($code == 'KI') return 'Kiribati';
        if ($code == 'KP') return 'Korea';
        if ($code == 'KR') return 'Korea';
        if ($code == 'KW') return 'Kuwait';
        if ($code == 'KG') return 'Kyrgyz';
        if ($code == 'LA') return 'Lao';
        if ($code == 'LV') return 'Latvia';
        if ($code == 'LB') return 'Lebanon';
        if ($code == 'LS') return 'Lesotho';
        if ($code == 'LR') return 'Liberia';
        if ($code == 'LY') return 'Libyan Arab Jamahiriya';
        if ($code == 'LI') return 'Liechtenstein';
        if ($code == 'LT') return 'Lithuania';
        if ($code == 'LU') return 'Luxembourg';
        if ($code == 'MO') return 'Macao';
        if ($code == 'MK') return 'Macedonia';
        if ($code == 'MG') return 'Madagascar';
        if ($code == 'MW') return 'Malawi';
        if ($code == 'MY') return 'Malaysia';
        if ($code == 'MV') return 'Maldives';
        if ($code == 'ML') return 'Mali';
        if ($code == 'MT') return 'Malta';
        if ($code == 'MH') return 'Marshall Islands';
        if ($code == 'MQ') return 'Martinique';
        if ($code == 'MR') return 'Mauritania';
        if ($code == 'MU') return 'Mauritius';
        if ($code == 'YT') return 'Mayotte';
        if ($code == 'MX') return 'Mexico';
        if ($code == 'FM') return 'Micronesia';
        if ($code == 'MD') return 'Moldova';
        if ($code == 'MC') return 'Monaco';
        if ($code == 'MN') return 'Mongolia';
        if ($code == 'ME') return 'Montenegro';
        if ($code == 'MS') return 'Montserrat';
        if ($code == 'MA') return 'Morocco';
        if ($code == 'MZ') return 'Mozambique';
        if ($code == 'MM') return 'Myanmar';
        if ($code == 'NA') return 'Namibia';
        if ($code == 'NR') return 'Nauru';
        if ($code == 'NP') return 'Nepal';
        if ($code == 'AN') return 'Netherlands Antilles';
        if ($code == 'NL') return 'Netherlands the';
        if ($code == 'NC') return 'New Caledonia';
        if ($code == 'NZ') return 'New Zealand';
        if ($code == 'NI') return 'Nicaragua';
        if ($code == 'NE') return 'Niger';
        if ($code == 'NG') return 'Nigeria';
        if ($code == 'NU') return 'Niue';
        if ($code == 'NF') return 'Norfolk Island';
        if ($code == 'MP') return 'Northern Mariana Islands';
        if ($code == 'NO') return 'Norway';
        if ($code == 'OM') return 'Oman';
        if ($code == 'PK') return 'Pakistan';
        if ($code == 'PW') return 'Palau';
        if ($code == 'PS') return 'Palestinian Territory';
        if ($code == 'PA') return 'Panama';
        if ($code == 'PG') return 'Papua New Guinea';
        if ($code == 'PY') return 'Paraguay';
        if ($code == 'PE') return 'Peru';
        if ($code == 'PH') return 'Philippines';
        if ($code == 'PN') return 'Pitcairn Islands';
        if ($code == 'PL') return 'Poland';
        if ($code == 'PT') return 'Portugal';
        if ($code == 'PR') return 'Puerto Rico';
        if ($code == 'QA') return 'Qatar';
        if ($code == 'RE') return 'Reunion';
        if ($code == 'RO') return 'Romania';
        if ($code == 'RU') return 'Russia';
        if ($code == 'RW') return 'Rwanda';
        if ($code == 'BL') return 'Saint Barthelemy';
        if ($code == 'SH') return 'Saint Helena';
        if ($code == 'KN') return 'Saint Kitts and Nevis';
        if ($code == 'LC') return 'Saint Lucia';
        if ($code == 'MF') return 'Saint Martin';
        if ($code == 'PM') return 'Saint Pierre and Miquelon';
        if ($code == 'VC') return 'Saint Vincent and the Grenadines';
        if ($code == 'WS') return 'Samoa';
        if ($code == 'SM') return 'San Marino';
        if ($code == 'ST') return 'Sao Tome and Principe';
        if ($code == 'SA') return 'Saudi Arabia';
        if ($code == 'SN') return 'Senegal';
        if ($code == 'RS') return 'Serbia';
        if ($code == 'SC') return 'Seychelles';
        if ($code == 'SL') return 'Sierra Leone';
        if ($code == 'SG') return 'Singapore';
        if ($code == 'SK') return 'Slovakia (Slovak Republic)';
        if ($code == 'SI') return 'Slovenia';
        if ($code == 'SB') return 'Solomon Islands';
        if ($code == 'SO') return 'Somalia, Somali Republic';
        if ($code == 'ZA') return 'South Africa';
        if ($code == 'GS') return 'South Georgia and the South Sandwich Islands';
        if ($code == 'ES') return 'Spain';
        if ($code == 'LK') return 'Sri Lanka';
        if ($code == 'SD') return 'Sudan';
        if ($code == 'SR') return 'Suriname';
        if ($code == 'SJ') return 'Svalbard & Jan Mayen Islands';
        if ($code == 'SZ') return 'Swaziland';
        if ($code == 'SE') return 'Sweden';
        if ($code == 'CH') return 'Switzerland, Swiss Confederation';
        if ($code == 'SY') return 'Syrian Arab Republic';
        if ($code == 'TW') return 'Taiwan';
        if ($code == 'TJ') return 'Tajikistan';
        if ($code == 'TZ') return 'Tanzania';
        if ($code == 'TH') return 'Thailand';
        if ($code == 'TL') return 'Timor-Leste';
        if ($code == 'TG') return 'Togo';
        if ($code == 'TK') return 'Tokelau';
        if ($code == 'TO') return 'Tonga';
        if ($code == 'TT') return 'Trinidad and Tobago';
        if ($code == 'TN') return 'Tunisia';
        if ($code == 'TR') return 'Turkey';
        if ($code == 'TM') return 'Turkmenistan';
        if ($code == 'TC') return 'Turks and Caicos Islands';
        if ($code == 'TV') return 'Tuvalu';
        if ($code == 'UG') return 'Uganda';
        if ($code == 'UA') return 'Ukraine';
        if ($code == 'AE') return 'United Arab Emirates';
        if ($code == 'GB') return 'United Kingdom';
        if ($code == 'US') return 'United States';
        if ($code == 'UM') return 'United States Minor Outlying Islands';
        if ($code == 'VI') return 'United States Virgin Islands';
        if ($code == 'UY') return 'Uruguay, Eastern Republic of';
        if ($code == 'UZ') return 'Uzbekistan';
        if ($code == 'VU') return 'Vanuatu';
        if ($code == 'VE') return 'Venezuela';
        if ($code == 'VN') return 'Vietnam';
        if ($code == 'WF') return 'Wallis and Futuna';
        if ($code == 'EH') return 'Western Sahara';
        if ($code == 'YE') return 'Yemen';
        if ($code == 'XK') return 'Kosovo';
        if ($code == 'ZM') return 'Zambia';
        if ($code == 'ZW') return 'Zimbabwe';
        return '';
    }   
}