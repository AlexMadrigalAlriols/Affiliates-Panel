<div class="align-self-start">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item border-bottom" role="presentation">
            <a class="nav_link {{ $section === 'general' ? 'active' : '' }}" id="general-tab" href="{{ route('dashboard.shop.panel.configuration', ['shop' => $shop->subdomain]) }}">
                <i class='bx bx-cog nav_icon'></i> General
            </a>
        </li>
        <li class="nav-item border-bottom" role="presentation">
            <a class="nav_link {{ $section === 'appearance' ? 'active' : '' }}" id="appearance-tab" href="{{ route('dashboard.shop.panel.configuration.appearance.index', ['shop' => $shop->subdomain]) }}">
                <i class='bx bx-palette nav_icon'></i> Appearance
            </a>
        </li>
        <li class="nav-item border-bottom">
            <a class="nav_link {{ $section === 'rewards' ? 'active' : '' }}" id="rewards-tab" href="{{ route('dashboard.shop.panel.configuration.rewards.index', ['shop' => $shop->subdomain]) }}">
                <i class='bx bx-gift nav_icon'></i> Shop Rewards
            </a>
        </li>
        <li class="nav-item border-bottom">
            <a class="nav_link {{ $section === 'roles' ? 'active' : '' }}" id="members-tab" href="{{ route('dashboard.shop.panel.configuration.roles.index', ['shop' => $shop->subdomain]) }}">
                <i class='bx bxs-user-detail nav_icon'></i> Member Roles
            </a>
        </li>
        <li class="nav-item border-bottom">
            <a class="nav_link {{ $section === 'logs' ? 'active' : '' }}" id="logs-tab" href="{{ route('dashboard.shop.panel.configuration.logs.index', ['shop' => $shop->subdomain]) }}">
                <i class='bx bx-notepad nav_icon'></i> Action Logs
            </a>
        </li>
        @if ($shop->active)
            <li class="nav-item  mt-3">
                <button class="btn btn-outline-danger w-100">
                    <i class='bx bx-trash align-baseline me-1'></i>
                    Disable Shop
                </button>
            </li>
        @else
            <li class="nav-item  mt-3">
                <button class="btn btn-outline-success w-100">
                    <i class='bx bxs-show align-baseline me-1'></i>
                    Enable Shop
                </button>
            </li>
        @endif
    </ul>
</div>
