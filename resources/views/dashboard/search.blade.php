@extends('layouts.dashboard', ['section' => 'Search', 'header' => ['title' => __('cruds.search.title'), 'icon' => 'bx bx-search', 'return' => route('dashboard.main')]])
@section('content')
    <div class="title-container mb-3">
        <div class="row text-center">
            <div class="col-md-4"></div>
            <div class="col-md-4 col-sm-12 mb-2 mt-4">
                <form action="{{ route('dashboard.search.shop') }}" method="POST">
                    @csrf
                    <div class="search-container w-100">
                        <i class="bx bx-search search-icon"></i>
                        <input type="text" class="search-input" id="search-input" name="search_input" placeholder="Store Code">
                    </div>
                    <button class="btn btn-search mt-3 rounded-pill w-100">
                        <i class='bx bx-search-alt-2'></i> Search Store
                    </button>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection
