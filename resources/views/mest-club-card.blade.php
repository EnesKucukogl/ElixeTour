@extends('layout.mainlayout')
@section('content')
<!-- Common Banner Area -->
<section id="common_banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="common_bannner_text">
                    <h2>Mest Club Card</h2>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><span><i class="fas fa-circle"></i></span> Mest Club Card</li>
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

                    <h5><img src="{{URL::asset('/img/favicon.png')}}" width="30px" alt="">Mest</h5>
                    <h2>Club Card Ayrıcalıkları</h2>
                    <p>Doğal kaplıca kaynaklarında farklı alanlarda en iyi uygulamaları sunan modern merkezlerimizde
                        dünyanın her yerinden gelen misafirlerimize ve refakatçilerine hizmet vermekteyiz. Ayrıca
                        Türkiye’nin önde gelen termal turizm, spa ve wellness otellerinde misafirlerimizin tedavi ya da
                        tatil amacı ile konaklama taleplerini karşılamaktayız. </p>
                    <p>Fizik tedavi ve rehabilitasyon uygulamaları için ise İzmir ve Bursa’da bulunan merkezlerimizde misafirlerimizin hem tedavilerini, hem konaklama hizmetlerini gerçekleştiriyoruz. Kardiyoloji, radyoloji, dahiliye, ortopedi, estetik ve plastik cerrahi, kadın hastalıkları ve doğum, ağız ve diş sağlığı, psikiyatri, estetik varis tedavileri, medikal estetik, saç ekimi, beslenme ve diyet, alternatif tıp gibi birçok farklı alanda tedavi ve çözümler sunuyoruz.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about_us_right">
                    <img src="{{URL::asset('/img/mestcard-elixe-mockup.png')}}" alt="img">
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
