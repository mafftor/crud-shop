<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{ url('/') }}">{{ env('APP_NAME') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item {{ request()->is('products*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('products.index') }}">{{ __('Products') }}</a>
            </li>
            <li class="nav-item {{ request()->is('options*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('options.index') }}">{{ __('Options') }}</a>
            </li>
        </ul>
    </div>
</nav>
