@extends('layout.base')
@section('title', 'Symptoms')
@section('content')

<div class="nk-block-head nk-block-head-sm">
    <div class="nk-block-between flex-wrap g-1 align-start">
        <div class="nk-block-head-content">
            <h5 class="nk-block-title">COVID-19 Coronavirus - Symptoms</h5>
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
                        <h4 class="title text-primary">Symptoms of Coronavirus</h4>
                        <p>The most common symptoms of COVID-19 are <strong>fever, tiredness, and dry cough</strong>. Some patients may have aches and pains, nasal congestion, runny nose, sore throat or diarrhea. These symptoms are usually mild and begin gradually. Also the <strong>symptoms may appear 2-14 days</strong> after exposure.</p>
                        <h4 class="title">Major & Common Symptoms</h4>
                        <div class="nk-cov-feature-group pt-3 pb-3">
                            <div class="nk-cov-feature">
                                <div class="image">
                                    <img src="{{ asset('images/gfx/covid-symptom-fever.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h5 class="title">Fever</h5>
                                    <p><strong>High Fever</strong> – this means you feel hot to touch on your chest or back (you do not need to measure your temperature). It is a common sign & also may appear in 2-10 days if affected.</p>
                                </div>
                            </div>
                            <div class="nk-cov-feature">
                                <div class="image">
                                    <img src="{{ asset('images/gfx/covid-symptom-cough.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h5 class="title">Cough</h5>
                                    <p><strong>Continuous cough</strong> – this means coughing a lot for more than an hour, or 3 or more coughing episodes in 24 hours (if you usually have a cough, it may be worse than usual).</p>
                                </div>
                            </div>
                            <div class="nk-cov-feature">
                                <div class="image">
                                    <img src="{{ asset('images/gfx/covid-symptom-breath.png') }}" alt="">
                                </div>
                                <div class="content">
                                    <h5 class="title">Shortness of breath</h5>
                                    <p><strong>Difficulty breathing</strong> – Around 1 out of every 6 people who gets COVID-19 becomes seriously ill and develops difficulty breathing or shortness of breath.</p>
                                </div>
                            </div>
                        </div>
                        <div class="gap gap-md"></div>
                        <h5 class="title">Others Symptoms</h5>
                        <p>Some patients may have aches and pains, nasal congestion, runny nose, sore throat or diarrhea. These symptoms are usually mild & begin gradually. Some people become infected but don’t develop any symptoms & don't feel unwell. Most people (about 80%) recover from the disease without needing special treatment.</p>
                        <p>Around 1 out of every 6 people who gets COVID-19 becomes seriously ill and develops difficulty breathing. Older people, and those with underlying medical problems like high blood pressure, heart problems or diabetes, are more likely to develop serious illness.</p>
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
                <h5 class="text-primary">Symptoms and what to do</h5>
                <p class="text-danger"><strong>You must do not leave your home</strong> if you have any of <strong>coronavirus symptoms</strong> (a high temperature or a new, continuous cough) call your medical service.</p>
                <h6 class="text-primary">Stay at home to stop coronavirus spreading</h6>
                <p>Everyone must stay at home to help stop the spread of coronavirus. You should only leave the house for very limited purposes:</p>
                <ul class="list">
                    <li>shopping for basic necessities, for example food and medicine, which must be as important.</li>
                    <li>one form of exercise a day, for example a run, walk, or cycle – alone or with members of your household</li>
                    <li>any medical need, including to donate blood, avoid or escape risk of injury or harm, or to provide care or to help a vulnerable person.</li>
                    <li>travelling for work purposes, but only where you cannot work from home.</li>
                </ul>
            </div>
            <h5 class="title mt-5 mb-3">Quick Links</h5>
            <ul class="gy-3">
                <li><a href="{{ route('faq') }}" class="link link-block link-between"><span>Q&A on Coronaviruses</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                <li><a href="{{ route('prevent') }}" class="link link-block link-between"><span>Prevention of Coronavirus</span><em class="icon ni ni-arrow-long-right"></em></a></li>
                <li><a href="https://www.who.int/emergencies/diseases/novel-coronavirus-2019" target="_blank" class="link link-block link-between"><span>Learn more on who.int</span><em class="icon ni ni-arrow-long-right"></em></a></li>
            </ul>
        </div>{{-- .col --}}
    </div>{{-- .row --}}
</div>{{-- .nk-block --}}

@endsection