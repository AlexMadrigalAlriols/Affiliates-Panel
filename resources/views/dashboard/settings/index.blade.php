@extends('layouts.dashboard', ['section' => 'Settings', 'header' => ['title' => __('cruds.settings.title'), 'icon' => 'bx bx-cog', 'return' => route('dashboard.main')]])
@section('content')
    <div class="title-container mb-1 mt-5">
        <div class="row">
            <div class="col-md-2 col-lg-4"></div>
            <div class="col-sm-12 col-md-8 col-lg-4">
                <div class="card position-relative header-settings">
                    <div>
                        <img src="{{ $user->profile_img }}" alt="" class="rounded-circle profile-img-header" width="75px" height="75px">
                        <a href="/edit" class="m-3 btn btn-primary position-absolute top-0 end-0"><i
                                class='bx bx-edit-alt'></i> Edit</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <p class="h4"><b>{{ $user->full_name }}</b></p>
                            <p class="h6">{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-4"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-lg-4"></div>
        <div class="col-sm-12 col-md-8 col-lg-4 p-4">
            @foreach ($settings as $setting)
                <a class="btn btn-setting w-100 text-start p-3 position-relative mb-3" href="{{ $setting['url'] }}">
                    <i class='{{ $setting['icon'] }} align-middle me-3 f-30'></i>
                    <b>{{ $setting['title'] }}</b>
                    <i class='bx bxs-chevron-right position-absolute end-0 align-middle me-3 mt-1 f-24'></i>
                </a>
            @endforeach
        </div>
        <div class="col-md-2 col-lg-4"></div>
    </div>
@endsection
