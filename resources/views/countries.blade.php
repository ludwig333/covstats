@extends('layout.base')
@section('title', 'Coronavirus Update')
@section('style')
<style>
	.nk-tb-list .tb-country .name{
	font-weight: 600!important;
    color: var(--paleGray)!important;		
	}
	.infect{
	font-weight: 600!important;
	color: rgb(248, 245, 64)!important;
	}
	.infect-hr{
	font-weight: 600!important;
	color: #ffc137!important;
	}
	.death{
	font-weight: 600!important;
	color: #F65164!important;
	}
	.recover{
	font-weight: 600!important;
	color: rgb(101, 221, 155)!important;
	}
	.active{
	font-weight: 600!important;
	color: rgb(68, 155, 226)!important;
	}
	.serious{
	font-weight: 600!important;
	color: #FF9D00!important;
	}
	.nk-tb-col-action{

	}
</style>
@endsection
@section('content')
	
@if(!empty($countries))
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
	    <div class="col-xl-8">
	        <div class="card card-bordered nk-cov-wg8">
	            <div class="card-inner">
	                <div class="nk-cov-wg8-group g-3">
	                    <div class="nk-cov-wg8-map mr-lg-5">
	                        <div class="vector-map" id="worldMap"></div>
	                    </div>
	                </div>
	            </div>{{-- .card-inner --}}
	            <div class="card-inner border-top">
	                <div class="card-title-group">
	                    <div class="card-title">
	                        <h6 class="title align-center"><span class="mr-2">Statistics</span> <em class="icon ni ni-info text-primary fs-14px" data-toggle="tooltip" title="tolltip"></em></h6>
	                    </div>
	                    <div class="card-tools">
	                        <ul class="card-tools-nav">
	                            <li class="active"><span>Now</span></li>
	                        </ul>
	                    </div>
	                </div>
	            </div>{{-- .card-inner --}}
	            <div class="card-inner p-0 border-top nk-cov-wg8-table-wrap">
	                <table class="nk-tb-list nk-tb-covid nk-tb-countries is-medium">
	                    <thead>
	                        <tr class="nk-tb-item nk-tb-head">
	                            <th class="nk-tb-col nk-tb-col-country cov-sortable"><span>Country</span></th>
	                            <th class="nk-tb-col nk-tb-col-infect cov-sortable sort-down"><span>Infected</span></th>
	                            <th class="nk-tb-col nk-tb-col-infect-hr cov-sortable"><span>In Last 24h</span></th>
	                            <th class="nk-tb-col nk-tb-col-death cov-sortable"><span>Deaths</span></th>
	                            <th class="nk-tb-col nk-tb-col-recover cov-sortable"><span>Recovered</span></th>
	                            <th class="nk-tb-col nk-tb-col-active cov-sortable"><span>Active Cases</span></th>
	                            <th class="nk-tb-col nk-tb-col-serious cov-sortable"><span>Serious</span></th>
	                            <th class="nk-tb-col nk-tb-col-action"><span>&nbsp;</span></th>
	                        </tr>
	                    </thead>
	                </table>
	                <div class="nk-cov-table-pro" data-simplebar>
	                    <table class="nk-tb-list nk-tb-covid nk-tb-countries cov-datatable is-medium">
	                        <thead>
	                            <tr class="nk-tb-item nk-tb-head">
	                                <th class="nk-tb-col nk-tb-col-country"><span>Country</span></th>
	                                <th class="nk-tb-col nk-tb-col-infect"><span>Infected</span></th>
	                                <th class="nk-tb-col nk-tb-col-infect-hr"><span>In Last 24h</span></th>
	                                <th class="nk-tb-col nk-tb-col-death"><span>Deaths</span></th>
	                                <th class="nk-tb-col nk-tb-col-recover"><span>Recovered</span></th>
	                                <th class="nk-tb-col nk-tb-col-active"><span>Active Cases</span></th>
	                                <th class="nk-tb-col nk-tb-col-serious"><span>Serious</span></th>
	                                <th class="nk-tb-col nk-tb-col-action nk-tb-col-nosort" data-priority="1"><span></span></th>
	                            </tr>
	                        </thead>
	                        <tbody>
	                        @foreach($countries as $code => $locat)
                            	@if($code !='world' && $locat['cases'])

                            	<tr class="nk-tb-item{{ ($locat['cases'] >= 50 && !($code=='xz'||$code=='xd')) ? ' get-details' : '' }}" data-code="{{ strtolower($locat['country']['code']) }}" data-location="{{ $locat['country']['name'] }}">
	                                <td class="nk-tb-col nk-tb-col-country">
	                                    <div class="tb-country">
	                                        <img class="flag" src="{{ asset('images/flags/'.strtolower($locat['country']['code']).'.png') }}" alt="{{ $locat['country']['name'] }}">
	                                        <div class="name">{{ $locat['country']['name'] }}</div>
	                                    </div>
	                                </td>
	                                <td class="nk-tb-col nk-tb-col-infect">
	                                    <span class="tb-lead tb-lead-sub infect">{{ number_format($locat['cases']) }}</span>
	                                </td>
	                                <td class="nk-tb-col nk-tb-col-infect-hr">
	                                    <span class="tb-lead tb-lead-sub infect-hr" style="display: inline;">{{ ($locat['today']['cases']) ? '+'.number_format($locat['today']['cases']) : '' }}
	                                    </span>
	                                    <span style="font-weight: 600!important;color: var(--paleGray)!important;">{{ ($locat['today']['death']) ? ' | ' : '' }}
	                                    </span>
	                                    <span style="font-weight: 600!important;color: #F65164!important;">{{ ($locat['today']['death']) ? '+'.number_format($locat['today']['death']) : '' }}
	                                    </span>
	                                </td>
	                                <td class="nk-tb-col nk-tb-col-death">
	                                    <span class="tb-lead tb-lead-sub death">{{ ($locat['death']) ? number_format($locat['death']) : '' }}</span>
	                                </td>
	                                <td class="nk-tb-col nk-tb-col-recover">
	                                    <span class="tb-lead tb-lead-sub recover">{{ ($locat['recovered']) ? number_format($locat['recovered']) : '' }}</span>
	                                </td>
	                                <td class="nk-tb-col nk-tb-col-active">
	                                    <span class="tb-lead tb-lead-sub active">{{ ($locat['active']) ? number_format($locat['active']) : '' }}</span>
	                                </td>
	                                <td class="nk-tb-col nk-tb-col-serious">
	                                    <span class="tb-lead tb-lead-sub serious">{{ ($locat['critical']) ? number_format($locat['critical']) : '' }}</span>
	                                </td>
	                                <td class="nk-tb-col nk-tb-col-action">
	                                	@if($locat['cases'] >= 50 && !($code=='xz'||$code=='xd'))
	                                    <a class="btn btn-sm btn-icon btn-trigger mr-n2"><em class="icon ni ni-chevron-right"></em></a>
	                                    @endif 
	                                </td>
	                            </tr>

                                @endif
                            @endforeach
	                        </tbody>
	                    </table>
	                </div>
	            </div>{{-- .card-inner --}}
	        </div>{{-- .card --}}
	    </div>{{-- .col --}}
	    <div class="col-xl-4">
	        <div class="row g-gs">
	            <div class="col-xl-12 col-lg-6">
	                <div class="card card-bordered card-full">
	                    <div class="card-inner">
	                        <div class="card-title-group mb-1">
	                            <div class="card-title">
	                                <h6 class="title">Spread over time <small> - World</small></h6>
	                                <p>Chart shown how spread over time.</p>
	                            </div>
	                        </div>
	                        <div class="nk-cov-wg6">
	                            <ul class="nav nav-tabs nav-tabs-card nav-tabs-xs">
	                                <li class="nav-item">
	                                    <a class="nav-link active" data-toggle="tab" href="#daily-increase">Daily Increase</a>
	                                </li>	                            	
	                                <li class="nav-item">
	                                    <a class="nav-link" data-toggle="tab" href="#confirmed-cases">Confirmed Cases</a>
	                                </li>
	                            </ul>
	                            <div class="tab-content mt-0">
	                                <div class="tab-pane active" id="daily-increase">
	                                    <ul class="nk-cov-wg6-legend">
	                                        <li>
	                                            <div class="dot dot-md sq bg-primary"></div>
	                                            <span>Confirmed</span>
	                                        </li>
	                                    </ul>
	                                    <div class="nk-cov-wg6-ck">
	                                        <canvas class="covid-case-bar-chart" id="worldDaily"></canvas>
	                                    </div>
	                                    <div class="chart-label-group ml-5">
	                                        <div class="chart-label">{{ $graphs['world_daily']->first }}</div>
	                                        <div class="chart-label">{{ $graphs['world_daily']->last }}</div>
	                                    </div>
	                                </div>	                            	
	                                <div class="tab-pane" id="confirmed-cases">
	                                    <ul class="nk-cov-wg6-legend">
	                                        <li>
	                                            <div class="dot dot-md sq bg-primary"></div>
	                                            <span>Confirmed</span>
	                                        </li>
	                                    </ul>
	                                    <div class="nk-cov-wg6-ck">
	                                        <canvas class="covid-case-line-chart" id="worldTimeline"></canvas>
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
	            <div class="col-xl-12 col-lg-6">
	                <div class="card card-bordered card-full">
	                    <div class="card-inner">
	                        <div class="card-title-group mb-4">
	                            <div class="card-title">
	                                <h6 class="title">Comparison over time <small> - World</small></h6>
	                                <p>Comparison of daily cases, death & recovered.</p>
	                            </div>
	                        </div>
	                        <div class="nk-cov-wg6">
	                            <div class="nk-cov-wg6-ck-lg">
	                                <canvas class="covid-case-line-chart" id="worldSpread"></canvas>
	                            </div>
	                            <div class="chart-label-group ml-5">
	                                <div class="chart-label">{{ $graphs['world_timeline']->first }}</div>
	                                <div class="chart-label">{{ $graphs['world_timeline']->last }}</div>
	                            </div>
	                            <ul class="nk-cov-wg6-legend mb-n1">
	                                <li>
	                                    <div class="dot dot-md sq bg-primary"></div>
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
	                        </div>
	                    </div>
	                </div>
	            </div>{{-- .col --}}
	            <div class="col-xl-12">
	                <div class="card card-bordered card-full">
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
	                    </div>{{-- .card-inner --}}
	                </div>{{-- .card --}}
	            </div>{{-- .col --}}
	        </div>{{-- .row --}}
	    </div>{{-- .col --}}
	</div>{{-- .row --}}
</div>
@endif
@endsection

@push('footer')
@if(!empty($countries))
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
        };
</script>
@endif
@endpush