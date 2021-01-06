@extends('layout.base')
@section('title', 'Prevention')
@section('content')


<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between flex-wrap g-1 align-start">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">COVID-19 Coronavirus - Prevention</h5>
            <p>There’s currently no vaccine to prevent coronavirus disease (COVID-19).</p>
        </div>
        <div class="nk-block-head-content">
            <a href="{{ route('home') }}" class="link"><span>Check Situation</span> <em class="icon ni ni-arrow-long-right"></em></a>
        </div>
    </div>
</div>{{-- .nk-block-head --}}
<div class="nk-block">
    <div class="row g-5">
        <div class="col-xl-8">
            <div class="card card-bordered">
                <div class="card-inner card-inner-lg">
                    <div class="alert-alt alert-danger alert-icon">
                        <em class="icon ni ni-help-alt"></em> <strong>If you develop a fever, cough, and have difficulty breathing, promptly seek medical care. <br class="d-none d-lg-block"> Call in advance and tell your health provider as soon as possible for medical advice.</strong>
                    </div>
                    <div class="entry mt-4 pt-1">
                        <h4 class="title text-primary">How to Protect Yourself?</h4>
                        <p><strong>The best way to prevent illness is to avoid being exposed to this virus. </strong>As there is not vaccine to prevent so you can protect yourself and help prevent spreading the virus to others if you do as below instruction.</p>
                        <div class="gap gap-md"></div>
                        <div class="nk-cov-feature-group">
                            <div class="nk-cov-feature">
                                <div class="image image-lg is-alt">
                                    <img src="{{ asset('images/gfx/covid-prevent-washing.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h5 class="title">Wash your hands frequently</h5>
                                    <p>Regularly and thoroughly clean your hands with an alcohol-based hand rub or wash them with soap and water for at least 20 seconds.</p>
                                    <p><strong>Why?</strong> Washing your hands with soap and water or using alcohol-based hand rub kills viruses that may be on your hands.</p>
                                </div>
                            </div>
                            <div class="nk-cov-feature">
                                <div class="image image-lg is-alt">
                                    <img src="{{ asset('images/gfx/covid-prevent-distance.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h5 class="title">Maintain social distancing</h5>
                                    <p>Maintain at least 1 metre (3 feet) distance between yourself & anyone who is coughing or sneezing. If you are too close, get chance to infected.</p>
                                    <p><strong>Why?</strong> When someone coughs or sneezes they spray small liquid droplets from their nose or mouth which may contain virus. If you are too close, you can breathe in the droplets, including the COVID-19 virus if the person coughing has the disease.</p>
                                </div>
                            </div>
                            <div class="nk-cov-feature">
                                <div class="image image-lg is-alt">
                                    <img src="{{ asset('images/gfx/covid-prevent-touch.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h5 class="title">Avoid touching face</h5>
                                    <p>Do not touch your eyes, nose or mouth if your hands are not clean.</p>
                                    <p><strong>Why?</strong> Hands touch many surfaces and can pick up viruses. Once contaminated, hands can transfer the virus to your eyes, nose or mouth. From there, the virus can enter your body and can make you sick.</p>
                                </div>
                            </div>
                            <div class="nk-cov-feature">
                                <div class="image image-lg is-alt">
                                    <img src="{{ asset('images/gfx/covid-prevent-hygiene.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h5 class="title">Practice respiratory hygiene</h5>
                                    <p>Make sure you, & the people around you, follow good respiratory hygiene. This means covering your mouth & nose with your bent elbow or tissue when you cough or sneeze.</p>
                                    <p><strong>Why?</strong> Droplets spread virus. By following good respiratory hygiene you protect the people around you from viruses such as cold, flu and COVID-19.</p>
                                </div>
                            </div>
                        </div>
                        <p class="sub-text mt-5">These are for informational purposes only. Consult your local medical authority for advice. (Source: World Health Organization)</p>
                    </div>
                </div>
            </div>
        </div>{{-- .col --}}
        <div class="col-xl-4">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/bPITHEiFWLc?rel=0" allowfullscreen></iframe>
            </div>
            <div class="entry mt-4 pt-1">
                <h5 class="text-primary">Take steps to protect others</h5>
                <p>There are things you can do to help reduce the risk of you and anyone you live with getting ill with virus.</p>
                <ul class="list list-lg list-checked-circle list-success">
                    <li><strong>Stay home if you’re sick</strong> – Stay home if you are sick, except to get medical care.</li>
                    <li><strong>Cover your mouth &amp; nose</strong> – with a tissue when you cough or sneeze.</li>
                    <li><strong>Wear a facemask if you are sick</strong> – You should wear a facemask when you are around other people (e.g., sharing a room or vehicle) and before you enter a healthcare provider’s office.</li>
                    <li><strong>Clean AND disinfect frequently touched surfaces daily</strong> – This includes phones, tables, doorknobs, light switches, handles, desktops, countertops, toilets etc.</li>
                    <li><strong>Stay informed about the local COVID-19 situation</strong> – Get up-to-date information about local COVID-19 activity from <a href="#">public health officials.</a></li>
                </ul>
            </div>
            <h5 class="title mt-5 mb-3">Quick Links</h5>
            <ul class="gy-3">
                <li><a href="{{ route('faq') }}" class="link link-block link-between"><span>Q&A on Coronaviruses</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                <li><a href="{{ route('symptom') }}" class="link link-block link-between"><span>Symptoms of Coronavirus</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                <li><a href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019" target="_blank" class="link link-block link-between"><span>Learn more on who.int</span><em class="icon ni ni-arrow-long-right"></em></a></li>
            </ul>
        </div>{{-- .col --}}
    </div>{{-- .row --}}
</div>{{-- .nk-block --}}

@endsection