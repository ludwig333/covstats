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