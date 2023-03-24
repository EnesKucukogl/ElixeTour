@extends('layout.mainlayout')
@section('content')
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>{{ __('Blog') }} </h2>
                        <ul>
                            <li><a href="index.php">{{ __('Home') }}</a></li>
                            <li><span><i class="fas fa-circle"></i></span>{{ __('Blog') }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="top_testinations" class="section_padding">
        <div class="container">
            <!-- Section Heading -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center" style="text-align: left;width:max-content;">
                    </div>
                </div>
            </div>
            <div class="row">


                @foreach($blog as $item)
                    @php
                        $file_path = getImage($blogFile,$item->Id);
                        if($file_path === null || $file_path === '')
                                {
                                    $file_path = 'img/no-image.png';
                                }
                    $blog_title = viewLanguageSupport($item->TitleTextContent);
                    $blog_text=viewLanguageSupport($item->ShortDescriptionTextContent);
                    @endphp
                    <div class="col-lg-3">
                        <div class="theme_common_box_two img_hover">
                            <div class="theme_two_box_img">
                                <a href="blog/{{$item->slug}}"><img style="height:15em;object-fit: cover;" src="/{{$file_path}}" alt="img"></a>
                                <p><i class="fas fa-map-marker-alt"></i>{{ __('Blog') }}</p>
                            </div>
                            <div class="theme_two_box_content" style="height: 250px;">
                                <h4><a href="blog/{{$item->slug}}">{{$blog_title}}</a></h4>
                                <p><span class="review_rating">{{ substr($blog_text, 0, 200) }}...</span></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection
