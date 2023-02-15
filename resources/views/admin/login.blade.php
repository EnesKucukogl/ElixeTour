<!DOCTYPE html>
<html
    lang="en"
    class="light-style customizer-hide"
    dir="ltr"
>
<head>
    <meta charset="utf-8"/>
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Elixe Tour</title>

    <meta name="description" content=""/>

    <!-- Favicon -->

    <link rel="stylesheet" href="{{ URL::asset('admin-assets/img/favicon/favicon.ico') }}">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->

    <link rel="stylesheet" href="{{ URL::asset('admin-assets/vendor/fonts/boxicons.css') }}">
    <!-- Core CSS -->

    <link rel="stylesheet" href="{{ URL::asset('admin-assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-assets/vendor/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('admin-assets/css/demo.css') }}">


    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ URL::asset('admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">
    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ URL::asset('admin-assets/vendor/css/pages/page-auth.css') }}">
    <!-- Helpers -->
    <script type="text/javascript" src="{{URL::asset('/admin-assets/vendor/js/helpers.js')}}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->

    <script type="text/javascript" src="{{URL::asset('/admin-assets/js/config.js')}}"></script>
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">

                        <img width="50%" src="{{URL::asset('/img/elixelogo.png')}}" alt="logo">

                    </div>
                    <!-- /Logo -->


                    <form id="formAuthentication" class="mb-3" action="{{ route('admin.handleLogin') }}" method="POST">
                        @csrf

                        <span class="text-danger "><b>{{ $errors->first('userNamePassword') }}</b></span>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Kullanıcı Adı</label>
                            <input
                                type="text"
                                class="form-control"
                                id="user_name"
                                name="user_name"
                                placeholder="Lütfen kullanıcı adınızı giriniz"
                                autofocus
                            />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Parola</label>

                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Giriş Yap</button>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
</div>

<!-- / Content -->


<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script type="text/javascript" src="{{URL::asset('/admin-assets/vendor/libs/jquery/jquery.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/admin-assets/vendor/libs/popper/popper.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/admin-assets/vendor/js/bootstrap.js')}}"></script>
<script type="text/javascript"
        src="{{URL::asset('/admin-assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
<script type="text/javascript" src="{{URL::asset('/admin-assets/vendor/js/menu.js')}}"></script>

<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script type="text/javascript" src="{{URL::asset('/admin-assets/js/main.js')}}"></script>


<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

</body>
</html>
