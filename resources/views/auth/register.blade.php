@extends('layouts.app', ['section' => 'Register'])
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
                {{ trans('global.register_with') }}
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

            <form action="{{ route('register') }}" method="POST" class="margin-bottom-0">
                @csrf
                <div class="form-group m-b-15">
                    <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }} form-control-lg" autocomplete="name" autofocus placeholder="{{ trans('global.login_name') }}" name="first_name" value="{{ old('first_name', null) }}">

                    @if ($errors->has('first_name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('first_name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group m-b-15">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" autocomplete="email" placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">

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
                <div class="form-group m-b-15">
                    <input id="password_confirmation" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }} form-control-lg" name="password_confirmation" placeholder="{{ trans('global.login_confirm_password') }}">

                    @if ($errors->has('confirm_password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password_confirmation') }}
                        </div>
                    @endif
                </div>
                <div class="login-buttons">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">
                        {{ trans('global.register') }}
                    </button>
                </div>
                <div class="col-lg-12 text-left">
                    <p class="mb-1">
                        <a class="rcp" href="{{ route('login') }}">
                            Already have an account?
                        </a>
                    </p>
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
