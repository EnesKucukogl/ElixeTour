@extends('layout.mainlayout')
@section('content')


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
                @foreach($officeList as $item)
                    <div class="col-lg-3 col-md-6 col-sm-12 col-12">
                        <div class="contact_boxed">
                            <h6>{{$item->name}}</h6>
                            <h3>{{$item->city_name}} / {{$item->country_name}}</h3>
                            <a href="tel:{{$item->telephone}}">{{$item->telephone}}</a>
                            <p>{{$item->address}}</p>
                        <!--<a href="{{$item->google_maps}}" data-bs-toggle="modal" data-bs-target="#staticBackdrop">View on map</a> -->
                            <a target="_blank" href="{{$item->google_maps}}">View on map</a>
                        </div>
                    </div>
                @endforeach
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
                                            <input type="text" name="name" id="name" class="form-control bg_input"
                                                   placeholder="First name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="surname" id="surname" class="form-control bg_input"
                                                   placeholder="Last name*">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control bg_input"
                                                   placeholder="Email address">
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
                                            <textarea class="form-control" id="message" name="message"
                                                      class="form-control bg_input" rows="5"
                                                      placeholder="Message"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <button type="button" onclick="sendContactForm()"
                                                  id="sendButton"  class="btn btn_theme btn_md mt-3">Send message
                                            </button>
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
<script>


    function sendContactForm() {
        var name = document.getElementById("name").value;
        var surname = document.getElementById("surname").value;
        var email = document.getElementById("email").value;
        var phone = document.getElementById("phone").value;
        var message = document.getElementById("message").value;

        if (name == "" || surname == "" || phone == "" || message == "" || email == "") {
            swal("Please fill all required fields", '', "error")
            return;
        }

        var data = {
            name: name,
            surname: surname,
            email: email,
            phone: phone,
            message: message
        };

        $("#sendButton").html("Gönderiliyor...")
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: "sendContact",
            data: data,
            success: function (response) {
                $("#sendButton").html("Send Message")
                swal(response.message, '', response.type)
                document.getElementById("contact_form_content").reset();
            }
        });

    }
</script>
