@extends('layout.base')
@section('title', 'Coronavirus '. ((isset($country['country']['name'])) ? 'in '. $country['country']['name'] : 'Country Statistics') )
@section('content')

@if(!empty($country))

@php 

    $data = (object)[
        'name'     => (isset($country['country']['name'])) ? $country['country']['name'] : 'Worldwide',
        'cases'     => (isset($country['cases'])) ? number_format($country['cases']) : 0,
        'death'     => (isset($country['death'])) ? number_format($country['death']) : 0,
        'todayCases' => (isset($country['today']['cases'])) ? number_format($country['today']['cases']) : 0,
        'todayDeath' => (isset($country['today']['death'])) ? number_format($country['today']['death']) : 0,
        'recovered' => (isset($country['recovered'])) ? number_format($country['recovered']) : 0,
        'active' => (isset($country['active'])) ? number_format($country['active']) : 0,
        'mild' => (isset($country['mild'])) ? number_format($country['mild']) : 0,
        'critical' => (isset($country['critical'])) ? number_format($country['critical']) : 0,
        'rateDeath' => (isset($country['cases']) && $country['death'] && $country['cases']) ? round((($country['death'] * 100) / $country['cases']), 2) : 0,
        'rateRecover' => (isset($country['cases']) && $country['recovered'] && $country['cases']) ? round((($country['recovered'] * 100) / $country['cases']), 2) : 0,
        'rateActive' => (isset($country['cases']) && $country['active'] && $country['cases']) ? round((($country['active'] * 100) / $country['cases']), 2) : 0,
    ];

@endphp
<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between flex-wrap g-1 align-start">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">Coronavirus in {{ $country['country']['name'] }}</h5>
        </div>
        <div class="nk-block-head-content">
            <p class="note-text">Updated: {{ $last_update }}</p>
        </div>
    </div>
</div>{{-- .nk-block-head --}}

<div class="nk-block">
    <div class="row g-gs">
        <div class="col-sm-6 col-xl-3">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="nk-cov-wg1">
                        <div class="nk-cov-data">
                            <h6 class="overline-title">Total Confirmed Cases</h6>
                            <div class="amount">{{ $data->cases }}</div>
                        </div>
                        <div class="amount-sm"><strong>+ {{ $data->todayCases }}</strong><br><span class="text-gray">from yesterday</span></div>
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="nk-cov-wg1">
                        <div class="nk-cov-data">
                            <h6 class="overline-title">Total Deaths</h6>
                            <div class="amount text-danger">{{ $data->death }}</div>
                        </div>
                        <div class="amount-sm"><strong>+ {{ $data->todayDeath }}</strong><br><span class="text-gray">from yesterday</span></div>
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="nk-cov-wg1">
                        <div class="nk-cov-data">
                            <h6 class="overline-title">Total Recovered</h6>
                            <div class="amount text-success">{{ $data->recovered }}</div>
                        </div>
                        <div class="amount-sm"><strong>{{ $data->rateRecover }}%</strong><br><span class="text-gray">Ratio of Recovery</span></div>
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
        <div class="col-sm-6 col-xl-3">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="nk-cov-wg1">
                        <div class="nk-cov-data">
                            <h6 class="overline-title">Active Cases</h6>
                            <div class="amount text-purple">{{ $data->active }}</div>
                        </div>
                        <div class="amount-sm"><strong>{{ $data->critical }}</strong><br><span class="text-gray">In Critical / Serious</span></div>
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
    </div>{{-- .row --}}
</div>{{-- .nk-block --}}

