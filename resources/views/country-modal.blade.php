@php 

    $data = (object)[
        'name'     => (isset($country['country']['name'])) ? $country['country']['name'] : '',
        'cases'     => (isset($country['cases'])) ? number_format($country['cases']) : 0,
        'death'     => (isset($country['death'])) ? number_format($country['death']) : 0,
        'todayCases' => (isset($country['today']['cases'])) ? number_format($country['today']['cases']) : 0,
        'todayDeath' => (isset($country['today']['death'])) ? number_format($country['today']['death']) : 0,
        'todayRecovered' => (isset($country['today']['recovered'])) ? number_format($country['today']['recovered']) : 0,
        'recovered' => (isset($country['recovered'])) ? number_format($country['recovered']) : 0,
        'active' => (isset($country['active'])) ? number_format($country['active']) : 0,
        'mild' => (isset($country['mild'])) ? number_format($country['mild']) : 0,
        'critical' => (isset($country['critical'])) ? number_format($country['critical']) : 0,
        'rateDeath' => (isset($country['cases']) && $country['death'] && $country['cases']) ? round((($country['death'] * 100) / $country['cases']), 2) : 0,
        'rateRecover' => (isset($country['cases']) && $country['recovered'] && $country['cases']) ? round((($country['recovered'] * 100) / $country['cases']), 2) : 0,
        'rateActive' => (isset($country['cases']) && $country['active'] && $country['cases']) ? round((($country['active'] * 100) / $country['cases']), 2) : 0,
        'rateMild' => (isset($country['active']) && $country['mild'] && $country['active']) ? round((($country['mild'] * 100) / $country['active']), 2) : 0,
        'rateCritical' => (isset($country['active']) && $country['critical'] && $country['active']) ? round((($country['critical'] * 100) / $country['active']), 2) : 0,
    ];

