@extends('layout.mainlayout')
@section('content')
    <!-- Banner Area -->
    <section id="home_one_banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="banner_one_text">
                        <h1>Explore the country<br>together</h1>
                        <h3>Find awesome hotels, tours and treatment packages</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Form Area
    <section id="theme_search_form">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="theme_search_form_area">
                        <div class="theme_search_form_tabbtn">
                            <ul class="nav nav-tabs" role="tablist">

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="hotels-tab" data-bs-toggle="tab"
                                        data-bs-target="#hotels" type="button" role="tab" aria-controls="hotels"
                                        aria-selected="false"><i class="fas fa-globe"></i>Hotels</button>
                                </li>

                            </ul>
                        </div>

                        <div class="tab-pane fade show active" id="hotels" role="tabpanel" aria-labelledby="hotels-tab">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="tour_search_form">
                                        <form action="#!">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                    <div class="flight_Search_boxed">
                                                        <p>Destination</p>
                                                        <input type="text" placeholder="Where are you going?">
                                                        <span>Where are you going?</span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                                                    <div class="form_search_date">
                                                        <div class="flight_Search_boxed date_flex_area">
                                                            <div class="Journey_date">
                                                                <p>Journey date</p>
                                                                <input type="date" value="2022-05-03">
                                                                <span>Thursday</span>
                                                            </div>
                                                            <div class="Journey_date">
                                                                <p>Return date</p>
                                                                <input type="date" value="2022-05-05">
                                                                <span>Thursday</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2  col-md-6 col-sm-12 col-12">
                                                    <div class="flight_Search_boxed dropdown_passenger_area">
                                                        <p>Passenger, Class </p>
                                                        <div class="dropdown">
                                                            <button class="dropdown-toggle final-count"
                                                                data-toggle="dropdown" type="button"
                                                                id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                                                aria-expanded="false">
                                                                0 Passenger
                                                            </button>
                                                            <div class="dropdown-menu dropdown_passenger_info"
                                                                aria-labelledby="dropdownMenuButton1">
                                                                <div class="traveller-calulate-persons">
                                                                    <div class="passengers">
                                                                        <h6>Passengers</h6>
                                                                        <div class="passengers-types">
                                                                            <div class="passengers-type">
                                                                                <div class="text"><span
                                                                                        class="count pcount">2</span>
                                                                                    <div class="type-label">
                                                                                        <p>Adult</p>
                                                                                        <span>12+
                                                                                            yrs</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="button-set">
                                                                                    <button type="button" class="btn-add">
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn-subtract">
                                                                                        <i class="fas fa-minus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="passengers-type">
                                                                                <div class="text"><span
                                                                                        class="count ccount">0</span>
                                                                                    <div class="type-label">
                                                                                        <p class="fz14 mb-xs-0">
                                                                                            Children
                                                                                        </p><span>2
                                                                                            - Less than 12
                                                                                            yrs</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="button-set">
                                                                                    <button type="button" class="btn-add-c">
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn-subtract-c">
                                                                                        <i class="fas fa-minus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="passengers-type">
                                                                                <div class="text"><span
                                                                                        class="count incount">0</span>
                                                                                    <div class="type-label">
                                                                                        <p class="fz14 mb-xs-0">
                                                                                            Infant
                                                                                        </p><span>Less
                                                                                            than 2
                                                                                            yrs</span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="button-set">
                                                                                    <button type="button"
                                                                                        class="btn-add-in">
                                                                                        <i class="fas fa-plus"></i>
                                                                                    </button>
                                                                                    <button type="button"
                                                                                        class="btn-subtract-in">
                                                                                        <i class="fas fa-minus"></i>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="cabin-selection">
                                                                        <h6>Cabin Class</h6>
                                                                        <div class="cabin-list">
                                                                            <button type="button" class="label-select-btn">
                                                                                <span class="muiButton-label">Economy
                                                                                </span>
                                                                            </button>
                                                                            <button type="button"
                                                                                class="label-select-btn active">
                                                                                <span class="muiButton-label">
                                                                                    Business
                                                                                </span>
                                                                            </button>
                                                                            <button type="button" class="label-select-btn">
                                                                                <span class="MuiButton-label">First
                                                                                    Class </span>
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <span>Business</span>
                                                    </div>
                                                </div>
                                                <div class="top_form_search_button">
                                                    <button class="btn btn_theme btn_md">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>-->


    <!--Related tour packages Area -->
    <section id="related_tour_packages" class="section_padding_top">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Treatments</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="promotional_tour_slider owl-theme owl-carousel dot_style">
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="prp.php"><img src="assets/img/ftr/kok-min.webp"
                                                   alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="prp.php">Prp (stem cell therapy)</a></h4>

                            </div>
                        </div>
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="hacamat.php"><img src="assets/img/ftr/hacamat-min.webp"
                                                       alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="hacamat.php">Cupping (hijama treatment)</a></h4>
                            </div>
                        </div>
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="ozon.php"><img src="assets/img/ftr/ozon-min.webp"
                                                    alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="ozon.php">Ozone Therapy</a></h4>
                            </div>
                        </div>
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="hydrotherapy.php"><img src="assets/img/ftr/hydrotherapy-min.webp"
                                                            alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="hydrotherapy.php">What is Hydrotherapy?</a></h4>
                            </div>
                        </div>
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="breath.php"><img src="assets/img/ftr/breath-min.webp"
                                                      alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="breath.php">What is Breathing Exercise?</a></h4>
                            </div>
                        </div>
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="bioenergy.php"><img src="assets/img/ftr/bioenergy-min.webp"
                                                         alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="bioenergy.php">What is Bioenergy?</a></h4>
                            </div>
                        </div>
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="acupuncture.php"><img src="assets/img/ftr/acupuncture-min.webp"
                                                           alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="acupuncture.php">What is Acapuntur?</a></h4>
                            </div>
                        </div>
                        <div class="top_destinations_box img_hover">
                            <div class="heart_destinations">
                                <i class="fas fa-heart"></i>
                            </div>
                            <a href="thermal-water.php"><img src="assets/img/ftr/thermal-min.webp"
                                                             alt="img"></a>
                            <div class="top_destinations_box_content">
                                <h4><a href="thermal-water.php">Benefits of Thermal Water?</a></h4>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- imagination Area -->
    <section id="go_beyond_area" class="section_padding_top">
        <div class="container" id="hotels-two">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12">
                    <div class="heading_left_area">
                        <h2>Go beyond your <br><span>imagination</span></h2>
                        <h5>Discover your ideal experience with us</h5>
                    </div>

                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-12">
                    <div class="row" style="justify-content: center;">


                        <div class="col-lg-5 col-md-6 col-sm-6 col-12">
                            <div class="theme_common_box_two img_hover">
                                <div class="theme_two_box_img">
                                    <a href="'#'">
                                        <img src="'#'" alt="img">
                                    </a>
                                    <p><i class="fas fa-map-marker-alt"></i>Deneme</p>
                                </div>
                                <div class="theme_two_box_content">
                                    <h4><a href="izmir-kaya.php">Deneme</a></h4>
                                    <p><span class="review_rating">Excellent</span></p>
                                    <h3>Deneme<span> Price starts from</span></h3>
                                </div>
                            </div>
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </section>











    <!--Promotional Tours Area -->
    <section id="promotional_tours" class="section_padding_top">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Our best treatments<br>packages</h2>
                    </div>
                </div>
            </div>

            <div class="row">


                <div class="col-lg-12">
                    <div class="promotional_tour_slider owl-theme owl-carousel dot_style">
                        @foreach ($package as $item)
                            @if($item->highlighted == 1)

                                @php

                                    $file_path = getImage($packageFile,$item->Id);
                                    $package_name = viewLanguageSupport($item->packageTextContent);
                                @endphp

                                <div class="theme_common_box_two img_hover">
                                    <div class="theme_two_box_img">
                                        <a href="{{$item->slug}}"><img src="{{$file_path}}" alt="img"></a>
                                        <p><i class="fas fa-map-marker-alt"></i>Package</p>
                                    </div>
                                    <div class="theme_two_box_content">
                                        <h4><a href="{{$item->slug}}">{{$package_name}}</a></h4>
                                        <p><span class="review_rating">{{$item->duration}} Days+</span></p>
                                        <h3>{{$item->price_currency_code."".$item->price}}<span>Price starts from</span></h3>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>



    <!--
    <section id="top_destinations" class="section_padding_top">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Thermal Tourism<br>in Turkey</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="justify-content: center;">
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="destinations_content_box img_animation">
                        <a href="packages.php">
                            <img src="assets/img/health/izmir-kaya-hotel-kapak.jpg" alt="img">
                        </a>
                        <div class="destinations_content_inner">
                            <h3><a href="packages.php">China</a></h3>
                        </div>
                    </div>
                    <div class="destinations_content_box img_animation">
                        <a href="packages.php">
                            <img src="assets/img/health/izmir-kaya-hotel-kapak.jpg" alt="img">
                        </a>
                        <div class="destinations_content_inner">
                            <h3><a href="packages.php">China</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/1-1-slider-1.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">China</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/4-3-slider-1.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">Darjeeling</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/1-1-slider-2.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">Malaysia</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/16-9-slider-1.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">Gangtok</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/1-1-slider-2.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">Thailand</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/1-1-slider-3.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">Australia</a></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/3-4-slider-1.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">London</a></h3>
                                </div>
                            </div>
                            <div class="destinations_content_box img_animation">
                                <a href="packages.php">
                                    <img src="assets/img/health/mtt-slider/3-4-slider-2.jpg" alt="img">
                                </a>
                                <div class="destinations_content_inner">
                                    <h3><a href="packages.php">USA</a></h3>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->


    <!-- Destinations Area
    <section id="destinations_area" class="section_padding_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Destinations for you</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <div class="theme_nav_tab">
                        <nav class="theme_nav_tab_item">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-nepal-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-nepal" type="button" role="tab" aria-controls="nav-nepal"
                                    aria-selected="true">İzmir</button>
                                <button class="nav-link" id="nav-malaysia-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-malaysia" type="button" role="tab" aria-controls="nav-malaysia"
                                    aria-selected="false">Bursa</button>
                                <button class="nav-link" id="nav-indonesia-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-indonesia" type="button" role="tab" aria-controls="nav-indonesia"
                                    aria-selected="false">Muğla</button>
                                <button class="nav-link" id="nav-turkey-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-turkey" type="button" role="tab" aria-controls="nav-turkey"
                                    aria-selected="false">Denizli</button>
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content" id="nav-tabContent1">
                        <div class="tab-pane fade show active" id="nav-nepal" role="tabpanel"
                            aria-labelledby="nav-nepal-tab">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="gallery1__wrapper slider-section-dots owl-carousel owl-theme">
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb efes" onclick="popups('efes',true)">
                                                <img class="lokasyon img_100" src="assets/new/kaya/locations/efes1.jpg"
                                                    alt="Gallery">
                                            </div>
                                        </div>

                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb pergamon" onclick="popups('pergamon',true)">
                                                <img class="lokasyon img_100" src="assets/new/kaya/locations/bergama1.jpg"
                                                    alt="Gallery">

                                            </div>

                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb cesme" onclick="popups('cesme',true)">
                                                <img class="lokasyon img_100" src="assets/new/kaya/locations/cesme1.jpg"
                                                    alt="Gallery">

                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50 meryemana" onclick="popups('meryemana',true)">
                                            <div class="gallery1__thumb">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/kaya/locations/meryem-ana-1.jpg" alt="Gallery">

                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">

                                            <div class="gallery1__thumb sirince" onclick="popups('sirince',true)">
                                                <img class="lokasyon img_100" src="assets/new/kaya/locations/sirince1.jpg"
                                                    alt="Gallery">

                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="nav-malaysia" role="tabpanel" aria-labelledby="nav-malaysia-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="gallery1__wrapper slider-section-dots owl-carousel owl-theme">
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb uludag" onclick="popups('uludag',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/kervansaray/locations/uludag1.jpg" alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb ulucami" onclick="popups('ulucami',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/kervansaray/locations/ulu-cami1.jpg" alt="Gallery">

                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb kentmuzesi" onclick="popups('kentmuzesi',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/kervansaray/locations/kent-muzesi1.jpg" alt="Gallery">

                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb tophane" onclick="popups('tophane',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/kervansaray/locations/tophane1.jpg" alt="Gallery">

                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb bazaar" onclick="popups('bazaar',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/kervansaray/locations/kapali-carsi1.jpg" alt="Gallery">

                                            </div>

                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-indonesia" role="tabpanel" aria-labelledby="nav-indonesia-tab">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="gallery1__wrapper slider-section-dots owl-carousel owl-theme">
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb sarsala" onclick="popups('sarsala',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/thermemaris/locations/sarsala1.jpg" alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb kaunos" onclick="popups('kaunos',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/thermemaris/locations/kaunos1.jpg" alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb sarigerme" onclick="popups('sarigerme',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/thermemaris/locations/sarigerme1.jpg" alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb dalamancayi" onclick="popups('dalamancayi',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/thermemaris/locations/dalaman-cayi1.jpg" alt="Gallery">

                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb koycegiz" onclick="popups('koycegiz',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/thermemaris/locations/koycegiz1.jpg" alt="Gallery">
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="tab-pane fade" id="nav-turkey" role="tabpanel" aria-labelledby="nav-turkey-tab">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="gallery1__wrapper slider-section-dots owl-carousel owl-theme">
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb pamukkale" onclick="popups('pamukkale',true)">
                                                <img class="lokasyon img_100" src="assets/new/doga/locations/pamukkale1.jpg"
                                                    alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb tripolis" onclick="popups('tripolis',true)">
                                                <img class="lokasyon img_100" src="assets/new/doga/locations/tripolis1.jpg"
                                                    alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb hierapolis" onclick="popups('hierapolis',true)">
                                                <img class="lokasyon img_100"
                                                    src="assets/new/doga/locations/hierapolis1.jpg" alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb laodikeia" onclick="popups('laodikeia',true)">
                                                <img class="lokasyon img_100" src="assets/new/doga/locations/laodikeia1.jpg"
                                                    alt="Gallery">
                                            </div>
                                        </div>
                                        <div class="gallery1__item mb-50">
                                            <div class="gallery1__thumb cleopatra" onclick="popups('cleopatra',true)">
                                                <img class="lokasyon img_100" src="assets/new/doga/locations/cleopatra1.jpg"
                                                    alt="Gallery">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

     |=====|| Pergamon ||=================|
    <div class="custom-model-main pergamon-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('pergamon',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kaya/locations/bergama1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Pergamon Antik Kenti</h2>
                        <p class="mb-2">Pergamon or Pergamum, also referred to by its modern Greek form Pergamos was a rich
                            and powerful ancient Greek city in Mysia. It is located 26 kilometres (16 mi) from the modern
                            coastline of the Aegean Sea on a promontory on the north side of the river Caicus (modern-day
                            Bakırçay) and northwest of the modern city of Bergama, Turkey.</p>
                        <p class="mb-2">During the Hellenistic period, it became the capital of the Kingdom of Pergamon in
                            281–133 BC under the Attalid dynasty, who transformed it into one of the major cultural centres
                            of the Greek world. Many remains of its monuments can still be seen and especially the
                            masterpiece of the Pergamon Altar. Pergamon was the northernmost of the seven churches of Asia
                            cited in the New Testament Book of Revelation.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/b55y5hzGxRHCcFLk7"
                                target="_blank"><span>View on Map</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('pergamon',false)"></div>
    </div>
     |=====|| Sirince ||=================|
    <div class="custom-model-main sirince-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('sirince',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kaya/locations/sirince1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Şirince</h2>
                        <p>Şirince, known as Kirkintzes in Greek, is a village of 600 inhabitants in İzmir Province, Turkey,
                            located about 8 kilometres (5.0 mi) east of the town Selçuk and about 8 kilometres from Ephesus.
                            The area around the village has history dating back to Hellenistic period (323–31 BC). Pottery
                            finds made around the village between 2001 and 2002 by Ersoy and Gurler indicate the presence of
                            seven villages and nine farmsteads in the area dating back to ancient and medieval times. On the
                            road up you will see the remains of several Roman aqueducts as the village was an important
                            water source for ancient Ephesus.</p>
                        <p>Today the village prospers through agriculture (olive oil, peaches, wine) and tourism. It is well
                            protected and a rare and attractive example of Ottoman Christian architecture.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/KCxxYvA1JKgSU8pA9"
                                target="_blank"><span>View on Map</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('sirince',false)"></div>
    </div>
     |=====|| Meryem Ana ||=================|
    <div class="custom-model-main meryemana-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('meryemana',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kaya/locations/meryem-ana-1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Virgin Mary</h2>
                        <p>Virgin Mary House is located on the Bülbül Mountain, 9 km from Selçuk. It is known that John
                            brought Virgin Mary to Ephesus 4 or 6 years after the death of Jesus. In 1891, the Lazarist
                            priests, upon the dream of the German nun A. Katherina Emerich, discovered that the house where
                            the Virgin Mary spent her last days was at the end of this research.</p>
                        <p>This event is a new invention in the world of Christianity and shed light on the world of
                            religion. This structure was cross-planned then restored. The house is considered sacred by
                            Muslims, Pope VI. After Paul's visit in 1967, the rites are held on the 15th day of August every
                            year, and these rituals attract great attention.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/8nvnS37DYX72BgzVA"
                                target="_blank"><span>View on Map</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('meryemana',false)"></div>
    </div>
     |=====|| efes ||=================|
    <div class="custom-model-main efes-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('efes',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kaya/locations/efes1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Ephesus</h2>
                        <p>The city was famous in its day for the nearby Temple of Artemis, which has been designated one of
                            the Seven Wonders of the Ancient World. Its many monumental buildings included the Library of
                            Celsus and a theatre capable of holding 24,000 spectators. Ephesus was recipient city of one of
                            the Pauline epistles; one of the seven churches of Asia addressed in the Book of Revelation; the
                            Gospel of John may have been written there; and it was the site of several 5th-century Christian
                            Councils (see Council of Ephesus). The city was destroyed by the Goths in 263. Although it was
                            afterwards rebuilt, its importance as a commercial centre declined as the harbour was slowly
                            silted up by the Küçükmenderes River.</p>
                        <p>Today, the ruins of Ephesus are a favourite international and local tourist attraction, being
                            accessible from Adnan Menderes Airport and from the resort town Kuşadası. In 2015, the ruins
                            were designated a UNESCO World Heritage Site.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/T2deEHoJEW8pvKL19"
                                target="_blank"><span>View on Map</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('efes',false)"></div>
    </div>
    |=====|| Çeşme ||=================|
    <div class="custom-model-main cesme-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('cesme',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kaya/locations/cesme1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Cesme</h2>
                        <p>The urban center and the port of the region in antiquity was at Erythrae (present-day Ildırı), in
                            another bay to the north-east of Çeşme. Most probably, the ancient Greek polis of Boutheia
                            (Βούθεια or Βουθία in ancient Greek) was situated in Çeşme. In the 5th century BC, Boutheia was
                            a dependency of Erythrae and paid tribute to Athens as a member of the Delian League.</p>
                        <p>After the Ottoman capture and through preference shown by the foreign merchants, the trade hub
                            gradually shifted to İzmir, which until then was touched only tangentially by the caravan routes
                            from the east, and the prominence of the present-day metropolis became more pronounced after the
                            17th century.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/fZxL6K5jHehUmVJA9"
                                target="_blank"><span>View on Map</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('cesme',false)"></div>
    </div>

     |=====|| Uludağ ||=================|
    <div class="custom-model-main uludag-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('uludag',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kervansaray/locations/uludag1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Uludağ</h2>
                        <p>The highest area in western Anatolia, Uludağ is easily ascended by car or cable-car. The park is
                            about 22 km (14 mi) south of Bursa and is signposted from there. Bursa can be reached by road
                            from Istanbul. The cable-car ascends from Bursa and has an intermediate stop in the alpine
                            meadows of Kadiyayla at about 1,200 m (3,937 ft) elevation. It ends at Sarialan at about 1,630 m
                            (5,348 ft).
                        </p>
                        <p>Habitats of the park range from maquis on the lower slopes, through deciduous woodland and beech
                            and fir forest to alpine meadows at the highest levels. It is a refuge for mountain birds, such
                            as lammergeier and other vultures, golden eagle and more than 20 other raptor species. The area
                            is also good for eastern specialities such as isabelline wheatear, and, at almost the most
                            westerly points of their range, red-fronted serin and Krüper's nuthatch.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/zHQYSnfVRnoyghc67"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('uludag',false)"></div>
    </div>
     |=====|| ulu mosque ||=================|
    <div class="custom-model-main ulucami-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('ulucami',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kervansaray/locations/ulu-cami1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Ulu Mosque</h2>
                        <p>The Ulu Camii or "Great Mosque" is the largest mosque in Bursa, the first capital of the Ottoman
                            Empire, and a landmark of early Ottoman architecture as it evolved out of Seljuk Turkish
                            architecture. Ordered by Sultan Bayezid I, the mosque was designed and built by architect Ali
                            Neccar in 1396-1399.</p>
                        <p> Bayezid I was the fourth ruler of the Ottoman Empire. Whatever the case, the first recorded
                            repairs to the mosque took place in 1493. The mosque underwent further restorations across its
                            history. Following a damaging earthquake in 1855 which caused the roof to collapse, the mosque
                            was closed for a number of years. Repairs were completed in 1889.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/thZwRHFX7TMUHzHRA"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('ulucami',false)"></div>
    </div>
    |=====|| kent müzesi ||=================|
    <div class="custom-model-main kentmuzesi-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('kentmuzesi',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kervansaray/locations/kent-muzesi1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>City Museum</h2>
                        <p>On the first floor of the Bursa City Museum, where the history of Bursa is exhibited, which had
                            the identity of being a pioneering city during the formation and development of traditional
                            Anatolian and Ottoman culture of approximately 8 thousand years, there is a lot of information
                            about the cultural past of the city. In the basement of the museum, you can visit the historical
                            artisan street, where examples of the city's commercial life are located, and learn about silk
                            production.</p>
                        <p>The ground floor presents the history of Bursa in chronological order. In the "City of
                            Civilizations Bursa" section, you can follow the first civilization traces in Bursa, while
                            witnessing the historical events that had been occurred in Bursa, the first capital of the
                            Ottoman Empire, until the end of the Ottoman period, and learn how Bursa designed its bright
                            future during the Republic Period.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/M3Y2kh6Ae6bbUeN49"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('kentmuzesi',false)"></div>
    </div>
     |=====|| tophane ||=================|
    <div class="custom-model-main tophane-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('tophane',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kervansaray/locations/tophane1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Tophane Clock Tower</h2>
                        <p>This clock tower was built during the governorship of Governor Mumtaz Reshid Pasha, and
                            inaugurated in 1905 in a ceremony held in commemoration of the 29th anniversary of the accession
                            to the throne of Sultan Abdulhamid II. This clock tower was re-built after the collapsing of
                            another clock tower, which had been built during the reign of Sultan Abdulaziz (1861-1876) at
                            the same place as a four-floor square plan building.</p>
                        <p>This clock tower is built inside Tophane Park, a place which can be seen from every place in
                            Bursa, a place, which is a part of the city’s silhouette. This tower has six floors, and it is
                            used as both a fire and a clock tower. This 33 m high tower is built with a square plan, Next to
                            the clock tower, there are four guns used in order to “tell” the Bursa inhabitants the hour of
                            sunset for breaking the fast during the month of Ramadan.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/sZrS3myYihw9JYqi8"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('tophane',false)"></div>
    </div>
     |=====|| bazaar ||=================|
    <div class="custom-model-main bazaar-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('bazaar',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/kervansaray/locations/kapali-carsi1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Bursa Bazaar</h2>
                        <p>Get lost in the allure of smells, flavors, colors, patterns and textures as you stroll through
                            the Historic Bazaar in the Khans Area, which is included in the UNESCO World Heritage List

                            The first Ottoman capital of Bursa is one of the major trading centers of Ottoman Empire and the
                            Republic of Turkey </p>
                        <p>This important commercial role of Bursa and being the capital of the Ottoman Empire was reflected
                            in the Khans Area as large khans, covered bazaar and bazaars. This region has been the center of
                            economic activity in the city since its establishment in the 14th century. The area has
                            preserved its aesthetic and social value and, as it is completely pedestrianized, it is an
                            attractive public space for both tourists and city dwellers. Khans and bazaars have been
                            operating uninterruptedly since 700 years.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/RJBpojhn6PmddsXh6"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('bazaar',false)"></div>
    </div>

    |=====|| Sarsala ||=================|
    <div class="custom-model-main sarsala-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('sarsala',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/thermemaris/locations/sarsala1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Sarsala</h2>
                        <p>With its small pier, sheltered and undisturbed structure, and peaceful waters, in Sarsala Bay and
                            Sarsala Beach, which is approximately 15 kilometers away from the Dalaman district of Muğla; You
                            have the chance to benefit from various recreational activities such as beach volleyball, forest
                            walk, sun, book, sea or similar activities.</p>
                        <p>You have to pay a certain amount to enter Sarsala Beach. However, this amount is really low. The
                            food of the cafes located on this beach, where you can find the service provided by the
                            lifeguards, toilet and shower facilities, is also extremely tasty and at an affordable price.
                        </p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/gbGcNpL5WhHasbkc8"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('sarsala',false)"></div>
    </div>
     |=====|| Kaunos ||=================|
    <div class="custom-model-main kaunos-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('kaunos',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/thermemaris/locations/kaunos1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Kaunos</h2>
                        <p>After the Persians completely captured Anatolia, the city came under the rule of Mausolos. After
                            Alexander defeated the Persians in 334 BC, it came under the rule of Princess Ada, then
                            Antigonos, and then Ptolemy. The Kingdom of Rhodes remained under the sovereignty of the
                            Pergamon Kingdom and the Roman Empire. It started to lose its importance with the filling of the
                            port.</p>
                        <p>According to mythology Kaunos was founded by King Kaunos, son of the Carian King Miletus and
                            Kyane, and grandson of Apollo. Kaunos had a twin sister by the name of Byblis who developed a
                            deep, unsisterly love for him. When she wrote her brother a love letter, telling him about her
                            feelings, he decided to flee with some of his followers to settle elsewhere. His twin sister
                            became mad with sorrow, started looking for him and tried to commit suicide. Mythology says that
                            the Calbys river emerged from her tears.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/gLB2VoqnLNAjhhx39"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('kaunos',false)"></div>
    </div>
     |=====|| sarigerme ||=================|
    <div class="custom-model-main sarigerme-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('sarigerme',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/thermemaris/locations/sarigerme1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Sarigerme</h2>
                        <p>Sarigerme is a holiday neighborhood with 320 households located within the borders of Ortaca
                            district of Muğla province. Dalaman Airport is 17 km away. It is 21 km from Ortaca town center
                            and 102 km from Muğla city center. There is Sarigerme beach within the borders of Sarigerme
                            village.
                        </p>
                        <p>Its opening to tourism started with the opening of Iberotel Sarigerme Park in 1990, and it
                            managed to attract many domestic and foreign investors in a short time. Sarigerme, a place that
                            hosts numerous four- and five-star hotels, is one of Turkey's major holiday resorts.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/3augATRLDbA9ufhA7"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('sarigerme',false)"></div>
    </div>
     |=====|| dalamancayi ||=================|
    <div class="custom-model-main dalamancayi-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('dalamancayi',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/thermemaris/locations/dalaman-cayi1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Dalaman Çayı</h2>
                        <p>Dalaman Stream, whose ancient name is Indos, originating from Kocaş Mountain near Dirmil, is
                            located between Marmaris and Fethiye. Its total length is 229 kilometers. The tea, which grows
                            with the merging of the branches descending from the Göktepe and Yaylacık mountains of the
                            Western Taurus Mountains, flows in a narrow and deep valley, 8 km from Ortaca. It empties into
                            the sea from the south.</p>
                        <p>The tea, which has a clear appearance fed with natural limestone, is always warm and turquoise
                            blue. Due to its proximity to the touristic regions in the Mediterranean and Aegean, rafting can
                            be done throughout the year in the Dalaman Stream, which attracts local and foreign tourists.
                            Pensions in the nearby Akköprü village can be used for accommodation.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/MSeY4DzXpkRrBZoA9"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('dalamancayi',false)"></div>
    </div>
     |=====|| koycegiz ||=================|
    <div class="custom-model-main koycegiz-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('koycegiz',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/thermemaris/locations/koycegiz1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Köyceğiz</h2>
                        <p>The town of Köyceğiz lies at the northern end of a lake of the same name (Köyceğiz Lake) which is
                            joined to the Mediterranean Sea by a natural channel called Dalyan Delta. Its unique environment
                            is being preserved as a nature and wildlife sanctuary, the Köyceğiz-Dalyan Special Environmental
                            Protection Area. A road shaded with trees leads to the township that carries the same name as
                            the river, Dalyan, which is situated on the inland waterway and is administratively a part of
                            the neighboring district of Ortaca. Dalyan is highly popular with visitors and its maze of
                            channels can be explored by boat. The restaurants which line the waterways specialize in fresh
                            fish. High on the cliff face, at a bend in the river, above the ancient harbor city of Caunos,
                            tombs were carved into the rocks. The Dalyan Delta, with a long, golden sandy beach at its
                            mouth, is a nature conservation area and a refuge for rare loggerhead turtles (Caretta caretta)
                            and blue crabs.</p>

                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/AWqodULB6HJDf8aW6"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('koycegiz',false)"></div>
    </div>

     |=====|| Pamukkale ||=================|
    <div class="custom-model-main pamukkale-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('pamukkale',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/doga/locations/pamukkale1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Pamukkale</h2>
                        <p>
                            Located in Denizli/Pamukkale district, it is a visual feast created in the Büyük Menderes Basin
                            with the earthquake that occurred 400 thousand years ago. Pamukkale Travertines, visited by
                            millions of tourists every year, are famous for their healing thermal waters, the fascinating
                            Cleopatra pool and the ancient city of Hierapolis. Travertines consist of terraced hills and are
                            located at the foot of Çörkez Mountain. It is known that its healing waters are good for both
                            respiratory, circulatory and skin diseases.</p>
                        <p>There are 17 hot water areas at 33-35 degrees due to the sedimentary rock travertine terraces and
                            the cotton-white softness. Travertines, which have been known for their healing waters since
                            ancient times, are waiting for their guests who want to find healing.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/zSzbUJGnEyTyEDFe7"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('pamukkale',false)"></div>
    </div>
     |=====|| tripolis ||=================|
    <div class="custom-model-main tripolis-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('tripolis',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/doga/locations/tripolis1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Tripolis</h2>
                        <p>Tripolis Ancient City; It was built on a slope by the Menderes River. It is one of the ancient
                            cities that have access to the Aegean and the Çürüksu Plain and its valleys in the southeast,
                            with the valleys opening to the west and north, and to Central Anatolia and the Mediterranean.
                            It is 30 kilometers from its contemporary Laodikeia, which was established in the Çürüksu Valley
                            in the south of the city, and 20 kilometers from Hierapolis. In the sources, there are documents
                            indicating that the first name of Tripolis was Apollonia, then it was called Tripolis in the
                            Late Hellenistic Period and that its first establishment was during the Lydian State.</p>

                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/aAWYwiKH1f2HqRoR9"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('tripolis',false)"></div>
    </div>
     |=====|| hierapolis ||=================|
    <div class="custom-model-main hierapolis-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('hierapolis',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/doga/locations/hierapolis1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Hierapolis</h2>
                        <p>18 km from Denizli province. The ancient city of Hierapolis, located in the north of the city, is
                            called "Holy City" in the archaeological literature, due to the presence of many temples and
                            other religious structures known in the city. It is discussed in which old geographical region
                            the city is located. With its geographical location, Hierapolis is among the various historical
                            regions surrounding it.</p>
                        <p> The ancient geographers Strabo and Ptolemaios claim that Hierapolis is a Phrygian city with its
                            proximity to the cities of Laodikeia and Tripolis, which border the Caria region. There is no
                            information about the pre-Hellenistic period name of the city in ancient sources. We know that
                            there was a life in the city before it was called Hierapolis because of the cult of the Mother
                            Goddess.</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/jv1Tt6n7jzNzmS6CA"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('hierapolis',false)"></div>
    </div>
     |=====|| laodikeia ||=================|
    <div class="custom-model-main laodikeia-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('laodikeia',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/doga/locations/laodikeia1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Laodikeia</h2>
                        <p>The ancient city of Laodikeia was established at a very convenient point geographically and in
                            the south of the Lykos River. The name of the city is mostly mentioned as “Laodikeia on the
                            shore of Lykos” in ancient sources. According to other ancient sources, the city dates back to
                            BC. Between the years 261-263 II. It was founded by Antiochus and the city was named after
                            Antiochus' wife, Laodike. Laodikeia was one of the most important and famous cities of Anatolia
                            in the 1st century BC.</p>
                        <p>The great works of art in the city belong to this period. The Romans also gave special importance
                            to Laodikeia and made it the center of the Convent of Kibyra (Gölhisar-Horzum). A series of high
                            quality coins were minted in Laodicea during the reign of Emperor Caracalla.
                            The presence of one of the most famous churches of Asia Minor in this city shows how important
                            Christianity was here. A huge earthquake that took place in 60 AD destroyed the city.
                            <button class="custom-btn btn-11"><a href="https://goo.gl/maps/vkZQRD96b2oFwe2g6"
                                    target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('laodikeia',false)"></div>
    </div>
     |=====|| cleopatra ||=================|
    <div class="custom-model-main cleopatra-main">
        <div class="custom-model-inner">
            <div class="close-btn" onclick="popups('cleopatra',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <img src="assets/new/doga/locations/cleopatra1.jpg" alt="">
                    </div>
                    <div class="col-lg-6 col-sm-12 otel-overflow">
                        <h2>Cleopatra</h2>
                        <p>Situated above the Pamukkale white travertine pools is one particularly spectacular location fed
                            by the same hot springs. Here you can bath in the same waters in which Cleopatra once swam! A
                            professionally run modern spa facility allows you to enjoy these historical healing waters.</p>
                        <p>Unlike the white water of the lower pools the Antique Pool favored by Cleopatra, Queen of Egypt,
                            is pure clear warm water. Once it was surmounted by a Roman Temple to Apollo with ornate roof
                            held up with Doric columns. Imagine how Cleopatra must have experienced this when you imagine it
                            in it's glory day.</p>
                        <p>Today it is Roman Ruin, but no less spectacular for it. Immerse yourself in the pool and wade
                            carefully around the fallen columns and other Roman artifacts as you soak up the health giving
                            properties of the water!</p>
                        <button class="custom-btn btn-11"><a href="https://goo.gl/maps/Kx31Lpv919fzKQYz5"
                                target="_blank"><span>Show in maps</span></a></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('cleopatra',false)"></div>
    </div>
     |=====|| POP-UP END ||===============| -->
    <!-- News Area -->
    <section id="home_news" class="section_padding_top">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Latest travel news</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="home_news_left_wrapper">
                        <div class="home_news_item">
                            <div class="home_news_img">
                                <a href="health-in-turkey.php"><img src="assets/img/banner/slider5-min.webp" alt="img"></a>
                            </div>
                            <div class="home_news_content">
                                <h3><a href="health-in-turkey.php">Türkiye’de Kaplıca Kaynakları ve Uygulamalar</a></h3>
                                <p><a href="health-in-turkey.php">11 Ocak 2023</a></p>
                            </div>
                        </div>
                        <div class="home_news_item">
                            <div class="home_news_img">
                                <a href="mest-club-card.php"><img src="assets/img/mestcard-elixe-mockup-min.webp"
                                                                  alt="img"></a>
                            </div>
                            <div class="home_news_content">
                                <h3><a href="mest-club-card.php">Mest Club Card</a></h3>
                                <p><a href="news.php">11 Ocak 2023</a></p>
                            </div>
                        </div>

                        <div class="home_news_item">
                            <div class="seeall_link">
                                <a href="health-in-turkey.php">See health in Turkey <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="home_news_big">
                        <div class="news_home_bigest img_hover">
                            <a href="health-in-turkey.php"><img src="assets/img/banner/slider2-min.webp" alt="img"></a>
                        </div>
                        <h3><a href="health-in-turkey.php">Türkiye’de Kaplıca Tatili İçin Gidilecek En Güzel 10
                                Şehir</a></h3>
                        <p>Türkiye'de bulunan kaplıca tatili için en güzel 10 şehri listelediğimiz bu yazımızda
                            birbirinden güzel kaplıcalara yer veriyoruz.</p>

                        <a href="health-in-turkey.php">Read full article <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Our partners Area
    <section id="our_partners" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Our partners</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="partner_slider_area owl-theme owl-carousel">
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/1.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/2.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/3.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/4.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/5.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/6.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/7.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/8.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/5.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/3.png" alt="logo"></a>
                        </div>
                        <div class="partner_logo">
                            <a href="#!"><img src="assets/img/partner/2.png" alt="logo"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->

    <br><br><br><br>
@endsection
<b></b>
