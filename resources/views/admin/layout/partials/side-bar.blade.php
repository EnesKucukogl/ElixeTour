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
        <li class="menu-item active">
            <a href="{{route('admin.dashboard')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>



            {{--Hotel--}}
                <li class="menu-item">
                    <a href="{{route('admin.customer')}}" class="menu-link">
                        <i class="menu-icon fa-solid fa-users-line"></i>
                        <div data-i18n="Customer">Müşteriler</div>
                    </a>
                </li>
            {{--Accomodation--}}
        <li class="menu-item">
            <a href="{{route('admin.accomodation')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-bed"></i>
                <div data-i18n="Customer">Konaklama Seçenekleri</div>
            </a>
        </li>

            {{--Hotel--}}
        <li class="menu-item">
            <a href="{{route('admin.hotel')}}" class="menu-link">
                <i class="menu-icon fa fa-hotel"></i>
                <div data-i18n="Tables">Oteller</div>
            </a>
        </li>
        {{--Menü--}}
        <li class="menu-item">
            <a href="{{route('admin.menu')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-bars"></i>
                <div data-i18n="Language">Menü</div>
            </a>
        </li>
        {{--packages--}}
        <li class="menu-item">
            <a href="{{route('admin.package')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-boxes-stacked"></i>
                <div data-i18n="Language">Paketler</div>
            </a>
        </li>
        {{--treatment--}}
        <li class="menu-item">
            <a href="{{route('admin.treatment')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-stethoscope"></i>
                <div data-i18n="Language">Tedaviler</div>
            </a>
        </li>
        {{--language--}}
        <li class="menu-item">
            <a href="{{route('admin.language')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-language"></i>
                <div data-i18n="Language">Diller</div>
            </a>
        </li>
        {{--Currency--}}
        <li class="menu-item">
            <a href="{{route('admin.currency')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-dollar-sign"></i>
                <div data-i18n="Currency">Para Birimi</div>
            </a>
        </li>
        {{--Contact --}}
        <li class="menu-item">
            <a href="{{route('admin.contact')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-comments"></i>
                <div data-i18n="Contact">Müşteri Mailleri</div>
            </a>
        </li>
        {{--Facility--}}
        <li class="menu-item">
            <a href="{{route('admin.facility')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-bell-concierge"></i>
                <div data-i18n="Facility">Otel Hizmetleri</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="{{route('admin.config')}}" class="menu-link">
                <i class="menu-icon fa-solid fa-gear"></i>
                <div data-i18n="Config">Ayarlar</div>
            </a>
        </li>

    </ul>
</aside>
