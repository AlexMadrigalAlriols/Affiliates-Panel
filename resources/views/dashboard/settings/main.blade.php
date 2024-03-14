@extends('layouts.dashboard', ['section' => 'Settings', 'header' => ['title' => __('cruds.settings.title') . ' - ' . ucfirst($section), 'icon' => 'bx bx-cog', 'return' => route('dashboard.settings.index')]])
@section('content')
    <div class="title-container mb-1 mt-2">
        <div class="row">
            <div class="col-md-2 col-lg-4"></div>
            <div class="col-sm-12 col-md-8 col-lg-4">
                <div class="card position-relative header-settings">
                    <div class="card-body">
                        @include('dashboard.settings.' . $section)
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-lg-4"></div>
        </div>
    </div>
@endsection
