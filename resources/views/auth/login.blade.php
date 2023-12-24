@extends('layouts.app', ['section' => 'Login'])
@section('content')

<div class="login_content">
    <div class="login_left_bg">
        <div class="image-bg" style="background-image:url('{{ asset('img/bg-admin-default.jpg') }}');"></div>
    </div>
    <div class="login_right_bg">

        <div class="login-header">
            <div class="brand text-center pb-5">
                <a title="{{ trans('global.site_title') }}" href="{{ route('dashboard.main') }}">
                    <img src="{{ asset('img/logo-default.png') }}" class="img-fluid" alt="{{ trans('global.site_title') }}">
                </a>
            </div>
        </div>

        <div class="login-buttons">
            <button type="button" class="btn btn-primary btn-block btn-lg">
                {{ trans('global.login_with') }}
            </button>

            <div class="d-flex py-4">
                <hr class="my-auto flex-grow-1 bg-light">
                <div class="px-4">OR</div>
                <hr class="my-auto flex-grow-1 bg-light">
            </div>
        </div>

        <div class="login-content">
            @if (session()->has('message'))
                <p class="alert alert-info">
                    {{ session()->get('message') }}
                </p>
            @endif

            <form action="{{ route('login') }}" method="POST" class="margin-bottom-0">
                @csrf
            <div class="form-group m-b-15">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
            <div class="form-group m-b-15">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg" name="password" placeholder="{{ trans('global.login_password') }}">

                @if ($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <div class="checkbox checkbox-css m-b-30 row">
                <div class="col-lg-5">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">{{ trans('global.remember_me') }}</label>
                </div>
                </div>
                <div class="col-lg-7 text-right">
                    @if (Route::has('password.request'))
                        <p class="mb-1">
                            <a class="rcp" href="{{ route('password.request') }}">
                                {{ trans('global.forgot_password') }}
                            </a>
                        </p>
                    @endif
                </div>
            </div>
            <div class="login-buttons">
                <button type="submit" class="btn btn-primary btn-block btn-lg">
                    {{ trans('global.login') }}
                </button>
            </div>
                <hr>
                <p class="text-center copyright">&copy; {{ trans('global.site_title') }} - Todos los derechos
                    reservados -
                    {{ now()->year }}</p>
            </form>
        </div>

    </div>
</div>
@endsection
