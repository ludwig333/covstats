<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Coronavirus (COVID-19) live statistics and tracking the number of confirmed cases, recovered patients, and death toll.">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <title>Coronavirus Update</title>
    <link rel="stylesheet" href="{{ asset('assets/css/covstats.css?ver=100') }}">
    @yield('style')
</head>
<body class="nk-body npc-covid ui-clean ui-rounder dark-mode">
    <div class="nk-app-root">
        <div class="nk-main">

			<div class="nk-sidebar nk-sidebar-short nk-sidebar-fixed" data-content="sidebarMenu">
                <div class="nk-sidebar-element nk-sidebar-head">
                    <div class="nk-sidebar-brand">
                        <a href="{{ route('home') }}" class="logo-link nk-sidebar-logo">
                            <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo2x.png 2x') }}" alt="">
                            <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.png') }}" srcset="{{ asset('images/logo-dark2x.png 2x') }}" alt="">
                        </a>
                        <a href="{{ route('home') }}" class="logo-link nk-sidebar-logo-small">
                            <img class="logo-light logo-img" src="{{ asset('images/logo-small.png') }}" srcset="{{ asset('images/logo-small2x.png 2x') }}" alt="">
                            <img class="logo-dark logo-img" src="{{ asset('images/logo-dark-small.png') }}" srcset="{{ asset('images/logo-dark-small2x.png 2x') }}" alt="">
                        </a>
                    </div>
                    <div class="nk-menu-trigger mr-n2">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
                    </div>
                </div>{{-- .nk-sidebar-element --}}
                <div class="nk-sidebar-element">
                    <div class="nk-sidebar-body" data-simplebar>
                        <div class="nk-sidebar-content">
                            <div class="nk-sidebar-menu nk-sidebar-menu-middle">
                                {{-- Menu --}}
                                <ul class="nk-menu short-menu">
                                    <li class="nk-menu-item">
                                        <a href="{{ route('home') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-notify"></em></span>
                                            <span class="nk-menu-text">Overview</span>
                                            <span class="nk-menu-tooltip" title="Overview"></span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('countries') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-globe"></em></span>
                                            <span class="nk-menu-text">Countries</span>
                                            <span class="nk-menu-tooltip" title="Countries"></span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('symptom') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-sun"></em></span>
                                            <span class="nk-menu-text">Symptoms</span>
                                            <span class="nk-menu-tooltip" title="Symptoms"></span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('prevent') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-security"></em></span>
                                            <span class="nk-menu-text">Prevention</span>
                                            <span class="nk-menu-tooltip" title="Prevention"></span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="{{ route('faq') }}" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-help"></em></span>
                                            <span class="nk-menu-text">FAQs</span>
                                            <span class="nk-menu-tooltip" title="FAQs"></span>
                                        </a>
                                    </li>
                                </ul>{{-- .nk-menu --}}
                            </div>{{-- .nk-sidebar-menu --}}
                            <div class="nk-sidebar-footer d-none d-md-block" style="background: #101924 !important;">
                                <ul class="nk-menu short-menu">
                                    <li class="nk-menu-item">
                                        <a href="#" data-toggle="modal" data-target="#about-app" class="nk-menu-link">
                                            <span class="nk-menu-icon"><em class="icon ni ni-info-fill"></em></span>
                                            <span class="nk-menu-text">About Data</span>
                                        </a>
                                    </li>
                                </ul>{{-- .nk-menu --}}
                            </div>{{-- .nk-sidebar-footer --}}
                        </div>{{-- .nk-sidebar-contnet --}}
                    </div>{{-- .nk-sidebar-body --}}
                </div>{{-- .nk-sidebar-element --}}
            </div>

            {{-- wrap @s --}}
            <div class="nk-wrap ">
                {{-- main header @s --}}
                <div class="nk-header nk-header-fluid nk-header-fixed nk-header-onlymobile is-light">
                    <div class="container-fluid">
                        <div class="nk-header-wrap">
                            <div class="nk-header-brand">
                                <a href="index.html" class="logo-link">
                                    <img class="logo-light logo-img" src="{{ asset('images/logo.png') }}" srcset="{{ asset('images/logo2x.png 2x') }}" alt="">
                                    <img class="logo-dark logo-img" src="{{ asset('images/logo-dark.png') }}" srcset="{{ asset('images/logo-dark2x.png 2x') }}" alt="">
                                </a>
                            </div>
                            <div class="nk-menu-trigger ml-auto mr-n1">
                                <a href="#" class="nk-nav-toggle nk-quick-nav-icon" data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- main header @e --}}
                {{-- content @s --}}
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-body">
 							
 							@yield('content')

                        </div>
                    </div>
                </div>
                {{-- content @e --}}
                {{-- footer @s --}}
                <div class="nk-footer d-md-none">
                    <div class="container-fluid">
                        <div class="nk-footer-wrap gy-1 gx-4">
                            <div class="nk-footer-links">
                                <ul class="nav nav-sm">
                                    <li class="nav-item"><a class="nav-link" href="#" data-toggle="modal" data-target="#about-app">About Data</a></li>
                                </ul>
                            </div>
                            <div class="nk-footer-copyright"> &copy; {{ date('Y') }}, Powered by <a href="https://softnio.com" target="_blank">Softnio</a></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- footer @e --}}
            </div>
            {{-- wrap @e --}}
 		</div>
	</div>
    <div class="modal fade" tabindex="-1" id="about-app">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
                <div class="modal-body">
                    <h6 class="lead-text text-primary">It changes rapidly</h6>
                    <p>This data changes rapidly, so what’s shown may be out of date. Table totals may not always represent an accurate sum. Information about reported cases is also available on the <a href="https://covid19.who.int/" target="_blank">World Health Organization</a> & <a href="https://www.worldometers.info/coronavirus/" target="_blank">WorldoMeters.info</a> site. Also historical data based on <a href="https://systems.jhu.edu/research/public-health/ncov/" target="_blank">JHU CSSE</a>.</p>
                    <h6 class="lead-text text-primary">It doesn’t include all cases</h6>
                    <p>Confirmed cases aren’t all cases. They only include people who tested positive. Testing rules and availability vary by country.</p>
                    <div class="note-text">Updated: {{ $last_update }}</div>
                </div>
                <div class="modal-footer bg-light justify-content-center py-1">
                    <div class="sub-text">Powered by <a href="https://softnio.com" target="_blank">Softnio</a></div>
                </div>
            </div>
        </div>
    </div>
    @stack('modals')
    <div id="ajax-modal"></div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="{{ asset('assets/js/bundle.js?ver=100') }}"></script>
	<script src="{{ asset('assets/js/scripts.js?ver=100') }}"></script>

    @stack('footer')
</body>
</html>