@extends('layout.base')
@section('title', 'Coronavirus Live Update')
@section('style')
<style>
    .country{
    font-weight: 600!important;
    color: var(--paleGray)!important;       
    }
    .confirmed{
    font-weight: 600!important;
    color: rgb(248, 245, 64)!important;
    }
    .death{
    font-weight: 600!important;
    color: #F65164!important;
    }
    .recovered{
    font-weight: 600!important;
    color: rgb(101, 221, 155)!important;
    }
</style>
@endsection
@section('content')

@if(!empty($countries) && !empty($world))
@php 

    $wld = (object)[
        'name'     => (isset($world['country']['name'])) ? $world['country']['name'] : 'Worldwide',
        'cases'     => (isset($world['cases'])) ? number_format($world['cases']) : 0,
        'death'     => (isset($world['death'])) ? number_format($world['death']) : 0,
        'todayCases' => (isset($world['today']['cases'])) ? number_format($world['today']['cases']) : 0,
        'todayDeath' => (isset($world['today']['death'])) ? number_format($world['today']['death']) : 0,
        'recovered' => (isset($world['recovered'])) ? number_format($world['recovered']) : 0,
        'active' => (isset($world['active'])) ? number_format($world['active']) : 0,
        'mild' => (isset($world['mild'])) ? number_format($world['mild']) : 0,
        'critical' => (isset($world['critical'])) ? number_format($world['critical']) : 0,
        'rateDeath' => (isset($world['cases']) && $world['death'] && $world['cases']) ? round((($world['death'] * 100) / $world['cases']), 2) : 0,
        'rateRecover' => (isset($world['cases']) && $world['recovered'] && $world['cases']) ? round((($world['recovered'] * 100) / $world['cases']), 2) : 0,
        'rateActive' => (isset($world['cases']) && $world['active'] && $world['cases']) ? round((($world['active'] * 100) / $world['cases']), 2) : 0,
    ];

    $local      = isset($countries['us']) ? $countries['us'] : false;


    $country = (object)[
        'name'     => (isset($local['country']['name'])) ? $local['country']['name'] : '',
        'cases'     => (isset($local['cases'])) ? number_format($local['cases']) : 0,
        'death'     => (isset($local['death'])) ? number_format($local['death']) : 0,
        'todayCases' => (isset($local['today']['cases'])) ? number_format($local['today']['cases']) : 0,
        'todayDeath' => (isset($local['today']['death'])) ? number_format($local['today']['death']) : 0,
        'recovered' => (isset($local['recovered'])) ? number_format($local['recovered']) : 0,
        'active' => (isset($local['active'])) ? number_format($local['active']) : 0,
        'mild' => (isset($local['mild'])) ? number_format($local['mild']) : 0,
        'critical' => (isset($local['critical'])) ? number_format($local['critical']) : 0,
        'rateDeath' => (isset($local['cases']) && $local['death'] && $local['cases']) ? round((($local['death'] * 100) / $local['cases']), 2) : 0,
        'rateRecover' => (isset($local['cases']) && $local['recovered'] && $local['cases']) ? round((($local['recovered'] * 100) / $local['cases']), 2) : 0,
        'rateActive' => (isset($local['cases']) && $local['active'] && $local['cases']) ? round((($local['active'] * 100) / $local['cases']), 2) : 0,
    ];

@endphp
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between flex-wrap g-1 align-start">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Coronavirus Live Update | CovidRadar24</h5>
        </div>
        <div class="nk-block-head-content">
            <p class="note-text">Updated: {{ $last_update }}</p>
        </div>
    </div>
</div>{{-- .nk-block-head --}}