<div class="nk-block">
    <div class="row g-gs">
    	<div class="col-lg-4">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-1">
                        <div class="card-title">
                            <h6 class="title">Spread over time</h6>
                            <p>How spreading in last 60 days.</p>
                        </div>
                    </div>
                    <div class="nk-cov-wg6">
                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#timeline-all">All</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#timeline-cases">Cases</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#timeline-death">Deaths</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#timeline-recover">Recovered</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-0">
                            <div class="tab-pane active" id="timeline-all">
                                <ul class="nk-cov-wg6-legend">
                                    <li>
		                                <div class="dot dot-md sq bg-purple"></div>
		                                <span>Confirm Cases</span>
		                            </li>
		                            <li>
		                                <div class="dot dot-md sq bg-success"></div>
		                                <span>Recovered</span>
		                            </li>
		                            <li>
		                                <div class="dot dot-md sq bg-danger"></div>
		                                <span>Deaths</span>
		                            </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-line-chart" id="timelineDailyLine"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                    <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline-cases">
                                <ul class="nk-cov-wg6-legend">
                                    <li>
		                                <div class="dot dot-md sq bg-purple"></div>
		                                <span>Confirm Cases</span>
		                            </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-line-chart" id="timelineDailyCases"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                    <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline-death">
                                <ul class="nk-cov-wg6-legend">
		                            <li>
		                                <div class="dot dot-md sq bg-danger"></div>
		                                <span>Deaths</span>
		                            </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-line-chart" id="timelineDailyDeaths"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                    <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                </div>
                            </div>
                            <div class="tab-pane" id="timeline-recover">
                                <ul class="nk-cov-wg6-legend">
		                            <li>
		                                <div class="dot dot-md sq bg-success"></div>
		                                <span>Recovered</span>
		                            </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-line-chart" id="timelineDailyRecovers"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                    <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>{{-- .card --}}
        </div>{{-- .col --}}

        <div class="col-lg-4">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-1">
                        <div class="card-title">
                            <h6 class="title">Daily Confirmed Cases</h6>
                            <p>The daily confirmed cases in last 60 days.</p>
                        </div>
                    </div>
                    <div class="nk-cov-wg6">
                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#confirmed-linear">Linear</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#confirmed-bar">Bar Graph</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-0">
                            <div class="tab-pane active" id="confirmed-linear">
                                <ul class="nk-cov-wg6-legend">
                                    <li>
                                        <div class="dot dot-md sq bg-primary"></div>
                                        <span>Confirmed</span>
                                    </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-line-chart" id="confirmDailyLine"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                    <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                </div>
                            </div>
                            <div class="tab-pane" id="confirmed-bar">
                                <ul class="nk-cov-wg6-legend">
                                    <li>
                                        <div class="dot dot-md sq bg-purple"></div>
                                        <span>Confirmed</span>
                                    </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-bar-chart" id="confirmDailyBar"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                    <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>{{-- .card --}}
        </div>{{-- .col --}}

        <div class="col-lg-4">
            <div class="card card-bordered card-full">
                <div class="card-inner">
                    <div class="card-title-group mb-1">
                        <div class="card-title">
                            <h6 class="title">Daily New Deaths</h6>
                            <p>The daily deaths in last 60 days.</p>
                        </div>
                    </div>
                    <div class="nk-cov-wg6">
                        <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#deaths-linear">Linear</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#deaths-bar">Bar Graph</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-0">
                            <div class="tab-pane active" id="deaths-linear">
                                <ul class="nk-cov-wg6-legend">
                                    <li>
                                        <div class="dot dot-md sq bg-danger"></div>
                                        <span>Deaths</span>
                                    </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-line-chart" id="deathsDailyLine"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                    <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                </div>
                            </div>
                            <div class="tab-pane" id="deaths-bar">
                                <ul class="nk-cov-wg6-legend">
                                    <li>
                                        <div class="dot dot-md sq bg-purple"></div>
                                        <span>Deaths</span>
                                    </li>
                                </ul>
                                <div class="nk-cov-wg6-ck">
                                    <canvas class="covid-case-bar-chart" id="deathsDailyBar"></canvas>
                                </div>
                                <div class="chart-label-group ml-5">
                                    <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                    <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>{{-- .card --}}
        </div>{{-- .col --}}
    </div>{{-- .row --}}
</div>{{-- .nk-block --}}

@endif
@endsection

@push('footer')
@if(!empty($country))
<script src="{{ asset('assets/js/chart-covstats.js?ver=100') }}"></script>
<script type="text/javascript">
    var confirmDailyLine = {
            labels : [{!! $graphs['daily']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['daily']->max['cases'] / 10), 0) }},
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['daily']->data['cases'] !!}]
            }]
        },
        confirmDailyBar = {
            labels : [{!! $graphs['daily']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['daily']->max['cases'] / 10), 0) }},
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['daily']->data['cases'] !!}]
            }]
        },
        deathsDailyLine = {
            labels : [{!! $graphs['daily']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['daily']->max['deaths'] / 10), 0) }},
            datasets : [{
                label : "Deaths",
                color : "#e85347",
                background: 'transparent',
                data: [{!! $graphs['daily']->data['deaths'] !!}]
            }]
        },
        deathsDailyBar = {
            labels : [{!! $graphs['daily']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['daily']->max['deaths'] / 10), 0) }},
            datasets : [{
                label : "Deaths",
                color : "#e85347",
                background: 'transparent',
                data: [{!! $graphs['daily']->data['deaths'] !!}]
            }]
        },
        timelineDailyLine = {
            labels : [{!! $graphs['timeline']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['timeline']->max['cases'] / 10), 0) }},
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['timeline']->data['cases'] !!}]
            }, {
                label : "Deaths",
                color : "#f6525e",
                background: 'transparent',
                data: [{!! $graphs['timeline']->data['deaths'] !!}]
            }, {
                label : "Recovered",
                color : "#1ee0ac",
                background: 'transparent',
                data: [{!! $graphs['timeline']->data['recovered'] !!}]
            }]
        },
        timelineDailyCases = {
            labels : [{!! $graphs['timeline']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['timeline']->max['cases'] / 10), 0) }},
            datasets : [{
                label : "Confirmed",
                color : "#0971fe",
                background: 'transparent',
                data: [{!! $graphs['timeline']->data['cases'] !!}]
            }]
        },
        timelineDailyDeaths = {
            labels : [{!! $graphs['timeline']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['timeline']->max['deaths'] / 10), 0) }},
            datasets : [{
                label : "Deaths",
                color : "#f6525e",
                background: 'transparent',
                data: [{!! $graphs['timeline']->data['deaths'] !!}]
            }]
        },
        timelineDailyRecovers = {
            labels : [{!! $graphs['timeline']->labels !!}],
            dataUnit : 'People',
            lineTension : 0.1,
            steps: {{ round(($graphs['timeline']->max['recovered'] / 10), 0) }},
            datasets : [{
                label : "Recovered",
                color : "#1ee0ac",
                background: 'transparent',
                data: [{!! $graphs['timeline']->data['recovered'] !!}]
            }]
        };
</script>
@endif
@endpush