@endphp
<div class="modal fade country-modal" tabindex="-1" id="country-details">
    <div class="modal-dialog modal-lg" role="details">
        <div class="modal-content">
            <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross-sm"></em>
            </a>
            <div class="modal-body">
                @if($data)
                    <h5 class="modal-title mb-3">{{ $data->name }} - Coronavirus Cases</h5>
                    <div class="row justify-between g-gs">
                            
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card card-bordered card-full">
                                        <div  class="card-inner">
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title-alt fw-normal">Confirmed Cases</h6>
                                                <div class="amount amount-xs">{{ $data->cases }}<small>+{{ $data->todayCases }}</small></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card card-bordered card-full">
                                        <div  class="card-inner">
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title-alt fw-normal">Total Deaths</h6>
                                                <div class="amount amount-xs text-danger">{{ $data->death }}<small>+{{ $data->todayDeath }}</small></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card card-bordered card-full">
                                        <div  class="card-inner">
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title-alt fw-normal">Total Recovered</h6>
                                                <div class="amount amount-xs text-success">{{ $data->recovered }}<small>+{{ $data->todayRecovered }}</small></div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>                               
                                <div class="col-lg-3 col-sm-6">
                                    <div class="card card-bordered card-full">
                                        <div  class="card-inner">
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title-alt fw-normal">TOTAL VACCINATED</h6>

                                                <div class="amount amount-xs text-purple">{{ $vaccine }}</div>

                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                                                 
                        {{--
                        <div class="col-lg-6">
                            <div class="nk-cov-data">
                                <h6 class="lead-text text-base">Total Confirmed Cases</h6>
                                <div class="amount">{{ $data->cases }}</div>
                            </div>
                            <div class="row g-2 pt-2 pt-sm-3">
                                <div class="col-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">Deaths</h6>
                                        <div class="amount amount-xs text-danger">{{ $data->death }} <small>{{ $data->rateDeath }}%</small></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">Recovered</h6>
                                        <div class="amount amount-xs text-success">{{ ($data->recovered) ? $data->recovered : 'N/A' }} <small>{{ $data->rateRecover }}%</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="nk-cov-data">
                                <h6 class="lead-text text-base">Currently Active Cases</h6>
                                <div class="amount fw-normal">{{ $data->active }}</div>
                            </div>
                            <div class="row g-2 pt-2 pt-sm-3">
                                <div class="col-sm-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">in Mild Condition</h6>
                                        <div class="amount amount-xs text-purple">{{ $data->mild }} <small>{{ $data->rateMild }}%</small></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">Serious or Critical</h6>
                                        <div class="amount amount-xs text-warning">{{ $data->critical }} <small>{{ $data->rateCritical }}%</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        --}}
                    </div>
                    <div class="row justify-between g-gs">
                        <div class="col-lg-3 col-sm-6">
                                    <div class="card card-bordered card-full">
                                        <div  class="card-inner">
                                            <div class="nk-cov-data">
                                                <h6 class="overline-title-alt fw-normal">Active Cases</h6>
                                                <div class="amount amount-xs text-purple">{{ $data->active }}</div>
                                                
                                            </div>
                                        </div>
                                    </div>
                        </div> 
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-bordered card-full">
                                <div  class="card-inner">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">Death Rate</h6>
                                        <div class="amount amount-xs text-danger">{{ $data->rateDeath }}% </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-bordered card-full">
                                <div  class="card-inner">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">in Mild Condition</h6>
                                        <div class="amount amount-xs text-primary">{{ $data->mild }} <small>{{ $data->rateMild }}%</small></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6">
                            <div class="card card-bordered card-full">
                                <div  class="card-inner">
                                    <div class="nk-cov-data">
                                        <h6 class="overline-title-alt fw-normal">IN SERIOUS CONDITION</h6>
                                        <div class="amount amount-xs text-warning">{{ $data->critical }}<small>{{ $data->rateCritical }}%</small> </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>    
                    {{-- .row --}}
                    @if(!empty($graphs['timeline']->data))
                    <h6 class="title mt-4 mt-sm-5 mb-3">Total cases over time</h6>
                    <div class="card card-bordered">
                        <ul class="nav nav-tabs nav-tabs-card is-medium">
                            <li class="nav-item"><a href="#totalCase" data-toggle="tab" class="nav-link active">Cases</a></li>
                            <li class="nav-item"><a href="#totalDeaths" data-toggle="tab" class="nav-link">Deaths</a></li>
                            <li class="nav-item"><a href="#totalRecover" data-toggle="tab" class="nav-link">Recovered</a></li>
                            <li class="nav-item"><a href="#totalCompare" data-toggle="tab" class="nav-link">Compare</a></li>
                        </ul>
                        <div class="card-inner">
                            <div class="tab-content">
                                <div class="tab-pane active" id="totalCase">
                                    <h6 class="lead-text">Total Cases in Linear Scale</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-line-chart" id="totalTimelineCases"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                        <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="totalDeaths">
                                    <h6 class="lead-text">Total Deaths in Linear Scale</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-line-chart" id="totalTimelineDeaths"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                        <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="totalRecover">
                                    <h6 class="lead-text">Total Recover in Linear Scale</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-line-chart" id="totalTimelineRecovered"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                        <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="totalCompare">
                                    <h6 class="lead-text">Total Compare in Linear Scale</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-line-chart" id="totalTimelineCompare"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['timeline']->first }}</div>
                                        <div class="chart-label">{{ $graphs['timeline']->last }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>{{-- .card --}}
                    @endif

                    @if(!empty($graphs['daily']->data))
                    <h6 class="title mt-4 mt-sm-5 mb-3">Daily new cases over time</h6>
                    <div class="card card-bordered">
                        <ul class="nav nav-tabs nav-tabs-card is-medium">
                            <li class="nav-item"><a href="#dailyCase" data-toggle="tab" class="nav-link active">Cases</a></li>
                            <li class="nav-item"><a href="#dailyDeaths" data-toggle="tab" class="nav-link">Deaths</a></li>
                            <li class="nav-item"><a href="#dailyRecover" data-toggle="tab" class="nav-link">Recovered</a></li>
                            <li class="nav-item"><a href="#dailyCompare" data-toggle="tab" class="nav-link">Compare</a></li>
                        </ul>
                        <div class="card-inner">
                            <div class="tab-content">
                                <div class="tab-pane active" id="dailyCase">
                                    <h6 class="lead-text">Daily new cases per day</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-bar-chart" id="dailyBaseCases"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                        <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="dailyDeaths">
                                    <h6 class="lead-text">Daily new deaths per day</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-bar-chart" id="dailyBaseDeaths"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                        <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="dailyRecover">
                                    <h6 class="lead-text">Daily new recovered per day</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-bar-chart" id="dailyBaseRecovered"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                        <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="dailyCompare">
                                    <h6 class="lead-text">Compare new cases, death and recovered.</h6>
                                    <div class="nk-cov-modal-ck">
                                        <canvas class="country-bar-chart" id="dailyBaseCompare"></canvas>
                                    </div>
                                    <div class="chart-label-group ml-5">
                                        <div class="chart-label">{{ $graphs['daily']->first }}</div>
                                        <div class="chart-label">{{ $graphs['daily']->last }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>{{-- .card --}}
                    @endif

                    @if(!empty($graphs['timeline']->data) || !empty($graphs['daily']->data))
                    <script type="text/javascript">
                        !(function (NioApp, $) {
                            var totalLabel = [{!! $graphs['timeline']->labels !!}],
                                totalTimelineCases = {
                                labels : totalLabel,
                                dataUnit : 'People',
                                lineTension : 0.1,
                                steps: {{ (round(($graphs['timeline']->max['cases'] / 10), 0)) ? round(($graphs['timeline']->max['cases'] / 10), 0) : 1 }},
                                datasets : [{
                                    label : "Confirmed",
                                    color : "#0971fe",
                                    background: 'transparent',
                                    data: [{!! $graphs['timeline']->data['cases'] !!}]
                                }]
                            },
                            totalTimelineDeaths = {
                                labels : totalLabel,
                                dataUnit : 'People',
                                lineTension : 0.1,
                                steps:  {{ (round(($graphs['timeline']->max['deaths'] / 10), 0)) ? round(($graphs['timeline']->max['deaths'] / 10), 0) : 1 }},
                                datasets : [{
                                    label : "Deaths",
                                    color : "#f6525e",
                                    background: 'transparent',
                                    data: [{!! $graphs['timeline']->data['deaths'] !!}]
                                }]
                            },
                            totalTimelineRecovered = {
                                labels : totalLabel,
                                dataUnit : 'People',
                                lineTension : 0.1,
                                steps: {{ (round(($graphs['timeline']->max['recovered'] / 10), 0)) ? round(($graphs['timeline']->max['recovered'] / 10), 0) : 1 }},
                                datasets : [{
                                    label : "Recovered",
                                    color : "#1ee0ac",
                                    background: 'transparent',
                                    data: [{!! $graphs['timeline']->data['recovered'] !!}]
                                }]
                            },
                            totalTimelineCompare = {
                                labels : totalLabel,
                                dataUnit : 'People',
                                lineTension : 0.1,
                                steps: {{ (round(($graphs['timeline']->max['cases'] / 10), 0)) ? round(($graphs['timeline']->max['cases'] / 10), 0) : 1 }},
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

                            dailyLabel = [{!! $graphs['daily']->labels !!}],

                            dailyBaseCases = {
                                labels : dailyLabel,
                                dataUnit : 'People',
                                stacked: false,
                                steps: {{ (round(($graphs['daily']->max['cases'] / 10), 0)) ? round(($graphs['daily']->max['cases'] / 10), 0) : 1 }},
                                datasets : [{ label : "Confirmed", color : "#0971fe", background: '#0971fe', data: [{!! $graphs['daily']->data['cases'] !!}] }]
                            },
                            dailyBaseDeaths = {
                                labels : dailyLabel,
                                dataUnit : 'People',
                                stacked: false,
                                steps: {{ (round(($graphs['daily']->max['deaths'] / 10), 0)) ? round(($graphs['daily']->max['deaths'] / 10), 0) : 1 }},
                                datasets : [{ label : "Deaths", color : "#f6525e", background: '#f6525e', data: [{!! $graphs['daily']->data['deaths'] !!}] }]
                            },
                            dailyBaseRecovered = {
                                labels : dailyLabel,
                                dataUnit : 'People',
                                stacked: false,
                                steps: {{ (round(($graphs['daily']->max['recovered'] / 10), 0)) ? round(($graphs['daily']->max['recovered'] / 10), 0) : 1 }},
                                datasets : [{ label : "Recovered", color : "#1ee0ac", background: '#1ee0ac', data: [{!! $graphs['daily']->data['recovered'] !!}] }]
                            },
                            dailyBaseCompare = {
                                labels : dailyLabel,
                                dataUnit : 'People',
                                stacked: true,
                                steps: {{ (round(($graphs['daily']->max['cases'] / 10), 0)) ? round(($graphs['daily']->max['cases'] / 10), 0) : 1 }},
                                datasets : [{ label : "Confirmed", color : "#0971fe", background: '#0971fe', data: [{!! $graphs['daily']->data['cases'] !!}] }, 
                                            { label : "Deaths", color : "#f6525e", background: '#f6525e', data: [{!! $graphs['daily']->data['deaths'] !!}] }, 
                                            { label : "Recovered", color : "#1ee0ac", background: '#1ee0ac', data: [{!! $graphs['daily']->data['recovered'] !!}] }]
                            };
                            var $lineChart = $('.country-line-chart'), $barChart = $('.country-bar-chart');

                            if($lineChart.length > 0) {
                                $lineChart.each(function(){
                                    data_id = $(this).attr('id'), data = eval(data_id);
                                    NioApp.lineCovidCase($(this), data);
                                });
                            }
                            if($barChart.length > 0) {
                                $barChart.each(function(){
                                    data_id = $(this).attr('id'), data = eval(data_id);
                                    NioApp.barCovidcase($(this), data);
                                });
                            }
                        })(NioApp, jQuery);
                    </script>
                    @endif
                @else 
                    <h5 class="modal-title mt-5 mb-5 text-center">Not enough data to display.</h5>
                @endif
            </div>{{-- .modal-body --}}
        </div>{{-- .modal-content --}}
    </div>{{-- .modal-dialog --}}
</div>