<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="locale" content="{{ app()->getLocale() }}">

    <title>{{ $shop->name }} | {{ $section }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet" />
    @yield('styles')
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
                    <a href="{{ route('dashboard.shop.panel.members', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'Members' ? 'active' : ''}}">
                        <i class='bx bx-user nav_icon'></i>
                        <span class="nav_name">Members</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-notepad nav_icon'></i>
                        <span class="nav_name">Ticket History</span>
                    </a>
                    <a href="#" class="nav_link">
                        <i class='bx bx-mail-send nav_icon' ></i>
                        <span class="nav_name">Announces</span>
                    </a>
                    <a href="{{ route('dashboard.shop.panel.configuration', ['shop' => $shop->subdomain]) }}" class="nav_link {{ $section == 'Configuration' ? 'active' : ''}}">
                        <i class='bx bx-cog nav_icon'></i>
                        <span class="nav_name">Configuration</span>
                    </a>
                </div>
            </div>
            <a href="/logout" class="nav_link">
                <i class='bx bx-log-out nav_icon'></i>
                <span class="nav_name">SignOut</span>
            </a>
        </nav>
    </div>
    <div class="content height-100">
        <div class="main">
            @yield('content')
        </div>
    </div>
    @yield('scripts')
</body>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        const showNavbar = (toggleId, navId, bodyId, headerId) => {
            const toggle = $(`#${toggleId}`),
                nav = $(`#${navId}`),
                bodypd = $(`#${bodyId}`),
                headerpd = $(`#${headerId}`);

            // Validate that all variables exist
            if (toggle.length && nav.length && bodypd.length && headerpd.length) {
                toggle.on('click', () => {
                    // show navbar
                    nav.toggleClass('show');
                    // change icon
                    toggle.toggleClass('bx-x');
                    // add padding to body
                    bodypd.toggleClass('body-pd');
                    // add padding to header
                    headerpd.toggleClass('header-pd');
                    headerpd.toggleClass('body-pd');
                });
            }
        };

        showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header');
    });
</script>

</html>
