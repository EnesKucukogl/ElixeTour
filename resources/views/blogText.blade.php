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



    <!-- News Area -->
    <section id="news_details_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="news_detail_wrapper">
                        <div class="news_details_content_area">
                            <img src="/{{$file_path}}" style="border-radius: 10px;" alt="img">
                            <h2>{{$blog_title}}</h2>
                            <p>
                                {!! $blog_text !!}
                            </p>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="news_details_rightbar">
                        <div class="news_details_right_item">
                            <h3>Recent news</h3>
                            @foreach ($blogRandom as $item)

                                @php
                                    $file_path = getImage($blogFile,$item->Id);
                                    $blog_title = viewLanguageSupport($item->TitleTextContent);
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
                                        <h5><a href="treatment/{{$item->slug}}">{{$blog_title}}</a></h5>

                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
