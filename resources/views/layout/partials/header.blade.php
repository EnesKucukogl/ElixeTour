<!-- preloader Area -->
<div class="preloader">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="lds-spinner">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Script -->

<Script>


    function resetAnimation() {
        document.getElementById("appointmentForm").style.display = "block";
        document.getElementById("successAnimation").style.display = "none";
    }


    function successAnimation() {
        document.getElementById("appointmentForm").style.display = "none";
        document.getElementById("successAnimation").style.display = "block";
        document.getElementById("modalSendButton").style.display = "none";
        $("button").click(function () {
            $(".check-icon").hide();
            setTimeout(function () {
                $(".check-icon").show();
            }, 10);
        });
    }
</Script>

<script>
    function sendContactFormHeader() {
        var name = document.getElementById("qname").value;
        var surname = document.getElementById("qsurname").value;
        var email = document.getElementById("qmail").value;
        var phone = document.getElementById("qphone").value;
        var message = document.getElementById("qmessage").value;

        if (name == "" || surname == "" || phone == "" || message == "") {
            alert("Please fill all required fields");
            return;
        }

        var data = {
            name: name,
            surname: surname,
            email: email,
            phone: phone,
            message: message
        };

        $.ajax({
            type: "POST",
            url: "sendContact.php",
            data: data,
            success: function (response) {
                successAnimation();
                $.ajax({
                    type: "POST",
                    url: "sendContactResponse.php",
                    data: data,
                    success: function (response) {
                        document.getElementById("qform").reset();
                    }
                });
            }
        });

    }
</script>
<!-- Modal Script End -->

<!-- Header Area -->
<header class="main_header_arae">
    <!-- Top Bar -->
    <div class="topbar-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <ul class="topbar-list">
                        <li>
                            <a href="{{$config->facebook_link}}"><i
                                    class="fab fa-facebook"></i></a>
                            <a href="{{$config->instagram_link}}"><i class="fab fa-instagram"></i></a>
                            <!--
                            <a href="#!"><i class="fab fa-twitter-square"></i></a>
                             <a href="#!"><i class="fab fa-linkedin"></i></a> -->
                        </li>
                        <li><a href="tel:0232 462 11 13"><span>{{$config->telephone}}</span></a></li>
                        <li><a href="#!"><span>{{$config->mail}}</span></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6">
                    <ul class="topbar-others-options">
                        <li class="topbar-quick"><a href="contact.php" data-bs-toggle="modal"
                                                    data-bs-target="#quickAppointment" onclick="resetAnimation()">Quick
                                appointment</a></li>
                        <li><a href="https://wa.me/{{$config->whatsapp}}"><img src="{{URL::asset('/wp.png')}}" width="21px"
                                                                       alt=""><span>Whatsapp</span></a></li>

                        @include('layout/partials/language_switcher')

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Bar -->
    <div class="navbar-area">
        <div class="main-responsive-nav">
            <div class="container">
                <div class="main-responsive-menu">
                    <div class="logo">
                        <a href="{{route("home")}}">
                            <img src="{{URL::asset('/img/elixelogo.png')}}" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-navbar">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{route("home")}}">
                        <img src="{{URL::asset('/img/elixelogo.png')}}" width="225" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            @foreach ($menuItems as $menu)
                                @php
                                    $menu_name = viewLanguageSupport($menu->textContent);
                                @endphp

                                <li class="nav-item"><a href="{{ url($menu->url) }}"
                                                        class="nav-link">{{ $menu_name }}@if(count($menu->children) > 0)
                                            <i class="fas fa-angle-down"></i>
                                        @endif</a>
                                    @if (count($menu->children) > 0)
                                        <ul class="dropdown-menu">
                                            @foreach($menu->children as $menu)
                                                @php

                                                    $menu_name = viewLanguageSupport($menu->textContent);

                                                @endphp
                                                <li class="nav-item">
                                                    <a href="{{ url($menu->url) }}"
                                                       class="nav-link">{{ $menu_name }}</a>
                                                </li>

                                            @endforeach

                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                            {{--<li class="nav-item"><a href="packages.php" class="nav-link">Packages</a></li>--}}


                            {{--  <li class="nav-item"><a href="mest-club-card.php" class="nav-link">Mest Club<span
                                          style="color:#4c8c40;font-weight:bold;"> Card</span></a></li>--}}


                            <li class="nav-item dropdown-quick"><a href="become-vendor.php" data-bs-toggle="modal"
                                                                   data-bs-target="#quickAppointment"
                                                                   onclick="resetAnimation()">Quick appointment</a></li>
                        </ul>

                        <div class="others-options d-flex align-items-center menu-quick">

                            <div class="option-item">
                                <a href="become-vendor.php" data-bs-toggle="modal" data-bs-target="#quickAppointment"
                                   class="btn  btn_navber"
                                   onclick="resetAnimation()">{{ __('Welcome to our website') }}    </a>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <!--<div class="others-option-for-responsive">
       <div class="container">
           <div class="dot-menu">
               <div class="inner">
                   <div class="circle circle-one"></div>
                   <div class="circle circle-two"></div>
                   <div class="circle circle-three"></div>
               </div>
           </div>

           <div class="container">
               <div class="option-inner">
                   <div class="others-options d-flex align-items-center">
                       <div class="option-item">
                           <a href="#" class="search-box"><i class="fas fa-search"></i></a>
                       </div>
                       <div class="option-item">
                           <a href="contact.php" class="btn  btn_navber">Get free quote</a>
                       </div>
                   </div>
               </div>
           </div>
       </div>
   </div> -->
    </div>
</header>


<!-- Modal -->
<div class="modal fade" id="quickAppointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Quick Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div id="appointmentForm">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputName">Ad</label>
                                <input type="text" class="form-control" name="qname" id="qname" placeholder="Name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputSurame">Surname</label>
                                <input type="text" class="form-control" name="qsurname" id="qsurname"
                                       placeholder="Surname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control" name="qmail" id="qmail" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPhone">Phone</label>
                                <input type="tel" class="form-control" name="qphone" id="qphone" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputExplanation">Explanation</label>
                                <textarea class='form-control' name="qmessage" id="qmessage" cols="30"
                                          rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-row" id="successAnimation" style="display:none">
                        <div class="form-group col-md-12">
                            <div class="success-checkmark">
                                <div class="check-icon">
                                    <span class="icon-line line-tip"></span>
                                    <span class="icon-line line-long"></span>
                                    <div class="icon-circle"></div>
                                    <div class="icon-fix"></div>
                                </div>


                            </div>
                        </div>
                        <h3 style="text-align:center">Your message has been delivered. You will receive a response as
                            soon as possible.</h3>
                    </div>

                </form id="qform" name="qform">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_appointment" data-bs-dismiss="modal">Close</button>
                <button type="button" id="modalSendButton" class="btn btn_navber" onclick="sendContactFormHeader();">
                    Send
                </button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->


<!-- search -->
<div class="search-overlay">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-layer"></div>
            <div class="search-overlay-close">
                <span class="search-overlay-close-line"></span>
                <span class="search-overlay-close-line"></span>
            </div>
            <div class="search-overlay-form">
                <form>
                    <input type="text" class="input-search" placeholder="Search here...">
                    <button type="button"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

