<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ app()->getLocale() }}">

    <title>{{ $shop->name }} | {{ trans('cruds.' . strtolower($section) . '.title') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
    @yield('styles')

    <script src="{{ mix('js/app.js') }}" defer></script>
</head>

<body id="body-pd">
    @include('sweetalert::alert')
    <header class="header" id="header">
        <div class="header_toggle"> <i class='bx bx-menu' id="header-toggle"></i> </div>
        <div class="header_img"> <img src="https://i.imgur.com/hczKIze.jpg" alt=""> </div>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="{{ route('dashboard.main') }}" class="nav_logo"> <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">AffiliatesHub</span></a>
                <div class="nav_list">
                    <hr>
                    <a href="{{ route('dashboard.main') }}" class="nav_link mb-0 py-1">
                        <i class='bx bx-left-arrow-alt nav_icon' ></i>
                        <span class="nav_name">Back to Home</span>
                    </a>
                    <hr>
                    <a href="{{ route('dashboard.shop.panel.overview', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'Dashboard' ? 'active' : ''}}">
                        <i class='bx bx-home-alt nav_icon'></i>
                        <span class="nav_name">Overview</span>
                    </a>
                    <a href="{{ route('dashboard.shop.panel.customers', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'users' ? 'active' : ''}}">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">{{ __('cruds.users.title') }}</span>
                    </a>
                    <a href="{{ route('dashboard.shop.panel.paychecks', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'Paychecks' ? 'active' : ''}}">
                        <i class='bx bx-money-withdraw nav_icon'></i>
                        <span class="nav_name">{{ __('cruds.paychecks.title') }}</span>
                    </a>
                    <a href="{{ route('dashboard.shop.panel.tickets', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'Tickets' ? 'active' : ''}}">
                        <i class='bx bx-receipt nav_icon'></i>
                        <span class="nav_name">{{__('cruds.tickets.title_long')}}</span>
                    </a>
                    <a href="{{ route('dashboard.shop.panel.messages', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'Messages' ? 'active' : ''}}">
                        <i class='bx bx-mail-send nav_icon' ></i>
                        <span class="nav_name">Announces</span>
                    </a>
                    <a href="{{ route('dashboard.shop.panel.configuration', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'Configuration' ? 'active' : ''}}">
                        <i class='bx bx-cog nav_icon'></i>
                        <span class="nav_name">Configuration</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    <div class="content height-100">
        <div class="main">
            @yield('content')
        </div>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="{{ asset('js/select2.full.min.js')}}"></script>
<script src="{{ asset('js/main.js')}}"></script>
@yield('scripts')
</html>
