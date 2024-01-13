@extends('layouts.dashboard', ['section' => 'Dashboard'])
@section('content')
    @if (count($owned_shops))
        <div class="title-container">
            <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
                <i class='bx bxs-star align-middle' ></i>
                My shops
            </span>
        </div>

        <div class="row mb-4">
            @foreach($owned_shops as $shop)
                <div class="card shop-card p-0">
                    <a class="text-decoration-none text-black" href="{{ route('dashboard.shop.show', ['shop' => $shop->subdomain]) }}">
                        <img src="{{ $shop->config['profile_img'] }}" class="card-img-top img-shop-card" alt="Banner {{ $shop->name }}">
                        <div class="card-body text-center">
                            <h4 class="card-title"><b>{{ $shop->name }}</b></h4>
                        </div>
                    </a>
                    <div class="card-footer">
                        <div class="icon-grid">
                            <div class="icon">
                                <i class='bx bx-info-circle align-middle'></i>
                            </div>
                            <a class="icon text-black" href="{{ route('dashboard.shop.panel.overview', ['shop' => $shop->subdomain]) }}">
                                <i class='bx bx-cog align-middle'></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bxs-bookmark-star align-middle'></i>
            Saved Shops
        </span>
    </div>

    <div class="row">
        @foreach($shops as $shop)
            <div class="card shop-card p-0">
                <a class="text-decoration-none text-black" href="{{ route('dashboard.shop.show', ['shop' => $shop->subdomain]) }}">
                    <img src="{{ $shop->config['profile_img'] }}" class="card-img-top img-shop-card" alt="...">
                    <div class="card-body text-center">
                        <h4 class="card-title"><b>{{ $shop->name }}</b></h4>
                    </div>
                </a>
                <div class="card-footer">
                    <div class="icon-grid">
                        <div class="icon">
                            <i class='bx bx-info-circle align-middle'></i>
                        </div>
                        <div class="icon">
                            <i class='bx bxs-bookmark-star align-middle'></i>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
