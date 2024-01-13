@extends('layouts.dashboard', ['section' => $shop->name])
@section('content')
    <div class="title-container">
        <span class="text-white h4 py-2 px-1" style="border-bottom: 2px solid white;">
            <i class='bx bx-grid-alt align-middle'></i>
            {{$shop->name}}
        </span>
    </div>

    <div class="row justify-content-center">
        <div class="card qr-card text-center ">
            <div class="card-body py-5">
                <img src="{{ route('dashboard.shop.generate.qr', ['shop' => $shop->subdomain]) }}" alt="Código QR" class="qr-img img-fluid">
                <p class="h3"><b>{{ auth()->user()->code }}</b></p>
                <p class="h4">{{ auth()->user()->fullName }}</p>
                <p class="h5">Nivel 5</p>
            </div>
        </div>
    </div>

    <button class="btn btn-primary fixed-button"><i class='bx bxs-star align-baseline me-1'></i> Shop Rewards</button>
@endsection
