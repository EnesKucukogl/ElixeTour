@extends('layout.mainlayout')
@section('content')
    <script>
        function sendContactForm()
        {
            var name = document.getElementById("name").value;
            var surname = document.getElementById("surname").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var message = document.getElementById("message").value;

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
                    alert("Your message has been sent successfully");
                    $.ajax({
                        type: "POST",
                        url: "sendContactResponse.php",
                        data: data,
                        success: function (response) {
                            document.getElementById("contact_form_content").reset();
                        }
                    });
                }
            });

        }
    </script>

    <!-- Common Banner Area -->
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>Contact</h2>
                        <ul>
                            <li><a href="index.php">Home</a></li>
                            <li><span><i class="fas fa-circle"></i></span>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Area -->
    <section id="contact_main_arae" class="section_padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="section_heading_center">
                        <h2>Contact with us</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="phone_tuch_area">
                        <h3 style="margin-right:30px;">Stay in touch</h3>
                        <h3><a href="tel:0232 462 11 13">0232 462 11 13</a></h3>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                    <div class="contact_boxed">
                        <h6>Head office</h6>
                        <h3>Izmir / Turkey</h3>
                        <p>Adalet mah, Şht. Polis Fethi Sekin Cd No:1, 35530 Bayraklı/İzmir</p>
                        <a href="https://goo.gl/maps/v1JwLVsvCEqQqdxC7" data-bs-toggle="modal" data-bs-target="#staticBackdrop">View on map</a>
                    </div>
                </div>

            </div>
            <div class="contact_main_form_area">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="section_heading_center">
                            <h2>Leave us a message</h2>
                        </div>
                        <div class="contact_form">
                            <form action="!#" id="contact_form_content">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="name" id="name" class="form-control bg_input" placeholder="First name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="surname" id="surname" class="form-control bg_input" placeholder="Last name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control bg_input"
                                                   placeholder="Email address (Optional)">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" class="form-control bg_input"
                                                   placeholder="Mobile number*">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <textarea class="form-control" id="message" name="message" bg_input" rows="5"
                                            placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="button" onclick="sendContactForm()" class="btn btn_theme btn_md">Send message</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
