<li>
    <div class="dropdown language-option">
        <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
            <!--<span class="lang-name"></span>-->
            @foreach($available_locales as $locale_name => $available_locale)
                @if($available_locale === $current_locale)
            <span>{{ $locale_name }}</span>
                @endif
            @endforeach
        </button>
        <div class="dropdown-menu language-dropdown-menu">
            @foreach($available_locales as $locale_name => $available_locale)
                @if($available_locale === $current_locale)
                    <a  class="dropdown-item language-selected" href="language/{{ $available_locale }}">{{ $locale_name }}</a>
                @else
                    <a class="dropdown-item" href="language/{{ $available_locale }}">{{ $locale_name }}</a>
                @endif
            @endforeach

        </div>
    </div>
</li>


