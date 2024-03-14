@extends('layouts.dashboard', ['section' => 'Vouchers', 'header' => ['title' => __('cruds.vouchers.title_wallet'), 'icon' => 'fa-solid fa-ticket me-1', 'return' => route('dashboard.main')]])
@section('content')
    <div>
        <div class="container my-4">
            <div class="row text-center">
                <div class="col-4">
                    <button class="btn btn-primary w-100 btn-tab" data-tab="active_vouchers">{{ __('global.active') }}</button>
                </div>
                <div class="col-4">
                    <button class="btn w-100 btn-tab" data-tab="used_vouchers">{{ __('global.used') }}</button>
                </div>
                <div class="col-4">
                    <button class="btn w-100 btn-tab" data-tab="expired_vouchers">{{ __('global.expired') }}</button>
                </div>
            </div>
        </div>

        <div class="row" id="active_vouchers">
            @foreach ($vouchers as $voucher)
                {{ view('partials.vouchers.card', compact('voucher')) }}
            @endforeach
        </div>

        <div id="used_vouchers" class="d-none row">
            @foreach ($used_vouchers as $voucher)
                {{ view('partials.vouchers.card', compact('voucher')) }}
            @endforeach
        </div>

        <div id="expired_vouchers" class="d-none row">
            @foreach ($expired_vouchers as $voucher)
                {{ view('partials.vouchers.card', compact('voucher')) }}
            @endforeach
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.btn-tab').click(function() {
                openTab($(this).data('tab'));

                $('.btn-tab').removeClass('btn-primary');
                $(this).addClass('btn-primary');
            });
        });

        function openTab(tabName) {
            $('#expired_vouchers').addClass('d-none');
            $('#used_vouchers').addClass('d-none');
            $('#active_vouchers').addClass('d-none');

            $('#' + tabName).removeClass('d-none');
        }
    </script>
@endsection
