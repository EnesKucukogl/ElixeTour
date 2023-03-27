<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img width="65%" src="{{URL::asset('/img/elixelogo.png')}}" alt="logo">
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ (request()->is('rudder/dashboard')) ? 'active' : '' }}">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        {{--Customer--}}
        <li class="menu-item {{ (request()->is('rudder/customer')) ? 'active' : '' }}">
            <a href="{{route('admin.customer')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-users-line"></i>
                <div data-i18n="Customer">Müşteriler</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Otel</span>
        </li>


        {{--Hotel--}}
        <li class="menu-item {{ (request()->is('rudder/hotel')) ? 'active' : '' }}">
            <a href="{{route('admin.hotel')}}" class="menu-link">
                <i class="menu-icon fa fa-hotel"></i>
                <div data-i18n="Tables">Oteller</div>
            </a>
        </li>
        {{--Facility--}}
        <li class="menu-item {{ (request()->is('rudder/facility')) ? 'active' : '' }}">
            <a href="{{route('admin.facility')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-bell-concierge"></i>
                <div data-i18n="Facility">Otel Hizmetleri</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Konaklama</span>
        </li>
        <!-- Accomodation -->
        <li class="menu-item {{ (request()->is('rudder/accomodation')) ? 'active' : '' }}">
            <a href="{{route('admin.accomodation')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-building-user"></i>
                <div data-i18n="Contact">Konaklamalar</div>
            </a>
        </li>
        <!-- Accomodation Type -->
        <li class="menu-item {{ (request()->is('rudder/accomodationType')) ? 'active' : '' }}">
            <a href="{{route('admin.accomodationType')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-list-check"></i>
                <div data-i18n="Contact">Konaklama Tipleri</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Paket</span>
        </li>
        {{--packages--}}
        <li class="menu-item {{ (request()->is('rudder/package')) ? 'active' : '' }}">
            <a href="{{route('admin.package')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-boxes-stacked"></i>
                <div data-i18n="Language">Paketler</div>
            </a>
        </li>
        {{--treatment--}}
        <li class="menu-item {{ (request()->is('rudder/treatment')) ? 'active' : '' }}">
            <a href="{{route('admin.treatment')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-stethoscope"></i>
                <div data-i18n="Language">Tedaviler</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('rudder/questions')) ? 'active' : '' }}">
            <a href="{{route('admin.questions')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-circle-question"></i>
                <div data-i18n="Language">S.S.S</div>
            </a>

        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Para</span>
        </li>
        {{--Currency--}}
        <li class="menu-item {{ (request()->is('rudder/currency')) ? 'active' : '' }}">
            <a href="{{route('admin.currency')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-money-bill"></i>
                <div data-i18n="Currency">Para Birimi</div>
            </a>
        </li>
        <!-- Exchange Rates -->
        <li class="menu-item {{ (request()->is('rudder/exchangeRate')) ? 'active' : '' }}">
            <a href="{{route('admin.exchangeRate')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-comments-dollar"></i>
                <div data-i18n="Currency">Döviz Kurları</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Genel</span>
        </li>
        {{--Menü--}}
        <li class="menu-item {{ (request()->is('rudder/menu')) ? 'active' : '' }}">
            <a href="{{route('admin.menu')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-bars"></i>
                <div data-i18n="Language">Menü</div>
            </a>
        </li>

        {{--blog--}}

        <li class="menu-item {{ (request()->is('rudder/blog')) ? 'active' : '' }}">
            <a href="{{route('admin.blog')}}" class="menu-link">
                <i class="menu-icon fas fa-blog"></i>
                <div data-i18n="Blog">Blog</div>
            </a>
        </li>

        {{--language--}}
        <li class="menu-item {{ (request()->is('rudder/language')) ? 'active' : '' }}">
            <a href="{{route('admin.language')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-language"></i>
                <div data-i18n="Language">Diller</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('rudder/offices')) ? 'active' : '' }}">
            <a href="{{route('admin.offices')}}" class="menu-link">
                <i class="menu-icon fa fa-map-marker"></i>
                <div data-i18n="Language">Ofisler</div>
            </a>

        </li>
        {{--Contact --}}
        <li class="menu-item {{ (request()->is('rudder/contact')) ? 'active' : '' }}">
            <a href="{{route('admin.contact')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-comments"></i>
                <div data-i18n="Contact">Müşteri Mailleri</div>
            </a>
        </li>
        <li class="menu-item {{ (request()->is('rudder/config')) ? 'active' : '' }}">
            <a href="{{route('admin.config')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-gear"></i>
                <div data-i18n="Config">Ayarlar</div>
            </a>
        </li>
    </ul>
</aside>
