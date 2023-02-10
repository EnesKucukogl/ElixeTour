
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
    function sendContactFormHeader()
    {
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
                            <a href="https://www.facebook.com/profile.php?id=100088960760419"><i class="fab fa-facebook"></i></a>
                            <a href="https://www.instagram.com/elixetour/?next=%2F"><i class="fab fa-instagram"></i></a>
                            <!--
                            <a href="#!"><i class="fab fa-twitter-square"></i></a>
                             <a href="#!"><i class="fab fa-linkedin"></i></a> -->
                        </li>
                        <li><a href="tel:0232 462 11 13"><span>0232 462 11 13</span></a></li>
                        <li><a href="#!"><span>info@elixetour.com</span></a></li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-6">
                    <ul class="topbar-others-options">
                        <li class="topbar-quick"><a href="contact.php" data-bs-toggle="modal" data-bs-target="#quickAppointment" onclick="resetAnimation()">Quick appointment</a></li>
                        <li><a href="https://wa.me/+905380968946"><img src="{{URL::asset('/wp.png')}}" width="21px" alt=""><span>Whatsapp</span></a></li>
                        <!-- <li>
                            <div class="dropdown language-option">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <span class="lang-name"></span>
                                </button>
                                <div class="dropdown-menu language-dropdown-menu">
                                    <a class="dropdown-item" href="#">English</a>
                                    <a class="dropdown-item" href="#">Arabic</a>
                                    <a class="dropdown-item" href="#">French</a>
                                </div>
                            </div>
                        </li> -->

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
                        <a href="index.php">
                            <img src="{{URL::asset('/img/elixelogo.png')}}" alt="logo">
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-navbar">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="index.php">
                        <img src="{{URL::asset('/img/elixelogo.png')}}" width="225" alt="logo">
                    </a>
                    <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                        <ul class="navbar-nav">

                            <li class="nav-item"><a href="index.php#hotels-two" class="nav-link">Hotels<i class="fas fa-angle-down"></i></a>
                                <ul class="dropdown-menu">
                                    <li class="nav-item">
                                        <a href="izmir-kaya.php" class="nav-link">Kaya Thermal & Spa</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="bursa-kervansaray.php" class="nav-link">Bursa Kervansaray Hotel</a>
                                    </li>
                                </ul>

                            </li>
                            <li class="nav-item"><a href="packages.php" class="nav-link">Packages</a></li>

                            <li class="nav-item"><a href="health-in-turkey.php" class="nav-link">Health in Turkey</a>
                            </li>
                            <li class="nav-item"><a href="mest-club-card.php" class="nav-link">Mest Club<span
                                        style="color:#4c8c40;font-weight:bold;"> Card</span></a></li>

                            <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                            <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                            <li class="nav-item dropdown-quick"><a href="become-vendor.php" data-bs-toggle="modal" data-bs-target="#quickAppointment" onclick="resetAnimation()">Quick appointment</a></li>
                        </ul>
                        <div class="others-options d-flex align-items-center menu-quick">

                            <div class="option-item">
                                <a href="become-vendor.php" data-bs-toggle="modal" data-bs-target="#quickAppointment" class="btn  btn_navber"  onclick="resetAnimation()">Quick appointment</a>
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
                                <input type="text" class="form-control" name="qsurname" id="qsurname" placeholder="Surname">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputEmail">Email</label>
                                <input type="email" class="form-control"name="qmail" id="qmail" placeholder="Email">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="inputPhone">Phone</label>
                                <input type="tel" class="form-control" name="qphone" id="qphone" placeholder="Phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="inputExplanation">Explanation</label>
                                <textarea class='form-control' name="qmessage" id="qmessage" cols="30" rows="5"></textarea>
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
                        <h3 style="text-align:center">Your message has been delivered. You will receive a response as soon as possible.</h3>
                    </div>

                </form id="qform" name="qform">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_appointment" data-bs-dismiss="modal">Close</button>
                <button type="button" id="modalSendButton" class="btn btn_navber" onclick="sendContactFormHeader();">Send</button>
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