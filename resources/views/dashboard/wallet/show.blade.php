@extends('layouts.dashboard', ['section' => 'Vouchers', 'header' => ['title' => 'Voucher', 'icon' => 'fa-solid fa-ticket me-1', 'return' => route('dashboard.wallet.index')]])
@section('content')
    <div class="justify-content-center text-center">
        <div class="card mt-3" style="max-width: 30rem;">
            <div class="card-body text-center">
                <p class="h3 mb-3">{{ $voucher->reward }}</p>
                <img src="{{ route('dashboard.shop.voucher.generate-qr', ['shop' => $voucher->shop->subdomain, 'voucher' => $voucher->code]) }}" alt="Código QR"
                    class="qr-img img-fluid">
                <p class="h4"><b>{{ $voucher->code }}</b></p>
                <p class="text-muted">
                    @if ($voucher->expires_at)
                        Expries at {{ $voucher->expires_at->format('M d, Y') }}
                    @else
                        No expires
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection
