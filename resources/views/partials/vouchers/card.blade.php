<div class="card shop-card mt-2">
    <a class="text-decoration-none text-black"
        {{ $voucher->expired || $voucher->trashed() ? '' : 'href='. route('dashboard.wallet.show', ['voucher' => $voucher->code]) .''}} >
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="position-relative">
                        <span class="h4 shop_name"><b>{{ $voucher->reward }}</b></span>
                        <p class="text-muted mt-2">
                            <span class="text-danger">{{ $voucher->shop->name }}</span> -
                            @if ($voucher->trashed())
                                <span class="text-success">Used at {{$voucher->deleted_at->format('M d, Y')}}</span>
                            @elseif ($voucher->expired)
                                <span class="text-danger">Expired at {{ $voucher->expires_at->format('M d, Y') }}</span>
                            @else
                                @if ($voucher->expires_at)
                                    Valid until {{ $voucher->expires_at->format('M d, Y') }}
                                @else
                                    No expires
                                @endif
                            @endif
                        </p>
                        <p class="text-muted mt-3">{{ ucfirst($voucher->timeAgo) }}, {{ $voucher->created_at->format('M d, Y - h:i A') }}</p>
                        @if (!$voucher->expired && !$voucher->trashed())
                            <span style="position: absolute; right:0; top: 1.75rem; font-size: 28px;"><i
                                class='bx bxs-chevron-right'></i></span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </a>
</div>
