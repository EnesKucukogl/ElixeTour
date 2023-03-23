@extends('layout.mainlayout')
@section('content')
    @php

        @endphp
    <!-- Common Banner Area -->
    <section id="hotel-detail-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>{{$hotel->name}}</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span>{{$hotel->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Hotel Search Areas -->
    <section id="tour_details_main" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-3">
                    <div class="tour_details_leftside_wrapper">
                        <div class="tour_details_heading_wrapper mb-5">
                            <div class="tour_details_top_heading">
                                <h2>{{$hotel->name}}</h2>
                                <h5><i class="fas fa-map-marker-alt"></i> {{$hotel->address}}</h5>
                            </div>
                            <div class="tour_details_top_heading_right">
                                <h4>Excellent</h4>

                            </div>
                        </div>
                        <!--<div class="tour_details_top_bottom">
                            <div class="toru_details_top_bottom_item">
                                <div class="tour_details_top_bottom_icon">
                                    <i class="fas fa-spa"></i>
                                </div>
                                <div class="tour_details_top_bottom_text">
                                    <p>Spa</p>
                                </div>
                            </div>
                            <div class="toru_details_top_bottom_item">
                                <div class="tour_details_top_bottom_icon">
                                    <img src="assets/img/icon/tv.png" alt="icon">
                                </div>
                                <div class="tour_details_top_bottom_text">
                                    <p>Flat television</p>
                                </div>
                            </div>
                            <div class="toru_details_top_bottom_item">
                                <div class="tour_details_top_bottom_icon">
                                    <img src="assets/img/icon/gym.png" alt="icon">
                                </div>
                                <div class="tour_details_top_bottom_text">
                                    <p>Fitness center</p>
                                </div>
                            </div>
                            <div class="toru_details_top_bottom_item">
                                <div class="tour_details_top_bottom_icon">
                                    <img src="assets/img/icon/wifi.png" alt="icon">
                                </div>
                                <div class="tour_details_top_bottom_text">
                                    <p>Free Wi-fi</p>
                                </div>
                            </div>
                        </div>-->
                        <section id="home_two_banner">
                            <div class="home_two_banner_slider_wrapper owl-carousel owl-theme">
                                @foreach($otelFile as $item)
                                    @php

                                        if($item->file_path === null || $item->file_path === '')
                                        {
                                            $item->file_path = 'img/no-image.png';
                                        }
                                    @endphp

                                    <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                        <img src="/{{$item->file_path}}" alt="">
                                    </div>
                                @endforeach
                            </div>
                        </section>
                        <div class="tour_details_boxed">
                            <h3 class="heading_theme">Select your room</h3>
                            <div class="room_select_area">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">Konaklama paketi
                                        </button>
                                    </li>

                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                         aria-labelledby="home-tab">
                                        <div class="room_booking_area">
                                            <div class="room_book_item">

                                                {{--             <div class="col-lg-6 col-md-6 col-sm-12">

                                                                 <?php
                                                                 foreach ($all_hotel_packages_ids as $package_id) {

                                                                     foreach ($packagesJson as $package) {
                                                                         if ($package_id == $package->id) {
                                                                             if ($package->{'is-just-hotel'} == true) {
                                                                                 $img = $package->images[0]->path;
                                                                                 $name = $package->name;
                                                                                 $package_id = $package->id;
                                                                                 $price = $package->prices[0]->price;
                                                                                 $url = "process.php?package_id=" . $package_id . "&hotel_id=" . $hotel_id;

                                                                                 echo '
                                                         <div class="theme_common_box_two img_hover">
                                                         <div class="theme_two_box_img">
                                                             <a href="sport-therapy.php"><img src="' . $img . '"
                                                                     alt="img"></a>
                                                             <p><i class="fas fa-map-marker-alt"></i>Package</p>
                                                         </div>
                                                         <div class="theme_two_box_content">
                                                             <h4><a href="sport-therapy.php">' . $name . '</a></h4>
                                                             <p><span class="review_rating"></span></p>
                                                             <h3><span>Just Room Price</span></h3>
                                                             <a href=' . $url . ' class="custom-btn btn-5 mt-3">Choose
                                                                 Package</a>
                                                         </div></div>';
                                                                             }


                                                                         }
                                                                     }
                                                                 }


                                                                 ?>
                                                             </div>--}}

                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                aria-selected="true">Konaklama dahil tedavi paketleri
                                        </button>
                                    </li>

                                </ul>
                                {{--    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                             aria-labelledby="home-tab">
                                            <div class="room_booking_area">
                                                <div class="room_book_item">
                                                    <div class="hotel_detail_package_slider owl-theme owl-carousel dot_style">

                                                        <?php


                                                        foreach ($all_hotel_packages_ids as $package_id) {

                                                            foreach ($packagesJson as $package) {
                                                                if ($package_id == $package->id) {
                                                                    if ($package->{'is-just-hotel'} == false) {
                                                                        $img = $package->images[0]->path;
                                                                        $name = $package->name;
                                                                        $package_id = $package->id;
                                                                        $days = $package->prices[0]->{"day-count"};
                                                                        $price = $package->prices[0]->price;
                                                                        $url = "process.php?package_id=" . $package_id . "&hotel_id=" . $hotel_id;

                                                                        echo '
                                                                    <div class="theme_common_box_two img_hover">
                                                                    <div class="theme_two_box_img">
                                                                        <a href="sport-therapy.php"><img src="' . $img . '"
                                                                                alt="img"></a>
                                                                        <p><i class="fas fa-map-marker-alt"></i>Package</p>
                                                                    </div>
                                                                    <div class="theme_two_box_content">
                                                                        <h4><a href="sport-therapy.php">' . $name . '</a></h4>
                                                                        <p><span class="review_rating">' . $days . ' Days+</span></p>
                                                                        <h3>$' . $price . ' <span> Price starts from</span></h3>
                                                                        <a href=' . $url . ' class="custom-btn btn-5 mt-3">Choose
                                                                            Package</a>
                                                                    </div>
                                                                </div>';
                                                                    }


                                                                }
                                                            }
                                                        }

                                                        ?>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>--}}
                            </div>
                        </div>
                        <div class="tour_details_boxed">
                            <h3 class="heading_theme">Overview</h3>
                            <div class="tour_details_boxed_inner">
                                <h4>Termal Suyunun Faydalı Olduğu Rahatsızlıklar</h4>
                                <p class="mt-3">
                                    Termal su, kullanılabilir sıcaklığa getirilerek doktor kontrolünde ve banyo
                                    uygulamaları
                                    şeklinde; inflamatuar romatizmal rahatsızlıkların kronik dönemlerinde, kronik bel
                                    ağrısı, osteoartrit gibi nonninflamatuvar eklem hastalıklarının, miyozit, tendinit,
                                    tracma, fibrimiyalji sendromu gibi yumuşak doku rahatsızlıklarının tedavisinde
                                    destekleyici olarak; ortopedik operasyonlar, beyin ve sinir cerrahisi sonrası gibi
                                    uzun
                                    süreli hareketsiz kalma durumlarında mobilizasyon çalışmalarında, kronik dönemdeki
                                    seçilmiş nörolojik rahatsızlıklarda, cerebral palsy gibi rahatsızlıkların
                                    tedavisinde
                                    destekleyici olarak rehabilitasyon amacıyla, stres bozukluğu, nörovejetatif
                                    distoniler
                                    örneklerindeki gibi genel stres bozukluklarında ve spor yaralanmalarında
                                    kullanılabiliyor.
                                </p>
                                <h4>Termal Özellikler</h4>
                                <ul class="mt-3">
                                    <li><i class="fas fa-circle"></i>Su kaynak derecesi 90-100 derece</li>
                                    <li><i class="fas fa-circle"></i>Termal iç havuz sıcaklığı 36 - 38 derece</li>
                                    <li><i class="fas fa-circle"></i>Dış havuz sıcaklığı 32 - 34 derece</li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="tour_details_right_sidebar_wrapper">
                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading">
                                    <h3>Deluxe Oda - Oda Kahvaltı</h3>
                                </div>
                                <div class="tour_package_bar_price">
                                    <h6>
                                        <del>$ 130,0</del>
                                    </h6>
                                    <h3>$ 110,0 <sub>/Best price</sub></h3>
                                </div>

                                <div class="tour_package_details_bar_list">
                                    <h5>Hotel facilities</h5>
                                    <ul>
                                        @foreach($hotelFacility as $item)
                                            @php
                                                $facility_name = viewLanguageSupport($item->textContent);
                                            @endphp
                                            <li><i class="fa fa-circle"></i>{{$facility_name}}</li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        </div>

                        <div class="tour_detail_right_sidebar">
                            <div class="tour_details_right_boxed">
                                <div class="tour_details_right_box_heading mb-3">
                                    <h3>Hotel location</h3>
                                </div>
                                <div class="map_area">
                                    <iframe
                                        src="{{$hotel->location}}"
                                        allowfullscreen="" loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- |=====|| oda-kahvalti ||=================| -->
    <div class="custom-model-main oda-kahvalti-main">
        <div class="custom-model-inner" style="width: 600px;">
            <div class="close-btn" onclick="popups('oda-kahvalti',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row mb-3">
                    <h4>Deluxe Oda - Kahvaltı</h4>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="gallery1__wrapper owl-carousel owl-theme">
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-1.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-2.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-3.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-4.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-5.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12 col-sm-12 otel-overflow">
                            <p>Deluxe Odalar 28 m² büyüklüğündedir. Odalarda çift kişilik tek yatak veya tek kişilik iki
                                ayrı yatak bulunuyor.</p>
                            <ul class="row mt-5 pop-up-list">
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Duş</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Elektronik Anahtar Sistemi</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Makyaj Aynası</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Saç Kurutma Makinesi</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> WC</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Müzik Yayını (Tvden)</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Halı Kaplı Zemin</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> LCD TV</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Duman Dedektörü</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Merkezi Klima</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Kasa</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Uydu Yayını</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Çay ve Kahve Seti</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Su Isıtıcı</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Kablosuz İnternet</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('oda-kahvalti',false)"></div>
    </div>

    <!-- |=====|| oda-pansiyon ||=================| -->
    <div class="custom-model-main oda-pansiyon-main">
        <div class="custom-model-inner" style="width: 600px;">
            <div class="close-btn" onclick="popups('oda-pansiyon',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row mb-3">
                    <h4>Deluxe Oda - Yarım Pansiyon</h4>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="gallery1__wrapper owl-carousel owl-theme">
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-1.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-2.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-3.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-4.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-5.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12 col-sm-12 otel-overflow">
                            <p>Deluxe Odalar 28 m² büyüklüğündedir. Odalarda çift kişilik tek yatak veya tek kişilik iki
                                ayrı yatak bulunuyor.</p>
                            <ul class="row mt-5 pop-up-list">
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Duş</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Elektronik Anahtar Sistemi</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Makyaj Aynası</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Saç Kurutma Makinesi</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> WC</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Müzik Yayını (Tvden)</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Halı Kaplı Zemin</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> LCD TV</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Duman Dedektörü</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Merkezi Klima</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Kasa</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Uydu Yayını</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Çay ve Kahve Seti</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Su Isıtıcı</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Kablosuz İnternet</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('oda-pansiyon',false)"></div>
    </div>
    <!-- |=====|| oda-tam ||=================| -->
    <div class="custom-model-main oda-tam-main">
        <div class="custom-model-inner" style="width: 600px;">
            <div class="close-btn" onclick="popups('oda-tam',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row mb-3">
                    <h4>Deluxe Oda - Tam Pansiyon</h4>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="gallery1__wrapper owl-carousel owl-theme">
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-1.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-2.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-3.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-4.jpg" alt="">
                            </div>
                            <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                <img src="assets/img/hotels/kaya/kaya-izmir-thermal-spa-oda-5.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12 col-sm-12 otel-overflow">
                            <p>Deluxe Odalar 28 m² büyüklüğündedir. Odalarda çift kişilik tek yatak veya tek kişilik iki
                                ayrı yatak bulunuyor.</p>
                            <ul class="row mt-5 pop-up-list">
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Duş</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Elektronik Anahtar Sistemi</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Makyaj Aynası</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Saç Kurutma Makinesi</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> WC</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Müzik Yayını (Tvden)</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Halı Kaplı Zemin</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> LCD TV</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Duman Dedektörü</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Merkezi Klima</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Kasa</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Uydu Yayını</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Çay ve Kahve Seti</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Su Isıtıcı</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Kablosuz İnternet</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('oda-tam',false)"></div>
    </div>

    <!-- |=====|| oda-junior ||=================| -->
    <div class="custom-model-main oda-junior-main">
        <div class="custom-model-inner" style="width: 600px;">
            <div class="close-btn" onclick="popups('oda-junior',false)">×</div>
            <div class="custom-model-wrap">
                <div class="row mb-3">
                    <h4>Junior Suite</h4>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="gallery1__wrapper owl-carousel owl-theme">
                            @foreach($otelFile as $item)

                                <div class="banner_two_slider_item fadeInUp" data-wow-duration="2s">
                                    <img src="/{{$item->file_path}}" alt="">

                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12 col-sm-12 otel-overflow">
                            <p>Thermal Spa Wellness Center kullanımı ücretsizdir. ( Türk Hamamı, sauna, buhar odası,
                                açık ve
                                kapalı havuz, thermal havuz )<br><b>Fizik Tedavi ve Rehabilistasyon merkezinde
                                    alacağınız 1
                                    adet 60 dk Medikal Masaj hizmeti dahildir.</b></p>

                            <ul class="row mt-5 pop-up-list">
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> 1 Yatak Odası</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Çalışma Masası
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Oturma Grubu
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Balkonlu ve Balkonsuz oda
                                    seçeneği
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Deniz/Havuz veya Doğa manzaralı
                                    oda
                                    seçeneği
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Sigara İçilen ve İçilmeyen
                                    odalar
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Halı Kaplı Zemin</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Kasa</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Günlük Oda Temizliği
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> LCD TV</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i>Otopark (ücretsiz)
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Merkezi Klima</li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> İnternet (Ücretsiz)
                                </li>

                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Saç Kurutma Makinesi
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Duş (Küvetli veya Küvetsiz
                                    seçenek)
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> Günlük Buklet Malzemeleri
                                </li>
                                <li class="col-12 col-md-6"><i class="fas fa-check"></i> WC</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="bg-overlay" onclick="popups('oda-junior',false)"></div>
    </div>







    <!--Related tour packages Area x
    <section id="related_tour_packages" class="section_padding_bottom">
        <div class="container">
             Section Heading
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Related hotels</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="promotional_tour_slider owl-theme owl-carousel dot_style">
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.php"><img src="assets/img/tab-img/hotel1.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>New beach, Thailand</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.php">Kantua hotel, Thailand</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                                                            <button class="custom-btn btn-5 mt-3">Choose
                                                                Package</button>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.php"><img src="assets/img/tab-img/hotel2.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Indonesia</p>
                                <div class="discount_tab">
                                    <span>50%</span>
                                </div>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.php">Hotel paradise international</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                                                            <button class="custom-btn btn-5 mt-3">Choose
                                                                Package</button>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.php"><img src="assets/img/tab-img/hotel3.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Kualalampur</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.php">Hotel kualalampur</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                                                            <button class="custom-btn btn-5 mt-3">Choose
                                                                Package</button>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.php"><img src="assets/img/tab-img/hotel4.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Mariana island</p>
                                <div class="discount_tab">
                                    <span>50%</span>
                                </div>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.php">Hotel deluxe</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                                                            <button class="custom-btn btn-5 mt-3">Choose
                                                                Package</button>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.php"><img src="assets/img/tab-img/hotel6.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Beach view</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="#!">Thailand grand suit</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                                                            <button class="custom-btn btn-5 mt-3">Choose
                                                                Package</button>
                            </div>
                        </div>
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="hotel-details.php"><img src="assets/img/tab-img/hotel7.png" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>Long island</p>
                            </div>
                            <div class="theme_two_box_content">
                                <h4><a href="hotel-details.php">Zefi resort and spa</a></h4>
                                <p><span class="review_rating">4.8/5 Excellent</span> <span class="review_count">(1214
                                        reviewes)</span></p>
                                <h3>$99.00 <span>Price starts from</span></h3>
                                                            <button class="custom-btn btn-5 mt-3">Choose
                                                                Package</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
@endsection
