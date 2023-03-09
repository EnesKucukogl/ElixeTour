@extends('layout.mainlayout')
@section('content')
    <!-- Common Banner Area -->
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>{{ __('About us') }}</h2>
                        <ul>
                            <li><a href="{{route("home")}}">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span> {{ __('About us') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us -->
    <section id="about_us_top" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="about_us_left">

                        <h5><img src="{{URL::asset('/img/favicon.png')}}" width="30px" alt="">{{ __('About us') }}</h5>
                        <h2>Elixe Tour</h2>
                        <p>{{ __('We serve our guests and their companions from all over the world in our modern centers that offer the best applications in different fields in natural hot springs. We also meet the accommodation demands of our guests for treatment or vacation in Turkey s leading thermal tourism, spa and wellness hotels. ') }}</p>
                        <p>{{ __('For physical therapy and rehabilitation applications, we provide both treatment and accommodation services for our guests at our centers in Izmir and Bursa. We offer treatments and solutions in many different fields such as cardiology, radiology, internal medicine, orthopedics, aesthetic and plastic surgery, gynecology and obstetrics, oral and dental health, psychiatry, aesthetic varicose veins treatments, medical aesthetics, hair transplantation, nutrition and diet, alternative medicine.') }}</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="about_us_right">
                        <img src="{{URL::asset('/img/elixeabout.png')}}" alt="img">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="about_us_left">
                    <p>{{ __('Elixe Tour aims to improve the quality of life of our guests and members. For this reason, innovative technology and up-to-date medical practices are offered to our guests and their companions in Izmir, the pearl of the Aegean and Green Bursa, accompanied by an extraordinary natural beauty, providing them with a first-class experience.') }} </p>
                    <p>{{ __('Mest Group transfers its experience gained in health tourism operations in 4 continents to holiday, cultural and business tourism through Elixe Tour. In addition to traditional services such as flight tickets, hotel reservations, car rental, all services in all areas of tourism are gathered under one roof. Following the new trends in the developing dynamic tourism industry, Elixe Tour provides services by focusing on member satisfaction with its expert and experienced team.') }}</p>
                </div>
            </div>
        </div>
    </section>
@endsection

