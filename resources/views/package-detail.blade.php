@extends('layout.mainlayout')
@section('content')
    @php
        $package_name = viewLanguageSupport($package->packageTextContent);
        $file_path = getImage($packageFile,$package->Id);
    @endphp
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>{{$package_name}}</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span><a href="packages.php">Packages</a>
                            </li>
                            <li><span><i class="fas fa-circle"></i></span>{{$package_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!--Destination details Areas -->
  <section id="top_destination_main" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tour_details_leftside_wrapper">
                        <div class="tour_details_heading_wrapper">
                            <div class="tour_details_top_heading">
                                <h2>{{$package_name}}</h2>

                            </div>


                        </div>
                        <div class="tour_details_top_bottom">
                            <div class="toru_details_top_bottom_item">
                                <div class="tour_details_top_bottom_icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="tour_details_top_bottom_text">
                                    <h5>Duration</h5>
                                    <p> {{$package->duration}} days </p>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="theme_common_box_two img_hover" style="margin-top: 30px;">
                                    <div class="theme_two_box_img">
                                        <a href="#"><img src="/{{$file_path}}" alt="img"></a>
                                        <p><i class="fas fa-map-marker-alt"></i>Package</p>
                                    </div>
                                    <div class="theme_two_box_content">
                                        <h4><a href="#">{{$package_name}}</a></h4>
                                        <p><span class="review_rating"> {{$package->duration}} days</span></p>
                                        <h3>{{$package->price_currency_code."".$package->price}}<span class="price-starts">{{ __('Price starts from') }}</span></h3>

                                    </div>
                                </div>
                            </div>
                           <div class="col-lg-9">
                                <div class="tour_details_boxed">

                                    <div class="tour_details_boxed_inner">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                            <tr>
                                                <th scope="col"><i class="fa fa-heart" style="margin-right: 10px;color:#ed1c24;"></i>Therapies</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($package_treatment as $item)
                                                @php

                                                    $treatment_name = viewLanguageSupport($item->treatmentTextContent);
                                                @endphp
                                                <tr>
                                                <td>{{$treatment_name}}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(count($questions)>0)
                     <div class="tour_details_boxed" id="sss">
                            <h3 class="heading_theme">S.S.S.</h3>
                            <div class="tour_details_boxed_inner">
                                <div class="accordion" id="accordionExample">
                                    @foreach($questions as $item)
                                     @php
                                         $question = viewLanguageSupport($item->questionTextContent);
                                         $answer = viewLanguageSupport($item->answerTextContent);
                                         $faqId = 'collapse'.$item->Id;
                                         $faqId2 = 'heading'.$item->Id;
                                     @endphp
                                        <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                        <h2 class="accordion-header" id="{{$faqId2}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#{{$faqId}}" aria-expanded="true"
                                                aria-controls="{{$faqId}}">
                                                {{$question}}
                                            </button>
                                        </h2>
                                        <div id="{{$faqId}}" class="accordion-collapse collapse"
                                            aria-labelledby="{{$faqId2}}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <div class="accordion_itinerary_list">
                                               {{$answer}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                  @endforeach

                                </div>
                            </div>
                        </div>
                       @endif


                    </div>
                </div>

            </div>
        </div>

    </section>


    <!--Related tour packages Area x-->
{{--    <section id="related_tour_packages" class="section_padding_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2><span style="font-weight:bold; color: #4c8c40;">Hotels</span> with this treatment package</h2>
                    </div>
                </div>
            </div>
            <div class="row" style="justify-content: center;">
                <?php

                $package_hotel_ids = array();
                foreach($selected_package->hotels as $hotel)
                {
                    array_push($package_hotel_ids, $hotel->id);
                }

                foreach ($hotelsJson as $hotel) {
                    if (in_array($hotel->id, $package_hotel_ids)) {

                        $name = $hotel->name;
                        $address = $hotel->address;
                        $image = $hotel->images[0]->path;
                        $url;
                        $price;
                        $startPrice = $hotel->startPrice;
                        foreach($packagesJson as $package)
                        {
                            foreach($package->hotels as $package_hotel)
                            {
                                if($package_hotel->id == $hotel->id)
                                {
                                    $price = $package->prices[0]->price;
                                }
                            }
                        }

                        if($hotel->id == 0)
                        {
                            $url = "izmir-kaya.php";
                        }
                        else if($hotel->id == 1)
                        {
                            $url = "bursa-kervansaray.php";
                        }

                        echo '
                <div class="col-lg-3">
                <div class="theme_common_box_two img_hover">
                    <div class="theme_two_box_img">
                        <a href="'.$url.'">
                            <img src="'.$image.'" alt="img">
                        </a>
                        <p><i class="fas fa-map-marker-alt"></i>'.$address.'</p>
                    </div>
                    <div class="theme_two_box_content">
                        <h4><a href="izmir-kaya.php">'.$name.'</a></h4>
                        <p><span class="review_rating">Excellent</span></p>
                        <h3>$'.$startPrice.'<span> Price starts from</span></h3>
                    </div>
                </div>
            </div>
                ';
                    }
                }

                ?>
            </div>
        </div>
    </section>--}}
@endsection
