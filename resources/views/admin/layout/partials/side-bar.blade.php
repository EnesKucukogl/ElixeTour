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

        <!-- Layouts -->
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-layout"></i>
                <div data-i18n="Layouts">Layouts</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('admin.withoutMenu')}}" class="menu-link">
                        <div data-i18n="Without menu">Without menu</div>
                    </a>
                </li>
            </ul>
        </li>
            {{--Service--}}
        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon fa-solid fa-laptop "></i>
                <div data-i18n="Service">Hizmetler</div>
            </a>
            {{--Hotel--}}
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="{{route('admin.customer')}}" class="menu-link">
                        <div data-i18n="Hotel">Müşteriler</div>
                    </a>
                </li>
            </ul>
        <!-- Tables -->
        <li class="menu-item">
            <a href="{{route('admin.table')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Tables</div>
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
     <!-- Contact -->
        <li class="menu-item">
            <a href="{{route('admin.contact')}}" class="menu-link">
                <i class="menu-icon fa-regular fa-address-book"></i>
                <div data-i18n="Contact">Contact</div>
            </a>
        </li>

    </ul>
</aside>
