<!DOCTYPE html>
<html
    lang="en"
    class="light-style layout-menu-fixed"
    dir="ltr"
>
<head>
    @include('admin.layout.partials.head')
</head>
<body>
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
@include('admin.layout.partials.side-bar')

        <div class="layout-page">
        @include('admin.layout.partials.header')
            <div class="content-wrapper">
                <div class="container-xxl flex-grow-1 container-p-y">
@yield('content')
                </div>
        @include('admin.layout.partials.footer')
    </div>
</div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
@include('admin.layout.partials.footer-scripts')
</body>
</html>
