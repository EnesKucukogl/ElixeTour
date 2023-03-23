@extends('layout.mainlayout')
@section('content')
    @php
        $treatment_name = viewLanguageSupport($treatment->treatmentTextContent);
        $treatment_desc = viewLanguageSupport($treatment->descriptionTextContent);
          $file_path = getImage($treatment_file,$treatment->Id);
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
                        <h2>{{$treatment_name}}</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span>{{$treatment_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- News Area -->
    <section id="news_details_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="news_detail_wrapper">
                        <div class="news_details_content_area">
                            <img src="/{{$file_path}}" style="border-radius: 10px;" alt="img">
                            <h2>{{$treatment_name}}</h2>
                            <p>
                                {{$treatment_desc}}
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news_details_rightbar">
                        <div class="news_details_right_item">
                            <h3>Recent news</h3>
                            @foreach ($treatmentRandom as $item)

                                    @php
                                        $file_path = getImage($treatment_file,$item->Id);
                                        $treatment_name = viewLanguageSupport($item->treatmentTextContent);
                                        if($file_path === null || $file_path === '')
                                        {
                                             $file_path = 'img/no-image.png';
                                        }
                                    @endphp
                                    <div class="recent_news_item">
                                        <div class="recent_news_img">
                                            <img src="/{{$file_path}}" style="width:100px;border-radius: 10px;"
                                                 alt="img">
                                        </div>
                                        <div class="recent_news_text">
                                            <h5><a href="treatment/{{$item->slug}}">{{$treatment_name}}</a></h5>

                                        </div>
                                    </div>

                            @endforeach
                        </div>

                        <div class="news_details_right_item">
                            <h3>Share causes</h3>
                            <div class="share_icon_area">
                                <ul>
                                    <li><a href="!#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="!#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="!#"><i class="fab fa-instagram"></i></a></li>
                                    <li><a href="!#"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
