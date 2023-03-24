@extends('layout.mainlayout')
@section('content')
    @php
        $blog_title = viewLanguageSupport($blog->TitleTextContent);
        $blog_text = viewLanguageSupport($blog->DescriptionTextContent);
        $file_path = getImage($blogFile,$blog->Id);
        if($file_path === null || $file_path === '')
                        {
                            $file_path = 'img/no-image.png';
                        }
    @endphp
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>{{$blog_title}}</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span><a href="blog.php">Blog</a>
                            </li>
                            <li><span><i class="fas fa-circle"></i></span>{{$blog_title}}</li>
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
                    <div class="col-md-8 offset-md-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $blog_text }}</h5>
                                <img src="{{ $file_path }}" class="card-img-top" alt="...">
                            </div>
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
