@extends('layout.mainlayout')
@section('content')
    <!-- Common Banner Area -->
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>Health in Turkey</h2>
                        <ul>
                            <li><a href="index.php">Anasayfa</a></li>
                            <li><span><i class="fas fa-circle"></i></span>Health in Turkey</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- News Area -->
    <section id="news_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Health in Turkey</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="news_area_top_left">
                        <img src="{{URL::asset('/img/health/health-in-turkey.png')}}" alt="img">
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="news_area_top_right">
                        <p>Ülkemizde 42 adet JCI ile akredite olmuş uluslararası standartlarda akredite olmuş sağlık kuruluşu mevcuttur. Başta İstanbul ve Ankara olmak üzere özel, kamu ve üniversite hastaneleri dünyadaki en yüksek teknoloji ile donatılmıştır.
                        </p>
                        <p>
                            Türkiye de birçok hastane de onkolojik tedaviler, kardiyovoskiler cerrahi, ortopedi, beyin cerrahisi, çocuk cerrahisi, estetik cerrahisi, göz ve dişte ileri teknolojili sağlık hizmetleri verilmektedir.
                            Yine bu hastanelerde Cyberknife, robotik cerrahi, MR, hizmetleri, kemik iliği, organ transplantasyon. yapılabilmektedir.
                        </p>
                        <p>
                            Sağlık bakanlığı sağlık turizmi dairesi başkanlığı bünyesinde 7/24 saat Arapça, İngilizce, Almanca ve Rusça dilinde Acil durumlarda 112, şikayet durumlarında 184 nolu hatlardan ve hastanelerde uluslararası hastalara tercümanlık hizmetleri mevcuttur.
                        </p>
                        <p>
                            Tüm doktorlar mesleki zorunluluk sigortası yaptırmak zorunda olup herhangi bir tıbbi hata veya malpraktis durumunda hastaya sigorta tarafından anında tazminat ödenmektedir.
                        </p>
                        <p>
                            Tüm hastanelerimiz ulusal akreditasyon kriterlerine göre hizmet vermekte olup yılda 2 kez denetlenmektedir. Sağlık turizmi ile ilgili tüm işlemler ve koordinasyon kanun gereği Sağlık Bakanlığı sorumluluğundadır.
                        </p>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Destination details Areas -->
    <section id="top_destination_main" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-5" style="text-align: center;">
                    <h3 style="color: #4c8c40;font-weight:bold;">Türkiye’de Kaplıca Kaynakları ve Uygulamalar
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="tour_details_leftside_wrapper">
                        <div class="tour_details_boxed">

                            <div class="tour_details_boxed_inner">
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseOne" aria-expanded="true"
                                                        aria-controls="collapseOne">
                                                    Şehrin karmaşasından uzaklaştırıp dinlendiren kaplıcalar için
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                 aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span
                                                    style="color: #231f20; font-weight: bold;margin-left: 20px;">Ankara
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Ankara, yeraltında yüzyıllardır adeta bir hazine
                                                        saklıyor. Roma ve Selçuklular zamanından bugüne
                                                        uzanan, yeraltından yeryüzüne yükselip şifa dağıttığına inanılan
                                                        sıcak sulardan bahsediyoruz. Şehir,
                                                        termal merkez olarak 37 alternatif sunuyor. Bu anlamda Ankara,
                                                        Türkiye’nin kaplıca turizmi açısından en
                                                        zengin şehirlerinden biri. Aynı zamanda Türkiye’nin en donanımlı
                                                        termal tesisleri de burada bulunuyor.
                                                        Bu merkezlerin yer aldığı en önemli bölgeler ise Kızılcahamam,
                                                        Haymana ve Ayaş Karakaya. Ortalama 47
                                                        derece sıcaklığındaki kaplıca sularının karaciğer, böbrek, mide,
                                                        bağırsak, solunum yolları, deri, kalp ve kan
                                                        dolaşım rahatsızlıklarına iyi geldiği biliniyor. Bu üç kaplıcanın
                                                        ortak özelliği ise sularının içilebilir olması.
                                                        İçilen suların mide, bağırsak, pankreas, karaciğer, böbrek ve safra
                                                        kesesi rahatsızlıklarına çare olduğuna
                                                        inanılıyor.</p>
                                                    <p>Ankara’da yaşıyorsanız ve şehirden uzaklaşmak istiyorsanız bu termal
                                                        merkezler iyi bir tatil kaçamağı
                                                        olabilir. Eğer burada yaşamıyor ve sadece kaplıcalar için şehri
                                                        tercih ettiyseniz Ankara’yı gezmeden
                                                        dönmeyin. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                        aria-expanded="false" aria-controls="collapseTwo">
                                                    En sıcak sular için
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                 aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span style="color: #231f20; font-weight: bold;margin-left: 20px;">Afyon
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Türkiye’de kaplıca bakımından oldukça zengin olan bir
                                                        diğer yer ise Afyon. Şehir, 60 derecenin üzerindeki
                                                        sıcak sularıyla Türkiye’nin en sıcak kaplıcalarına sahip. 22 termal
                                                        tesisin hizmet verdiği, Türkiye’nin
                                                        önemli kaplıca turizmi ve spa turizmi merkezlerinden biri olan
                                                        Afyon’da öne çıkan kaplıca
                                                        bölgeleri Sandıklı, Gazlıgöl, Heybeli. Bu üç yerin sularının
                                                        romatizmal hastalıklar, kireçlenme, kalp ve
                                                        dolaşım sisteminde meydana gelen aksamalar, cilt, kemik ve kadın
                                                        hastalıkları ile böbrek ve karaciğer
                                                        rahatsızlıklarında etkili olduğu biliniyor. Sandıklı ise çamur
                                                        banyosuyla diğerlerinden biraz daha
                                                        farklılaşıyor. Ünü dünyaya yayılmış bu çamur banyosunda, çamur özel
                                                        bir toprağın, 68 derecelik şifalı
                                                        sıcak suyla karıştırılmasıyla elde ediliyor. Çamur banyosunun
                                                        solunum yolu enfeksiyonlarına, psikolojik
                                                        rahatsızlıklara ve cilt hastalıklarına iyi geldiği söyleniyor
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                        aria-expanded="false" aria-controls="collapseThree">
                                                    Bedene de ruha da iyi gelen kaplıcalar için
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                 aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span style="color: #231f20; font-weight: bold;margin-left: 20px;">Bursa
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Bursa’nın Keramet Köyü’nde bulunan açık hava kaplıcası.
                                                    </p>
                                                    <p>Roma, Bizans, Selçuklu ve Osmanlı’da imparatorları, kraliçeleri,
                                                        sultanları iyileştirdiğine inanılan şifalı
                                                        sıcak sularıyla Bursa, termal merkezler ve termal tesisler konusunda
                                                        zengin bir diğer şehir. 27 termal
                                                        merkeziyle hizmet veren Bursa’nın şifalı sularının başta ruhsal
                                                        hastalıklar olmak üzere birçok bedensel
                                                        rahatsızlığın tedavisine yardımcı olduğu biliniyor. Bu
                                                        rahatsızlıklar arasında romatizmal sendromlar,
                                                        hareket sisteminin diğer ağrılı hastalıkları, kronik iltihaplı ve
                                                        ağrılı kadın hastalıkları, damar tıkanıkları yer
                                                        alıyor. Mazisi oldukça eski olan Oylat Kaplıcaları ise şehirde en
                                                        çok tercih edilen sağlık ve termal turizm
                                                        merkezi. İnegöl ilçesine çok yakın bir bölgede bulunan bu kaplıcanın
                                                        suları içilebiliyor. İçilen bu suların
                                                        obezite tedavisinde etkili olduğu biliniyor. Oylat kaplıca sularının
                                                        diz kapaklarındaki sertleşme,
                                                        kireçlenme ve şiddetli ağrılara iyi geldiğine inanılıyor. Eğer kış
                                                        aylarında bu kaplıcalar için Bursa’ya
                                                        gelmişseniz mutlaka Uludağ’a çıkın. Türkiye’nin en ünlü kayak
                                                        merkezlerinin bulunduğu Uludağ gibi
                                                        şehirde gezilecek yer, tadılacak lezzet oldukça fazla. Zaman
                                                        kaybetmeden Bursa’yı keşfedin.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFour">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                                        aria-expanded="false" aria-controls="collapseFour">
                                                    2 bin 800 yıl öncesinden gelen sağlık için
                                                </button>
                                            </h2>
                                            <div id="collapseFour" class="accordion-collapse collapse"
                                                 aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span
                                                    style="color: #231f20; font-weight: bold;margin-left: 20px;">Pamukkale
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Denizli Pamukkale’de bulunan büyüleyici travertenler.
                                                    </p>
                                                    <p>Türkiye’nin en önemli sağlık ve kaplıca turizm merkezlerinden biri
                                                        olan Pamukkale, sadece bembeyaz
                                                        ortamıyla değil aynı zamanda termal sularıyla da ünlü. Çünkü
                                                        travertenler, kendini bembeyaz yapan özel
                                                        formülüyle şifa dağıtıyor. Travertenlerin dışında sularıyla ümit
                                                        vadeden bir diğer yer ise; geçmişi 2 bin 800
                                                        yıl öncesine giden Hierapolis Antik Kenti. Burada binlerce yıldan
                                                        kalma sütun ve mermerler arasında
                                                        oluşan havuzda hem şifa arayabilir hem de bu otantik ortamın tadını
                                                        çıkabilirsiniz. Travertenler de
                                                        Hierapolis de genellikle kalp, damar, felç ve sinir hastalıklarıyla
                                                        mücadele eden kişiler tarafından tercih
                                                        ediliyor.
                                                    </p>
                                                    <p>Pamukkale gibi Denizli’de gidebileceğiniz bir başka önemli kaplıca
                                                        turizmi merkezi ise Karahayıt termali.
                                                        Karahayıt’ın kendine has kırmızı renkli şifalı sıcak suyu ve termal
                                                        çamuru ortopedi, nörolojik, romatizmal,
                                                        mide ve cilt hastalıkları tedavisinde kullanılıyor.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingFive">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                                        aria-expanded="false" aria-controls="collapseFive">
                                                    İstanbul’a en yakın kaplıcalar için
                                                </button>
                                            </h2>
                                            <div id="collapseFive" class="accordion-collapse collapse"
                                                 aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span
                                                    style="color: #231f20; font-weight: bold;margin-left: 20px;">Yalova
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Yalova’nın Termal ilçesinde bulunan kaplıca merkezi.</p>
                                                    <p>Yalova, diğer şehirler kadar fazla sayıda termal merkeze ve termal
                                                        tesise sahip değil. Ancak Yalova’yı bu
                                                        konuda güçlü kılan 2 yer var. Bunlardan ilki su sıcaklığının 55-60
                                                        derecelerde olduğu Armutlu.
                                                        Radyoaktivite değeri yüksek suları nedeniyle bu kaplıcanın, ağır
                                                        metalin vücuttan atılması, sinir
                                                        hastalıkları, yaraların iyileşmesi ve hormonların düzenlenmesinde
                                                        etkili olduğu düşünülüyor. Yalova’da
                                                        dikkat çeken bir diğer yer ise adından da anlaşılacağı üzere Yalova
                                                        il merkezine 12 km
                                                        uzaklıktaki Termal ilçesi. Burada bulunan termallerin sıcak suları
                                                        ise kas, kemik, sindirim sistemi,
                                                        karaciğer, safra kesesi, böbrek, idrar yolları, cilt ve kadın
                                                        hastalıkları tedavisinde alternatif bir yöntem
                                                        olarak kullanılıyor.
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSix">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSix"
                                                        aria-expanded="false" aria-controls="collapseSix">
                                                    Balıklarla tedavi için
                                                </button>
                                            </h2>
                                            <div id="collapseSix" class="accordion-collapse collapse"
                                                 aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span style="color: #231f20; font-weight: bold;margin-left: 20px;">Sivas
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Sivas’ın Kangal ilçesinde bulunan ve şifalı olduğuna
                                                        inanılan Balıklı Çermik kaplıcası</p>
                                                    <p>Sivas, anlattığımız tüm kaplıcalardan farklı bir özelliğe sahip.
                                                        Balıklı Çermik kaplıcasında dişleri olmayan,
                                                        2-10 cm uzunluğundaki özel balıklar 36-37 derece sıcaklığında
                                                        özellikle deri hastalıklarını tedavi etmeye
                                                        çalışıyor. Bu balıklar, ciltteki yaralar, egzama, sivilce ve sedef
                                                        hastalığı için alternatif tedavi yöntemi
                                                        olarak kullanılıyor. Bu tedavi yönteminden faydalanmak için önerilen
                                                        süre ortalama 20 gün. Bu süre
                                                        boyunca, termal sağlık turizmi merkezi Sivas’ın doğal
                                                        güzelliklerini, tarihi yerlerini mutlaka gezin
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingSeven">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseSeven"
                                                        aria-expanded="false" aria-controls="collapseSeven">
                                                    Yüzyıllardır tedavi için kullanılan sular için
                                                </button>
                                            </h2>
                                            <div id="collapseSeven" class="accordion-collapse collapse"
                                                 aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span style="color: #231f20; font-weight: bold;margin-left: 20px;">Bolu
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Bolu termal, Bolu kaplıcaları otelleri,</p>
                                                    <p>Bolu, jeolojik bakımdan Türkiye’nin en önemli fay tabakası üzerinde
                                                        kurulmuş olduğundan çok miktarda
                                                        jeotermal su kaynağına sahip. Bolu, tarihte de termal ve
                                                        kaplıcalarıyla adından söz ettiren bir kaplıca
                                                        turizmi merkezi. Evliya Çelebi, Seyahatnamesi’nde de yer alan Bolu
                                                        termalleri, banyo ve içme kürleri için
                                                        oldukça elverişli. Ortalama 42 derecelerde olan bu kaplıca
                                                        sularının, romatizmal, deri, sindirim sistemi,
                                                        safra kesesi, böbrek, kan dolaşımı ve kalp, solunum yolu ile kadın
                                                        hastalıklarına iyi geldiği biliniyor.
                                                    </p>
                                                    <p>Bolu, aynı zamanda kaplıca otelleri konusunda da Türkiye’nin en
                                                        donanımlı termal merkezlerinden biri.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEight">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseEight"
                                                        aria-expanded="false" aria-controls="collapseEight">
                                                    Kaplıcadan daha fazlası için
                                                </button>
                                            </h2>
                                            <div id="collapseEight" class="accordion-collapse collapse"
                                                 aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span
                                                    style="color: #231f20; font-weight: bold;margin-left: 20px;">Balıkesir
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Kaplıcaları, içmeleri, çamur ve kum havuzlarıyla
                                                        Balıkesir, sağlıklı doğal kaynak suları bakımından
                                                        Türkiye’nin en zengin kaplıca turizmi merkezlerinden biri. Modern
                                                        termal tesisler ise şehirde Edremit,
                                                        Balya, Bigadiç, Gönen, Manyas ve Susurluk bölgesinde bulunuyor.
                                                        Şeker hastalığı, mide, böbrek ve
                                                        romatizmal hastalıklardan cilt, bel, boyun ve sırt rahatsızlıklarına
                                                        kadar birçok hastalığın tedavisinde bu
                                                        sıcak suların etkin sonuçlar verdiğine inanılıyor.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingNine">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseNine"
                                                        aria-expanded="false" aria-controls="collapseNine">
                                                    Büyüleyici Sultaniye Kaplıcaları için
                                                </button>
                                            </h2>
                                            <div id="collapseNine" class="accordion-collapse collapse"
                                                 aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span style="color: #231f20; font-weight: bold;margin-left: 20px;">Muğla
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Muğla Dalyan’da bulunan ve şifalı kabul edilen termal
                                                        çamur havuzu.</p>
                                                    <p>2 bin yıllık bir geçmişi olan Sultaniye Kaplıcaları hem mineral
                                                        değerleri, hem de ideal sıcaklığıyla yerli ve
                                                        yabancı turistlerin ilgisini çeken bir kaplıca turizmi merkezi.
                                                        Muğla’nın Köyceğiz ilçesinde binlerce yıldır
                                                        kullanılan Sultaniye Kaplıcaları, şifalı sularının yanında çamur
                                                        banyosuyla da turistlerin ilgisini çekiyor.
                                                        Sağlık ve termal turizmi açısından gelişmiş bir şehir olan
                                                        Muğla’daki kaplıcaların romatizma, böbrek ve
                                                        idrar yolları rahatsızlıkları, metabolizma bozuklukları, ruhsal
                                                        yorgunluk, cilt ve kadın hastalıkları gibi
                                                        birçok hastalığa iyi geldiği söyleniyor.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTen">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTen"
                                                        aria-expanded="false" aria-controls="collapseTen">
                                                    Yayla ve kaplıca keyfini bir arada yaşamak için
                                                </button>
                                            </h2>
                                            <div id="collapseTen" class="accordion-collapse collapse"
                                                 aria-labelledby="headingTen" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span style="color: #231f20; font-weight: bold;margin-left: 20px;">Rize
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Doğal güzellikleriyle öne çıkan Karadeniz bölgesi,
                                                        yaylaları kadar doğal su kaynakları ve termal tesisleriyle
                                                        da ünlü. Rize ise bu bölgede yer altı su kaynakları açısından hayli
                                                        şanslı bir şehir. Kaplıcaları ve içmeleriyle
                                                        termal sağlık turizminde önemli paya sahip durumda olan Rize’de iki
                                                        bölge dikkat çekiyor: Ayder Yaylası
                                                        ve İkizdere Vadisi. Yer altından 72 derece olarak çıkan ve içerdiği
                                                        4541 mineraliyle İkizdere Vadisi sıcak
                                                        sularının dünyanın en kalitelilerinden olduğu biliniyor. İkizdere
                                                        suları; kronik bel ağrıları, eklem
                                                        rahatsızlıkları, beyin ve sinir cerrahisi sonrası hareketsiz
                                                        kalanlarla nörolojik ve stres rahatsızlıkları ve spor
                                                        yaralanmalarında tamamlayıcı tedavi unsuru olarak kullanılabiliyor.
                                                        Ayder Yaylası’nın renksiz, kokusuz,
                                                        berrak suları ise romatizmal ve eklem ağrıları gibi hastalıklarda
                                                        tamamlayıcı tedavi olarak tercih ediliyor.</p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingEleven">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseEleven"
                                                        aria-expanded="false" aria-controls="collapseEleven">
                                                    Ilıca Kaplıcaları için
                                                </button>
                                            </h2>
                                            <div id="collapseEleven" class="accordion-collapse collapse"
                                                 aria-labelledby="headingEleven" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span
                                                    style="color: #231f20; font-weight: bold;margin-left: 20px;">Kahramanmaraş
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Türkiye’nin kaplıca turizmi açısından en gelişmiş
                                                        yerlerinden biri kuşkusuz Ilıca Kaplıcaları.
                                                        Kahramanmaraş’ın şehir merkezinden 70 km uzaklıkta olan Ilıca
                                                        Kaplıcaları her yıl yüzlerce yerli ve
                                                        yabancı turisti konuk ettiği için, bölge termal tesis anlamında
                                                        fazlasıyla gelişmiştir. Ilıca Kaplıcaları’nın
                                                        romatizmal hastalıklarından ülsere, üst solunum yolu
                                                        rahatsızlıklarından deri hastalıklarına kadar pek çok
                                                        hastalığa iyi geldiğine inanılıyor. Aynı zamanda Kısık Vadisi
                                                        yakınlarında bulunan ve “Astım Mağaraları”
                                                        olarak da anılan mağaraların astıma ve bronşite iyi geldiği
                                                        söyleniyor</p>
                                                    <p>Kahramanmaraş’ın tek kaplıca turizmi merkezi Ilıca Kaplıcaları değil
                                                        elbette. Döngele Kaplıcaları, Ekinözü
                                                        İçmeleri ve Göksun Büyükkızılcık İçmesi Kahramanmaraş’ın ünlü termal
                                                        sağlık turizmi merkezlerinden.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwelve">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseTwelve"
                                                        aria-expanded="false" aria-controls="collapseTwelve">
                                                    Erzin Başlamış Kaplıcaları için
                                                </button>
                                            </h2>
                                            <div id="collapseTwelve" class="accordion-collapse collapse"
                                                 aria-labelledby="headingTwelve" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span style="color: #231f20; font-weight: bold;margin-left: 20px;">Hatay
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Türkiye’nin en lezzetli şehirlerinden biri olan Hatay,
                                                        aynı zamanda gelişmiş bir termal sağlık turizmi
                                                        merkezi konumunda. Şehrin en ünlü kaplıca turizmi merkezi ise Erzin
                                                        Kaplıcaları olarak da bilinen, Erzin
                                                        ilçesine bağlı Başlamış Köyü Kaplıcalarıdır. Buradan bulunan
                                                        kayalardan çıkan sıcak suların ve şifalı
                                                        maden sularının çeşitli hastalıklara iyi geldiği söyleniyor. Bromür
                                                        içeren, acımsı, hafif tuzlu ve
                                                        karbondioksitli bu sıcak sular, yüzlerce yıldır şifa bulmak isteyen
                                                        turistleri bölgeye getiriyor. Hatay’da
                                                        bulunan diğer termal sağlık turizmi merkezleri ise Hacamat
                                                        Kaplıcaları, Reyhanlı Hamamı, Kisecik Köyü
                                                        Şifalı Suyu ve Alaattin Köyü Termal Suyu.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                    <!--acılır kapanır-->
                                    <div class="accordion_flex_area">
                                        <div class="accordion_left_side">
                                            <h5>*</h5>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThirteen">
                                                <button class="accordion-button collapsed" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapseThirteen"
                                                        aria-expanded="false" aria-controls="collapseThirteen">
                                                    Yoncalı Kaplıcaları için
                                                </button>
                                            </h2>
                                            <div id="collapseThirteen" class="accordion-collapse collapse"
                                                 aria-labelledby="headingThirteen" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                <span
                                                    style="color: #231f20; font-weight: bold;margin-left: 20px;">Kütahya
                                                    Kaplıcaları</span>
                                                    <p class="mt-3">Kütahya, Türkiye’nin sağlık ve termal turizmi açısından
                                                        en önemli şehirlerinden biri. Bakanlar Kurulu
                                                        kararıyla ilan edilen 73 termal turizm merkezinden 9 tanesi
                                                        Kütahya’da bulunuyor. Bu anlamda Kütahya,
                                                        termal tesisleri en donanımlı şehirlerden biri. Özellikle şehir
                                                        merkezine 15 km uzaklıkta bulunan Yoncalı
                                                        Kaplıcaları Türkiye’nin kaplıca turizmi açısından en gelişmiş
                                                        bölgelerinden biri. 42 derece olan Yoncalı
                                                        Kaplıcaları sıcak sularının romatizmal ve nörolojik rahatsızlıklara
                                                        iyi geldiğine inanılıyor. Kütahya’da aynı
                                                        zamanda Ilıca Termal Turizm Merkezi, Gediz Murat Dağı Termal Turizm
                                                        Merkezi, Gediz Ilıcasu Termal
                                                        Turizm Merkezi, Simav Eynal Termal Turizm Merkezi, Simav Naşa Termal
                                                        Turizm Merkezi, Emet Termal
                                                        Turizm Merkezi, Emet Dereli Termal Turizm Merkezi, Tavşanlı Göbel
                                                        Termal Turizm Merkezi ve Hisarcık
                                                        Esire Termal Turizm Merkezi her yıl rahatlamak ve şifa bulmak
                                                        isteyen binlerce turist ağırlıyor.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--acılır kapanır bitis-->
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </section>


    <!-- News Area -->
    <section id="news_details_main_arae" class="section_padding">

        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-5" style="text-align: center;">
                    <h3 style="color: #4c8c40;font-weight:bold;">Türkiye’de Kaplıca Tatili İçin Gidilecek En Güzel 10 Şehir
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="news_detail_wrapper">
                        <div class="news_details_content_area">
                            <div class="theme_nav_tab">
                                <nav class="theme_nav_tab_item">
                                    <div class="nav nav-tabs kaplicalar" id="nav-tab" role="tablist">
                                        <button class="nav-link active" id="nav-afyonkarahisar-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-afyonkarahisar" type="button" role="tab"
                                                aria-controls="nav-afyonkarahisar" aria-selected="true">Afyonkarahisar</button>
                                        <button class="nav-link" id="nav-ankara-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-ankara" type="button" role="tab" aria-controls="nav-ankara"
                                                aria-selected="false">Ankara</button>
                                        <button class="nav-link" id="nav-bolu-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-bolu" type="button" role="tab" aria-controls="nav-bolu"
                                                aria-selected="false">Bolu</button>
                                        <button class="nav-link" id="nav-bursa-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-bursa" type="button" role="tab" aria-controls="nav-bursa"
                                                aria-selected="false">Bursa</button>
                                        <button class="nav-link" id="nav-balikesir-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-balikesir" type="button" role="tab"
                                                aria-controls="nav-balikesir" aria-selected="false">Balıkesir</button>
                                        <button class="nav-link" id="nav-yalova-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-yalova" type="button" role="tab" aria-controls="nav-yalova"
                                                aria-selected="false">Yalova</button>
                                        <button class="nav-link" id="nav-kutahya-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-kutahya" type="button" role="tab"
                                                aria-controls="nav-kutahya" aria-selected="false">Kütahya</button>
                                        <button class="nav-link" id="nav-denizli-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-denizli" type="button" role="tab"
                                                aria-controls="nav-denizli" aria-selected="false">Denizli</button>
                                        <button class="nav-link" id="nav-izmir-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-izmir" type="button" role="tab" aria-controls="nav-izmir"
                                                aria-selected="false">İzmir</button>
                                        <button class="nav-link" id="nav-eskisehir-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-eskisehir" type="button" role="tab"
                                                aria-controls="nav-eskisehir" aria-selected="false">Eskişehir</button>
                                    </div>
                                </nav>
                            </div>
                            <div class="tab-content" id="nav-tabContent1">
                                <div class="tab-pane fade show active" id="nav-afyonkarahisar" role="tabpanel"
                                     aria-labelledby="nav-afyonkarahisar-tab">
                                    <!-- |=====|| Near Locations ||===============| -->

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>1. Afyonkarahisar</h3>
                                            <p><b>Türkiye’nin termal başkenti</b> olarak görülen Afyonkarahisar, içini
                                                ısıtacak kaplıca suları ile meşhur. Sonbahar
                                                ve kış aylarında güzel bir kaplıca tatiline çıkmak istersen rotanı Afyon
                                                kaplıcalarına doğru çevirebilirsin.
                                                Üstelik burada bir yandan termal kaplıcaların tadını çıkarırken diğer yandan
                                                Afyon’da gezilecek
                                                yerleri görebilir ve birbirinden güzel Afyon lezzetlerini tadabilirsin.</p>
                                            <p>Türkiye’nin termal kaplıcaları söz konusu olduğunda akla gelen ilk şehir
                                                kesinlikle Afyonkarahisar. En bilinen
                                                ve sıklıkla tercih edilen <b>Afyonkarahisar kaplıcaları</b> arasında
                                                Gazlıgöl efsanesi ile nam salmış Gazlıgöl Termal
                                                Turizm Merkezi, Ömer Kaplıcası, Gecek Kaplıcası, Heybeli Termal Turizm
                                                Merkezi ve Hüdai Termal Turizm
                                                Merkezi sayılabilir. Kaplıca tatili fikri seni heyecanlandırdıysa Afyon
                                                termal otelleri arasından seçim yaparak
                                                yerini hemen ayırtabilirsin.</p>
                                        </div>
                                    </div>

                                    <!-- |=====|| Near Locations ||=================| -->
                                </div>
                                <div class="tab-pane fade" id="nav-ankara" role="tabpanel" aria-labelledby="nav-ankara-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>2. Ankara</h3>
                                            <p>
                                                Hem Ankara’da yaşayanların hem de başkent Ankara’yı ziyaret edenlerin
                                                huzurlu bir tatil için tercih ettiği
                                                yerlerdir <b>Ankara kaplıcaları.</b> Zengin değerlere sahip termal kaynaklar
                                                eşliğinde bol bol dinlenip
                                                yenileneceğin güzel bir Ankara kaçamağı planlayabilirsin. Sonbahar ve kış
                                                dönemlerinde yorgunluğunu
                                                atmak ve yeni haftaya taptaze bir şekilde başlamak için kaplıca tatilinden
                                                daha iyisi olabilir mi?
                                            </p>
                                            <p>
                                                Ankara’da öne çıkan termal kaplıcalar arasında Ayaş Kaplıcaları,
                                                Kızılcahamam Kaplıcaları, Beypazarı – Dutlu
                                                – Tahtalı Kaplıcaları, Kapullu Kaplıcası ve Haymana Kaplıcası yer alıyor.
                                                Şehirde termal suyun tadını
                                                çıkarırken bir yandan da başkent Ankara’da gezilecek yerleri ziyaret ederek
                                                seyahatini daha da
                                                zenginleştirebileceğini unutma. Termal tatilin tadını doya doya çıkarmak
                                                için Ankara termal
                                                otelleri arasından seçim yapıp yerini ayırtmayı unutma.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="nav-bolu" role="tabpanel" aria-labelledby="nav-bolu-tab">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>3. Bolu</h3>
                                            <p>Bolu’da göl kıyısında keyifli bir yürüyüş yapıp huzur bulmak da mümkün, kışın
                                                en güzel günlerini
                                                değerlendirmek için kayak tatiline çıkmak da… Hatta Bolu’da termal tatilin
                                                güzelliğini dolu dolu yaşamak da
                                                mümkün! Bunun için hemen Bolu termal otelleri arasından seçimini yapmalı ve
                                                yerini ayırtmalısın.
                                                Sonrasında da geriye sadece anın tadını çıkarmak kalıyor. Harika değil mi?
                                            </p>
                                            <p>
                                                Evliya Çelebi’nin Seyahatname’sinde bile kendilerine yer bulmuş olan <b>Bolu
                                                    kaplıcaları</b> arasından öne
                                                çıkanlar Karacasu Kaplıcaları, Babas Kaplıcası, Sarot Kaplıcası, Pavlu
                                                (Kesenözü) Kaplıcası ve Çatak Kaplıcası
                                                sayılabilir. Bolu’nun doğal güzelliklerini de görmeden dönmek olmaz
                                                diyenlerdensen Bolu’da gezilecek
                                                yerler yazımıza göz atmayı unutma ve sevdiğin yerleri ziyaret ederek tatilin
                                                tadını çıkarmaya odaklan.
                                            </p>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="nav-bursa" role="tabpanel" aria-labelledby="nav-bursa-tab">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>4. Bursa</h3>
                                            <p>Biraz kafa dinleyip Bursa’da termal tatil yapmak nasıl olurdu? Henüz bu
                                                deneyimi yaşamamış olsam da
                                                eminim çok dinlendirici ve huzurlu bir tatil olurdu. Çünkü şehrin doğal
                                                güzellikleri düşünüldüğünde
                                                Bursa’nın termal kaynakları oldukça öne çıkıyor. Türkiye’de termal turizm
                                                denildiğinde akla gelen
                                                şehirlerden biri olan Bursa’da çok sayıda termal kaplıca var. En bilinen
                                                <b>Bursa kaplıcaları</b> genel olarak
                                                Çekirge, Bademli Bahçe ve İnegöl Oylat bölgelerine yayılmış durumda. Hem
                                                termal suyun tadını çıkarmak
                                                hem de konforlu bir tatil deneyimi yaşamak için Bursa termal otelleri
                                                arasından zevkine ve bütçene en
                                                uygun olanı seçerek yerini ayırtabilirsin.
                                            </p>
                                            <p>
                                                Termal havuzlar, içme kürleri ya da çamur banyoları gibi farklı
                                                alternatifleri değerlendirme şansı
                                                sunan <b>Bursa termal kaplıcaları</b> arasında Oylat Kaplıcaları, Kükürtlü
                                                Kaplıcası, Eski Kaplıca, Kaynarca Hamamı
                                                ve Karamustafa Ilıcası sayılabilir. Şehre gelmişken Bursa’da gezilecek
                                                yerlere gitmeyi ve Bursa yemeklerinin
                                                tadına bakmayı ihmal etme
                                            </p>
                                        </div>
                                    </div>


                                </div>
                                <div class="tab-pane fade" id="nav-balikesir" role="tabpanel"
                                     aria-labelledby="nav-balikesir-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>5. Balıkesir</h3>
                                            <p>Türkiye’nin termal zenginlikleri Balıkesir’de kendini fazlasıyla gösteriyor.
                                                Edremit Körfezi, Kaz Dağları,
                                                Cunda, Ayvalık, Akçay, Altınoluk, Marmara Adası ve Avşa Adası gibi
                                                <b>Balıkesir’de gezilecek yerler</b> oldukça
                                                fazla olsa da şehrin termal kaplıcaları da turizme fazlası ile katkıda
                                                bulunuyor. <b>Balıkesir kaplıcaları</b> arasında
                                                Susurluk Kaplıcaları, Sındırgı ve Emendere kaplıcaları, Gönen Kaplıcaları,
                                                Pamukçu Termal Tesisleri ve
                                                Hisaralan Kaplıcaları öne çıkıyor. Bigadiç, Edremit ve Manyas bölgelerinde
                                                de termal kaynaklar yer alıyor.
                                                Pamukçu Kaplıcaları Balıkesir’in merkezine en yakın termal kaynak olarak
                                                dikkat çekiyor. Sonbahar ve kış
                                                aylarında sana iyi gelecek bir kaplıca tatiline çıkmak istersen Balıkesir
                                                termal otelleri mutlaka incele.
                                                Huzurlu dolu ve dinlendirici bir deneyim olacağına eminim.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-yalova" role="tabpanel" aria-labelledby="nav-yalova-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>6. Yalova</h3>
                                            <p>Doğal güzelliklerinin yanı sıra tarihi ve kültürel değerleriyle de kendini
                                                gösteren Yalova, yüz ölçüm olarak
                                                Türkiye’nin en küçük ili olsa da sunduğu değerler açısından oldukça zengin.
                                                Yalova’nın merkezine 12 km
                                                uzaklıkta yer alan Termal ilçesinde bulunan <b>Yalova kaplıcaları</b>
                                                dünyaca ünlü. Oluşumları yaklaşık 4000 yıl
                                                öncesine kadar uzanan bu termal kaynakların olduğu alanda birçok tesis yer
                                                alıyor ve burayı her yıl çok
                                                sayıda yerli ve yabancı turist ziyaret ediyor. Sen de Yalova’da termal tatil
                                                yapmak istersen Yalova termal
                                                otelleri arasından seçimini yaparak yerini ayırtabilir ve kendine zaman
                                                ayırmış olmanın huzurunu
                                                yaşayabilirsin.
                                            </p>
                                            <p>
                                                Yalova Termal kaplıcalarının yanında şehirde bir de <b>Armutlu
                                                    kaplıcaları</b> bulunuyor. Kış aylarında içini
                                                ısıtacak bir tatil için bu bölgeye gelip kendine kaliteli bir zaman
                                                ayırabilir termal su eşliğinde yenilenip
                                                tazelenebilirsin. Gelmişken <b>Yalova’da gezilecek yerler</b> arasında öne
                                                çıkan Sudüşen Şelalesi, Erikli Yaylası,
                                                Çınarcık ve Yürüyen Köşk gibi noktaları görebilirsin.
                                            </p>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-kutahya" role="tabpanel"
                                     aria-labelledby="nav-kutahya-tab">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <h3>7. Kütahya</h3>
                                            <p>Kütahya’da termal turizm oldukça hareketli… Şehirde çok sayıda kaplıca ve
                                                termal kaynak yer alıyor. Türkiye
                                                genelinde Bakanlar Kurulu kararı ile ilan edilen 80 termal turizm
                                                merkezinden 8 tanesin Kütahya’da
                                                bulunuyor. <b>Kütahya kaplıcaları</b> her yıl çok sayıda yerli ve yabancı
                                                turist tarafından ziyaret ediliyor. Şehirde
                                                bulunan <b>Ilıca Kaplıcaları</b> yemyeşil bir ormanın içinde oluşu ile
                                                dikkat çekiyor. Kütahya <b>Eynal
                                                    Kaplıcaları</b> ise Evliya Çelebi’nin Seyahatname’sinde bile
                                                anlatılıyor. Tatil sırasında Kütahya’da gezilecek
                                                yerleri ve şehrin doğal güzelliklerini de görmek için mutlaka zaman ayır.
                                            </p>
                                            <p>
                                                Kütahya’da kaplıca tatiline çıkmayı düşünüyorsan Yoncalı Kaplıcaları, Emet
                                                Dereli Kaplıcaları Termal Turizm
                                                Merkezi, Ilıca Harlek Termal Turizm Merkezi, Gediz Murat Dağı Termal Turizm
                                                Merkezi, Gediz Ilıcasu Termal
                                                Turizm Merkezi, Simav Eynal Kaplıcaları Termal Turizm Merkezi, Simav Çitgöl
                                                Kaplıcaları Termal Turizm
                                                Merkezi, Simav Naşa Termal Turizm Merkezi, Emet Termal Turizm Merkezi,
                                                Tavşanlı Göbel Termal Turizm
                                                Merkezi, Hisarcık Esire Termal Turizm Merkezi ve Emet Yenice Kaplıcaları
                                                gidebileceğin yerler arasında
                                                bulunuyor. Konforlu bir konaklama deneyimi için Kütahya termal otellerinde
                                                yerini ayırtabilirsin.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-denizli" role="tabpanel"
                                     aria-labelledby="nav-denizli-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>8. Denizli</h3>
                                            <p>Denizli, turistik olarak UNESCO Dünya Mirasları Listesi’nde yer alan
                                                Pamukkale Travertenleri ve dünyanın
                                                önde gelen termal kaynakları ile dikkatleri üzerine çeken bir şehir.
                                                <b>Pamukkale Kaplıcaları</b> ve <b>Karahayıt
                                                    Kaplıcası</b> Denizli’nin termal kaplıcaları arasında öne çıkıyor. Bu
                                                bölgelere her yıl çok sayıda yerli ve yabancı
                                                turist geliyor. <b>Denizli kaplıcaları</b> arasında Akköy Çamur Kaplıcaları,
                                                Tekkeköy Ilıcaları, Babacık (Kabaağaç)
                                                Kaplıcası, Kızıldere Ilıcası, Akköy Gölemezli Çamur Kaplıcaları ve Yenice
                                                Kamara Kaplıcası yer alıyor. Şehre
                                                gelip termal suyun dokunuşundan yararlanmak istiyorsan Denizli termal
                                                oteller arasından seçimini yap ve
                                                yola çıkmak için hazırlanmaya başla.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-izmir" role="tabpanel" aria-labelledby="nav-izmir-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>9. İzmir</h3>
                                            <p>İzmir kaplıcalarının, antik zamanlardan bu yana termal suyun dokunuşu ile pek
                                                çok kişinin yenilenip
                                                tazelenmesine fayda sağladığı biliniyor. İzmir’de yaz tatili deniz, kum ve
                                                güneş eşliğinde dolu dolu geçiyor.
                                                Sonbahar ve kış aylarında ise İzmir’de termal turizm hareketlenmeye
                                                başlıyor. Merkezi noktalarda termal su
                                                olanağına sahip tesisler genel olarak Balçova, İnciraltı, Narlıdere ve Çeşme
                                                Ilıca civarlarında
                                                konumlanıyor. İzmir termal otelleri arasından seçimini yaparak sen de bu
                                                güzel şehri farklı bir yönü ile
                                                deneyimleyebilirsin.</p>
                                            <p><b>İzmir’in termal kaynakları</b> arasında Bademli Ilıcası, Balçova Termal,
                                                Bayındır Ilıcaları, Bergama Kaplıcaları,
                                                Menemen Ilıcaları, llıcagöl Ilıcası, Tavşan Adası Ilıcası, Çeşme Ilıcaları,
                                                Şifne Kaplıca ve Çamuru, Seferihisar
                                                Kaplıcaları, Urla Ilıcaları (Malkoç içmeleri) ve Gülbahçe Ilıcaları öne
                                                çıkıyor. Mevsim ne olursa olsun İzmir’de
                                                gezmek için bahane yaratabilirsin. İzmir’de gezilecek yerleri de
                                                keşfedeceğin dopdolu, keyifli ve dinlendirici
                                                bir kaplıca tatili diliyorum.</p>

                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="nav-eskisehir" role="tabpanel"
                                     aria-labelledby="nav-eskisehir-tab">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3>10. Eskişehir</h3>
                                            <p>Yer altı suları açısından oldukça zengin olan Eskişehir’in merkezinde çok
                                                sayıda termal tesis ve hamam yer
                                                alıyor. Çevre ilçelerde de kaplıcalar yer alıyor. <b>Eskişehir
                                                    kaplıcaları</b> arasında Sakarıılıca Kaplıcaları, Hasırca
                                                Kaplıcası, Kızılinler Kaplıcası, Sivrihisar Gümüşkonak Ilıcası, Çardak
                                                (Hamamkarahisar) Kaplıcası, Çifteler
                                                Hamamı ve Ilıcaköy Ilıcası sayılabilir. Eskişehir termal oteller arasından
                                                birinde yerini ayırtarak güzel bir
                                                kaplıca tatili deneyimleyebilirsin. Tatil sırasında Eskişehir’de gezilecek
                                                yerleri de mutlaka görmelisin.</p>
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
@endsection
