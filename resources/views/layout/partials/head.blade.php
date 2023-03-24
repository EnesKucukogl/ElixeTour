<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<!-- Title -->
<title>Elixe Tour</title>
<!-- Bootstrap css -->
<link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.min.css') }}">
<!-- animate css -->
<link rel="stylesheet" href="{{ URL::asset('/css/animate.min.css') }}">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
<!-- Fontawesome css -->
<link rel="stylesheet" href="{{ URL::asset('/css/fontawesome.all.min.css') }}">
<!-- owl.carousel css -->
<link rel="stylesheet" href="{{ URL::asset('/css/owl.carousel.min.css') }}">
<!-- Slick css -->
<link rel="stylesheet" href="{{ URL::asset('/css/slick.min.css') }}">
<!--slick-theme.css-->
<link rel="stylesheet" href="{{ URL::asset('/css/slick-theme.css') }}">
<!-- Rangeslider css -->
<link rel="stylesheet" href="{{ URL::asset('/css/nouislider.css') }}">
<link rel="stylesheet" href="{{ URL::asset('/css/bs-stepper.min.css') }}">

<!-- owl.theme.default css -->
<link rel="stylesheet" href="{{ URL::asset('/css/owl.theme.default.min.css') }}">
<!-- owl.theme.default css -->
<link rel="stylesheet" href="{{ URL::asset('/css/sweetalert.css') }}">

<!-- navber css -->
<link rel="stylesheet" href="{{ URL::asset('/css/navber.css') }}">


<!-- meanmenu css -->
<link rel="stylesheet" href="{{ URL::asset('/css/meanmenu.css') }}">

<!-- Style css -->
<link rel="stylesheet" href="{{ URL::asset('/css/style.css') }}">

<!-- Responsive css -->
<link rel="stylesheet" href="{{ URL::asset('/css/responsive.css') }}">

<!-- Favicon -->
<link rel="stylesheet" href="{{ URL::asset('/img/favicon.png') }}">

<!-- Success Animation -->
<link rel="stylesheet" href="{{ URL::asset('/css/quickAppointment.css') }}">

<!-- Stepper Style -->
<link rel="stylesheet" href="{{ URL::asset('/css/bs-stepper.min.css') }}">

<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        //set animation to true
        stepper.animation = true;
    })

    function next() {
        stepper.next()
        //get current step
        var currentStep = stepper.currentStep;
        if(currentStep == 2){
            document.getElementById("line-1").style.backgroundColor = "#007bff";
        }
        if(currentStep == 3){
            document.getElementById("line-2").style.backgroundColor = "#007bff";
        }
    }

    function previous() {
        stepper.previous()
        var currentStep = stepper.currentStep;
        if(currentStep == 2){
            document.getElementById("line-1").style.backgroundColor = "rgba(0,0,0,.12)";
        }
        if(currentStep == 3){
            document.getElementById("line-2").style.backgroundColor = "rgba(0,0,0,.12)";
        }
    }

    function goTo(index) {
        stepper.to(index)
        var currentStep = stepper.currentStep;
        if(currentStep == 2){
            document.getElementById("line-1").style.backgroundColor = "#007bff";
        }
        if(currentStep == 3){
            document.getElementById("line-2").style.backgroundColor = "#007bff";
        }
    }
</script>
