@extends('layouts.dashboard', ['section' => $shop->name])
@section('styles')
    <style>
        .container-fluid {
            font-family: {{ $shop->config['font'] ?? 'Arial, sans-serif' }};
        }

        .logo-container {
            background-color: {{ $shop->config['colors']['primary'] ?? 'brown' }};
        }

        .rewards-container {
            background-color: {{ $shop->config['colors']['secondary'] ?? 'white' }};
        }

        .reward-card {
            background-color: {{ $shop->config['colors']['reward_card'] ?? 'beige' }};
        }

        .icon-reward.collected {
            color: {{ $shop->config['colors']['primary'] ?? 'brown' }};
        }

        .reward-list .h3,
        .reward-list .reward-text {
            color: {{ $shop->config['colors']['texts'] ?? 'white' }};
        }

        .btn-qr {
            color: {{ $shop->config['colors']['button_text'] ?? 'white' }};
            background-color: {{ $shop->config['colors']['button'] ?? 'blue' }};
        }

        .progress-bar {
            background-color: {{ $shop->config['colors']['primary'] ?? 'brown' }};
        }
    </style>
@endsection
@section('content')
    <button class="btn btn-qr fixed-button" data-bs-toggle="modal" data-bs-target="#qrModal"><i
            class='bx bx-qr align-middle me-1'></i> Your QR</button>

    <div class="container-fluid">
        <div class="logo-container p-5">
            <a class="top-0 start-0 my-1 p-3 mx-2 text-black" href="{{ route('dashboard.main') }}" style="position: absolute; font-size: 34px; text-decoration: none;"><i class='bx bxs-chevron-left'></i></a>
            <div class="col-sm-12 justify-content-center">
                <img src="https://dr8h81twidjpw.cloudfront.net/uploads/popup_setting/popup_logo_img/No_Background_2006300656.png"
                    alt="shop_logo" class="img-fluid px-4 shop_logo">
            </div>
        </div>
        <div class="rewards-container px-4">
            <div class="row">
                <div class="reward-card card justify-content-center">
                    <div class="card-body p-3 text-center">
                        @if ($shop->type == 'loop')
                            <div class="grid-container mb-2">
                                @for ($i = 0; $i < $shop->config['times_for_reward'] ?? 7; $i++)
                                    <div class="circle">
                                        <i
                                            class="icon-reward {{ $user->getRewardsCollected($shop) > $i ? 'collected' : '' }}
                                        {{ $shop->config['loop_icon'] }}"></i>
                                    </div>
                                @endfor
                            </div>
                        @else
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: {{$user->getProgressBar($shop)}}%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="5000">
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                @if ($shop->type == 'loop')
                    <div class="mt-3 text-center">
                        <p class="h4">Rewards collected: <b>{{ $user->getTimesRewardCollected($shop) }}</b></p>
                    </div>
                @else
                    <div class="text-center">
                        <p class="h3 mt-3">Level: {{ $user->getLevelOnShop($shop) }}</p>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="reward-list py-4">
                    <p class="h3"><b>Reward List</b></p>

                    @if ($shop->type == 'loop')
                        <div class="card" style="border-radius: 0;">
                            <div class="card-body">
                                <div>
                                    <div class="d-inline-block">
                                        <span class="reward-text h5">Reward: {{ $shop->config['loop_reward'] ?? 'None' }}</span><br>
                                        <span>Loop</span>
                                    </div>

                                    <div class="pull-right">
                                        <span class="reward-text"><i class='bx bx-infinite' style="font-size: 28px;"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        @foreach ($shop->shopLevels as $idx => $level)
                            <div class="card {{ $user->getLevelOnShop($shop) < $level->level ? 'blocked-card' : '' }}" style="border-radius: 0;">
                                <div class="card-body">
                                    <div>
                                        <div class="d-inline-block">
                                            <span class="reward-text h5">Reward: {{ $level->reward }}</span><br>
                                            <span>Level {{ $level->level }}</span>
                                        </div>

                                        <div class="pull-right">
                                            @if ($user->getLevelOnShop($shop) >= $level->level)
                                                <span class="reward-text"><i class='bx bx-lock-open-alt'></i> Unlocked</span>
                                            @else
                                                <span class="reward-text text-danger"><i class='bx bx-lock-alt'></i> Blocked</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="{{ route('dashboard.shop.generate.qr', ['shop' => $shop->subdomain]) }}" alt="Código QR"
                        class="qr-img img-fluid">
                    <p class="h3"><b>{{ $user->code }}</b></p>
                    <p class="h4">{{ $user->fullName }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class='bx bx-x align-middle'></i> Close</button>
                </div>
            </div>
        </div>
    </div>
@endsection