<div class="nk-block">
    <div class="row g-gs">
        <div class="col-xl-4">
            <div class="row g-gs">
                <div class="col-lg-6 col-xl-12">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="nk-cov-wg1">
                                <div class="card-title">
                                    <h5 class="title">Coronavirus Cases - <small>{{ $wld->name }}</small></h5>
                                </div>
                                <div class="nk-cov-data">
                                    <h6 class="overline-title">Total Confirmed Cases</h6>
                                    <div class="amount">{{ $wld->cases }}</div>
                                </div>
                                <div class="nk-cov-wg1-progress">
                                    <div class="progress progress-reverse progress-md progress-pill progress-bordered">
                                        <div class="progress-bar bg-danger" data-progress="{{ $wld->rateDeath }}" data-toggle="tooltip" title="Death: {{ $wld->rateDeath }}%"></div>
                                        <div class="progress-bar bg-success" data-progress="{{ $wld->rateRecover }}" data-toggle="tooltip" title="Recovered: {{ $wld->rateRecover }}%"></div>
                                        <div class="progress-bar bg-purple" data-progress="{{ $wld->rateActive }}" data-toggle="tooltip" title="Active Cases: {{ $wld->rateActive }}%"></div>
                                    </div>
                                </div>
                                <ul class="nk-cov-wg1-data">
                                    <li>
                                        <div class="title">
                                            <div class="dot dot-lg sq bg-purple"></div>
                                            <span>Active Cases</span>
                                        </div>
                                        <div class="count">{{ $wld->active }}</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <div class="dot dot-lg sq bg-success"></div>
                                            <span>Recovered</span>
                                        </div>
                                        <div class="count">{{ $wld->recovered }}</div>
                                    </li>
                                    <li>
                                        <div class="title">
                                            <div class="dot dot-lg sq bg-danger"></div>
                                            <span>Deaths</span>
                                        </div>
                                        <div class="count">{{ $wld->death }}</div>
                                    </li>
                                </ul>
                                <div class="nk-cov-wg-note" style="color: #5e7ea9;">Ratio of <span class="text-primary">Recovery ({{ $wld->rateRecover }}%)</span> &amp; <span class="text-primary">Deaths ({{ $wld->rateDeath }}%)</span>.</div>
                            </div>
                        </div>
                    </div>
                </div>{{-- .col --}}
                <div class="col-lg-6 col-xl-12">
                    <div class="card card-bordered card-full">
                        <div class="card-inner">
                            <div class="nk-cov-wg2">
                                <div class="card-title">
                                    <h5 class="title">Coronavirus Cases - <small>{{ $country->name }}</small></h5>
                                </div>
                                <div class="nk-cov-wg2-block">
                                    <div class="nk-cov-wg2-group-top">
                                        <div class="nk-cov-group">
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title">Confirmed</h6>
                                                <div class="amount amount-sm">{{ $country->cases }} <small>+{{ $country->todayCases }}</small></div>
                                            </div>
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title">Deaths</h6>
                                                <div class="amount amount-sm text-danger">{{ $country->death }} <small>+{{ $country->todayDeath }}</small></div>
                                            </div>
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title">Recovered</h6>
                                                <div class="amount amount-sm text-success">{{ $country->recovered }}</div>
                                            </div>
                                        </div>
                                        <div class="nk-cov-wg-note" style="color: #5e7ea9;">Ratio of <span class="text-primary">Recovery ({{ $country->rateRecover }}%)</span> &amp; <span class="text-primary">Deaths ({{ $country->rateDeath }}%)</span>.</div>
                                    </div>
                                    <div class="nk-cov-wg2-group-bottom nk-cov-wg2-group">
                                        <div class="nk-cov-data">
                                            <h6 class="sub-text">Currently <br class="d-xxl-none"> Infected Patients</h6>
                                            <div class="amount amount-xs">{{ $country->active }}</div>
                                        </div>
                                        <ul class="nk-cov-wg2-data" style="border-color: #1d2d40 !important;">
                                            <li>
                                                <div class="title">
                                                    <div class="dot dot-lg sq bg-purple"></div>
                                                    <span>In Mild Condition</span>
                                                </div>
                                                <div class="count">{{ $country->mild }}</div>
                                            </li>
                                            <li>
                                                <div class="title">
                                                    <div class="dot dot-lg sq bg-success"></div>
                                                    <span>Critical or Serious</span>
                                                </div>
                                                <div class="count">{{ $country->critical }}</div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>{{-- .col --}}
            </div>{{-- .row --}}
        </div>{{-- .col --}}
        <div class="col-xl-8">
            <div class="card card-bordered card-full">
                <div class="nk-cov-wg4">
                    <div class="nk-cov-wg4-aside" style="border-color: #1d2d40 !important;">
                        <div class="nk-cov-wg4-aside-head">
                            <h6 class="nk-cov-wg4-aside-title">Cases by Vaccines</h6>
                            <div class="nk-cov-wg4-aside-action mr-n2">&nbsp;</div>
                        </div>
                        <div class="nk-cov-wg4-aside-body" data-simplebar>
                            <ul class="nk-cov-wg4-list">
{{--
                            @foreach($countries as $item)
                            	@if($item['cases'])
								<li>
                                    <a class="nk-cov-wg4-list-item" data-id="{{ strtolower($item['country']['code']) }}">
                                        <span class="title">{{ $item['country']['name'] }}</span>
                                        <span class="count">{{ number_format($item['cases']) }}</span>
                                    </a>
                                </li>
                                @endif
                            @endforeach
--}}
                        @if(count($vaccines)>0)
                            @foreach($vaccines as $item)
                                <li>
                                    <a class="nk-cov-wg4-list-item" data-id="">
                                        <span class="title">{{ $item->location }}</span>
                                        <span class="count">{{ number_format($item->total_vaccinations) }}</span>
                                    </a>
                                </li>                                
                            @endforeach   
                        @endif                                                     
                            </ul>
                        </div>
                        <div class="nk-cov-wg4-aside-foot text-center">
                            <a href="{{ route('countries') }}" class="btn btn-round btn-outline-primary">Country wise statistics</a>
                        </div>
                    </div>
                    <div class="nk-cov-wg4-content">
                        <div class="nk-cov-wg4-map">
                            <div class="vector-map" id="worldMap"></div>
                        </div>
                        <div class="nk-cov-wg4-meta">
                            <div class="nk-cov-wg4-meta-tools">
                                <strong class="sub-text-sm">World Daily Case History</strong>
                            </div>
                            <ul class="nk-cov-wg4-meta-data">
                                <li>
                                    <div class="dot dot-lg sq bg-purple"></div>
                                    <span>Confirmed</span>
                                </li>
                                <li>
                                    <div class="dot dot-lg sq bg-success"></div>
                                    <span>Recovered</span>
                                </li>
                                <li>
                                    <div class="dot dot-lg sq bg-danger"></div>
                                    <span>Deaths</span>
                                </li>
                            </ul>
                        </div>
                        <div class="nk-cov-wg4-ck">
                            <canvas class="covid-case-line-chart" id="mapWorldChart"></canvas>
                        </div>
                        <div class="chart-label-group ml-5">
                            <div class="chart-label">{{ $graphs['world_daily']->first }}</div>
                            <div class="chart-label">{{ $graphs['world_daily']->last }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
        <div class="col-xl-4 col-md-6">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-1">
                        <div class="card-title">
                            <h6 class="title">Cases Over Time - <small>World</small></h6>
                            <p>The below charts shown daily case trends.</p>
                        </div>
                    </div>
                    <div class="nk-cov-wg3">
                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#world-daily">Daily</a>
                            </li>                            
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#world-timeline">Confirmed</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#world-compare">All Trend</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-0">
                            <div class="tab-pane active" id="world-daily">
                                <div class="nk-cov-wg3-legend-wrap">
                                    <h6 class="title">Daily Confirmed Cases</h6>
                                    <ul class="nk-cov-wg3-legend">
                                        <li>
                                            <div class="dot dot-md sq bg-purple"></div>
                                            <span>Confirmed</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="nk-cov-wg3-ck">
                                    <canvas class="covid-case-bar-chart" id="worldDaily"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['world_daily']->first }}</div>
                                    <div class="chart-label">{{ $graphs['world_daily']->last }}</div>
                                </div>
                            </div>                            
                            <div class="tab-pane " id="world-timeline">
                                <div class="nk-cov-wg3-legend-wrap">
                                    <h6 class="title">Flow of Cases</h6>
                                    <ul class="nk-cov-wg3-legend">
                                        <li>
                                            <div class="dot dot-md sq bg-purple"></div>
                                            <span>Confirmed</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="nk-cov-wg3-ck">
                                    <canvas class="covid-case-line-chart" id="worldTimeline"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['world_timeline']->first }}</div>
                                    <div class="chart-label">{{ $graphs['world_timeline']->last }}</div>
                                </div>
                            </div>
                            <div class="tab-pane" id="world-compare">
                                <div class="nk-cov-wg3-legend-wrap">
                                    <h6 class="title">Spread Over Time</h6>
                                    <ul class="nk-cov-wg3-legend">
                                        <li>
                                            <div class="dot dot-md sq bg-purple"></div>
                                            <span>Cases</span>
                                        </li>
                                        <li>
                                            <div class="dot dot-md sq bg-danger"></div>
                                            <span>Deaths</span>
                                        </li>
                                        <li>
                                            <div class="dot dot-md sq bg-success"></div>
                                            <span>Recovered</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="nk-cov-wg3-ck">
                                    <canvas class="covid-case-line-chart" id="worldSpread"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['world_timeline']->first }}</div>
                                    <div class="chart-label">{{ $graphs['world_timeline']->last }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
        <div class="col-xl-4 col-md-6">
            <div class="card card-bordered card-full">
                <div class="card-inner mb-n2">
                    <div class="card-title-group">
                        <div class="card-title mb-0">
                            <h6 class="title">Most Affected Countries</h6>
                        </div>
                        <div class="card-tools">
                            <a href="{{ route('countries') }}" class="link">View All</a>
                        </div>
                    </div>
                </div>
                <div class="nk-tb-list is-medium nk-cov-wg5-table">
                    <div class="nk-tb-item nk-tb-head">
                        <div class="nk-tb-col">Country</div>
                        <div class="nk-tb-col text-right">Confirmed</div>
                        <div class="nk-tb-col text-right">Recovered</div>
                        <div class="nk-tb-col text-right">Deaths</div>
                    </div>
                    @foreach($affected as $item)
                    <div class="nk-tb-item">
                        <div class="nk-tb-col">
                            <div class="tb-country">
                                <img class="flag" src="{{ asset('images/flags/'.strtolower($item['country']['code']).'.png') }}" alt="">
                                <div class="name country">{{ $item['country']['name'] }}</div>
                            </div>
                        </div>
                        <div class="nk-tb-col text-right">
                            <div class="tb-lead tb-amount confirmed">{{ number_format($item['cases']) }}</div>
                        </div>
                        <div class="nk-tb-col text-right">
                            <div class="tb-lead tb-amount recovered">{{ number_format($item['recovered']) }}</div>
                        </div>
                        <div class="nk-tb-col text-right">
                            <div class="tb-lead tb-amount death">{{ number_format($item['death']) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>{{-- .col --}}
        <div class="col-xl-4">
            <div class="card card-bordered card-full is-center-mb">
                <div class="card-inner">
                    <div class="card-title-group mb-4">
                        <div class="card-title">
                            <h6 class="title">Worldwide Affected Ratio</h6>
                            <p>The bar show most affected country in ratio.</p>
                        </div>
                    </div>
                    <div class="nk-cov-wg7">
                        <div class="nk-cov-wg7-list gy-1">
                            @foreach ($affect_ratio as $item)
                            <div class="nk-cov-wg7-data">
                                <div class="nk-cov-wg7-data-title">
                                    <div class="lead-text">{{ $item['name'] }}</div>
                                </div>
                                <div class="nk-cov-wg7-data-progress">
                                    <div class="progress progress-alt bg-transparent">
                                        <div class="progress-bar" data-bg="{{ $item['color'] }}" data-progress="{{ ($item['percent'] * 1.5) }}"></div>
                                        <div class="progress-amount">{{ $item['percent'] }}%</div>
                                    </div>
                                </div>
                                <div class="nk-cov-wg7-data-count text-right">
                                    <div class="sub-text">{{ $item['cases'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>{{-- .nk-cov-wg7-list --}}
                    </div>{{-- .nk-cov-wg7 --}}
                </div>
            </div>
        </div>{{-- .col --}}
    </div>{{-- .row --}}
</div>{{-- .nk-block --}}
@endif

@endsection

@push('footer')
@if(!empty($countries) && !empty($world))
<script src="{{ asset('assets/js/libs/jqvmap.js?ver=100') }}"></script>
<script src="{{ asset('assets/js/chart-covstats.js?ver=100') }}"></script>
<script type="text/javascript">
    var countryUri = "{{ route('country.details') }}";
    var worldMap = { map: 'world_en', data : {!! $graphs['map'] !!} },
        worldTimeline = {
            labels : [{!! $graphs['world_timeline']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['world_timeline']->data['cases'] !!}]
            }]
        }, 
        worldDaily = {
            labels : [{!! $graphs['world_daily']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['world_daily']->data['cases'] !!}]
            }]
        },
        worldSpread = {
            labels : [{!! $graphs['world_timeline']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['world_timeline']->data['cases'] !!}]
            }, {
                label : "Deaths",
                color : "#f6525e",
                background: 'transparent',
                data: [{!! $graphs['world_timeline']->data['deaths'] !!}]
            }, {
                label : "Recovered",
                color : "#1ee0ac",
                background: 'transparent',
                data: [{!! $graphs['world_timeline']->data['recovered'] !!}]
            }]
        },
        mapWorldChart = {
            labels : [{!! $graphs['world_daily']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['world_daily']->data['cases'] !!}]
            }, {
                label : "Deaths",
                color : "#f6525e",
                background: 'transparent',
                data: [{!! $graphs['world_daily']->data['deaths'] !!}]
            }, {
                label : "Recovered",
                color : "#1ee0ac",
                background: 'transparent',
                data: [{!! $graphs['world_daily']->data['recovered'] !!}]
            }]
        };
</script>
@endif
@endpush