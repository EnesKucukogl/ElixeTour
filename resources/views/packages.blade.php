@extends('layout.mainlayout')
@section('content')

    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>{{ __('Packages') }} </h2>
                        <ul>
                            <li><a href="index.php">{{ __('Home') }}</a></li>
                            <li><span><i class="fas fa-circle"></i></span>{{ __('Treatments Packages') }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Destinations Areas -->
    <section id="top_testinations" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center" style="text-align: left;width:max-content;">
                        <h2>{{ __('Our Best') }}<br>{{ __('Treatments Packages') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($package as $item)
                    @php
                        $file_path = getImage($packageFile,$item->Id);
                        $package_name = viewLanguageSupport($item->packageTextContent);
                    @endphp
             <div class="col-lg-3">
                <div class="theme_common_box_two img_hover">
                    <div class="theme_two_box_img">
                        <a href="package/{{$item->slug}}"><img src="{{$file_path}}" alt="img"></a>
                        <p><i class="fas fa-map-marker-alt"></i>{{ __('Package') }}</p>
                    </div>
                    <div class="theme_two_box_content">
                        <h4><a href="package/{{$item->slug}}">{{$package_name}}</a></h4>
                        <p><span class="review_rating">{{$item->duration}} {{ __('Days') }}</span></p>
                        <h3>{{$item->price_currency_code."".$item->price}}<span class="price-starts">{{ __('Price starts from') }}</span></h3>
                    </div>
                </div>
            </div>
                @endforeach


            </div>
        </div>
    </section>
@endsection
