<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ app()->getLocale() }}">

    <title>{{ isset($shop_name) ? $shop_name : trans('global.site_title') }} |
        {{ trans('cruds.' . strtolower($section) . '.title') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="{{ asset('css/global.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    @yield('styles')
</head>

<body id="body-pd">
    @include('sweetalert::alert')
    <div class="desktop-navbar">
        <header class="header " id="header">
            <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
            <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
        </header>
        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="{{ route('dashboard.main') }}" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i>
                        <span class="nav_logo-name">AffiliatesHub</span></a>
                    <div class="nav_list">
                        <hr>
                        <a href="{{ route('dashboard.explore.index') }}"
                            class="nav_link {{ $section == 'Search' ? 'active' : '' }}">
                            <i class='bx bx-search nav_icon'></i>
                            <span class="nav_name">{{ __('cruds.search.title') }}</span>
                        </a>
                        <a href="{{ route('dashboard.main') }}"
                            class="nav_link {{ $section == 'Dashboard' ? 'active' : '' }}">
                            <i class='bx bx-grid-alt nav_icon'></i>
                            <span class="nav_name">{{ __('cruds.dashboard.title') }}</span>
                        </a>
                        <a href="{{ route('dashboard.wallet.index') }}"
                            class="nav_link {{ $section == 'Vouchers' ? 'active' : '' }}">
                            <i class='bx bx-money-withdraw nav_icon'></i>
                            <span class="nav_name">{{ __('cruds.paychecks.title') }}</span>
                        </a>
                        <a href="{{ route('dashboard.settings.index') }}" class="nav_link {{ $section == 'Settings' ? 'active' : '' }}">
                            <i class='bx bx-cog nav_icon'></i>
                            <span class="nav_name">{{ __('cruds.settings.title') }}</span>
                        </a>
                    </div>
                </div>

                <div>
                    <hr>
                    <a href="{{ route('logout') }}" class="nav_link">
                        <i class='bx bx-log-out nav_icon'></i>
                        <span class="nav_name">{{ __('global.logout') }}</span>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <div class="mobile-navbar mobile-top-navbar bg-light p-3 fixed-top">
        <div class="text-dark">
            <div class="row">
                <div class="col-2">
                    @if ($header['return'] ?? false)
                        <a class="btn btn-primary mt-1 py-1 px-2" href="{{ $header['return'] }}"><i
                                class='bx bx-chevron-left mt-1' style="font-size: 18px;"></i></a>
                    @endif
                </div>

                <div class="col-7">
                    <div class="mt-2 text-center">
                        <span class="h4">
                            <i class="{{ $header['icon'] ?? '' }} align-middle"></i>
                            {{ $header['title'] ?? '' }}
                        </span>
                    </div>
                </div>

                <div class="col-3">
                    <div class="mt-1">
                        <label class="d-inline-block align-top mt-1 me-1" style="font-size: 22px; margin-top: 0px;"
                            for="flexSwitchCheckDefault"><i class='bx bx-sun'></i></label>
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="mobile-navbar navbar fixed-bottom navbar-light bg-light pb-0 mobile-bottom-navbar">
        <div class="container-fluid justify-content-around">
            <a class="navbar-brand {{ $section == 'Search' ? 'active' : '' }}" href="{{ route('dashboard.explore.index') }}">
                <i class='bx bx-search'></i>
                <span class="navbar-text">{{ __('cruds.search.title') }}</span>
            </a>
            <a class="navbar-brand {{ $section == 'Dashboard' ? 'active' : '' }}"
                href="{{ route('dashboard.main') }}">
                <i class='bx bx-grid-alt'></i>
                <span class="navbar-text">{{ __('cruds.dashboard.title') }}</span>
            </a>
            <a class="navbar-brand position-relative {{ $section == 'Vouchers' ? 'active' : '' }}"
                href="{{ route('dashboard.wallet.index') }}">
                <i class="fa-solid fa-ticket"></i>
                <span class="navbar-text">{{ __('cruds.vouchers.title') }}</span>
                @if ($count = auth()->user()->vouchers()->count())
                    <div class="badge_count">
                        {{ $count }}
                    </div>
                @endif
            </a>
            <a class="navbar-brand {{ $section == 'Settings' ? 'active' : '' }}" href="{{ route('dashboard.settings.index') }}">
                <i class='bx bx-cog'></i>
                <span class="navbar-text">{{ __('cruds.settings.title') }}</span>
            </a>
        </div>
    </nav>
    <div class="content h-100">
        <div class="main">
            @yield('content')
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('js/select2.full.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
@yield('scripts')

</html>
