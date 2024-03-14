@extends('layouts.dashboard', ['section' => 'Dashboard', 'header' => ['title' => 'Favourite Stores', 'icon' => 'bx bx-heart']])
@section('content')
    <div class="title-container mb-3">
        <div class="row">
            <div class="col-md-4 col-sm-12 mb-2 mt-4">
                <div class="search-container w-100">
                    <i class="bx bx-search search-icon"></i>
                    <input type="text" class="search-input" id="search-input" placeholder="{{ __('global.search') }}">
                </div>
            </div>
        </div>
    </div>

    @if (!count($owned_shops) && !count($shops))
        <div class="text-center mt-5 text-white">
            <img src="{{ asset('img/NotFound.png') }}" alt="stores-not-found" width="275px" class="mt-3"><br>
            <a class="btn btn-search mt-5 rounded-pill" href="{{ route('dashboard.explore.index') }}"><i class='bx bx-search-alt-2'></i> Explore Stores</a>
        </div>
    @endif

    <div class="row">
        @foreach ($owned_shops as $shop)
            <div class="card shop-card">
                <a class="text-decoration-none text-black"
                    href="{{ route('dashboard.shop.show', ['shop' => $shop->subdomain]) }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 mt-3">
                                <img src="{{ asset($shop->config['banner_img']) }}" alt="logo_{{ $shop->name }}"
                                    class="rounded-circle" width="70px" height="70px">
                            </div>
                            <div class="col-9">
                                <div>
                                    <span class="h4 shop_name"><b>{{ $shop->name }}</b></span><br>
                                    <span class="text-muted">{{ $shop->description }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a class="btn-favorite bg-warning rounded-circle"
                    href="{{ route('dashboard.shop.panel.overview', ['shop' => $shop->subdomain]) }}"><i
                        class='bx bx-cog align-middle'></i></a>
            </div>
        @endforeach

        @foreach ($shops as $shop)
            <div class="card shop-card">
                <a class="text-decoration-none text-black"
                    href="{{ route('dashboard.shop.show', ['shop' => $shop->subdomain]) }}">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3 mt-3">
                                <img src="{{ asset($shop->config['banner_img']) }}" alt="logo_{{ $shop->name }}"
                                    class="rounded-circle" width="70px" height="70px">
                            </div>
                            <div class="col-9">
                                <div>
                                    <span class="h4 shop_name"><b>{{ $shop->name }}</b></span><br>
                                    <span class="text-muted">{{ $shop->description }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <a class="btn-favorite rounded-circle"
                    href="{{ route('dashboard.user.shop.unmark', ['shop' => $shop->subdomain]) }}"><i
                        class='bx bx-heart align-middle'></i></a>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        $('#search-input').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('.shop-card').each(function() {
                var shopName = $(this).find('.shop_name').text().toLowerCase();
                if (shopName.indexOf(value) > -1) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
    </script>
@endsection
