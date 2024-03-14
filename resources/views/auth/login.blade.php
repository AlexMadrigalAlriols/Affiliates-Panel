@extends('layouts.app', ['section' => 'Login'])
@section('content')
    <div>
        <div class="row p-0 m-0">
            <div class="col-md-5 p-0 col-lg-8 background-container">
                <div class="container-fluid h-100 p-0 d-flex justify-content-center align-items-center">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="col-lg-6 p-3">
                        <h1 class="mb-5 display-5 fw-bold ls-tight" style="color: #242424;">
                          The best offer <br />
                          <span style="color: #4723d9;">for your business</span>
                        </h1>
                        <p class="mb-4 opacity-70" style="color: #242424;">
                          Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                          Temporibus, expedita iusto veniam atque, magni tempora mollitia
                          dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                          ab ipsum nisi dolorem modi. Quos?
                        </p>
                      </div>
                </div>
            </div>
            <div class="col-md-7 col-sm-12 p-0 col-lg-4">
                <div class="container-fluid p-0">
                    <div class="login-container">
                        <div class="header-card d-flex flex-column justify-content-center align-items-center">
                            <div class="text-center" style="font-size: 40px; margin-top: 4rem;">
                                <i class='bx bx-layer nav_logo-icon'></i> <span class="nav_logo-name">Affiliates<span
                                        style="color: #4723d9;">Hub</span></span>
                            </div>
                            <div class="mt-auto mb-3">
                                <div class="row fs-4">
                                    <div class="col-5">
                                        <a href="{{ route('login') }}"
                                            class="p-3 active border-bottom border-5 text-black text-decoration-none"><b>{{ __('global.auth.login_box_title') }}</b></a>
                                    </div>
                                    <div class="col-2"></div>
                                    <div class="col-5">
                                        <a href="{{ route('register') }}"
                                            class="p-3 text-black text-decoration-none"><b>{{ __('global.auth.register_box_title') }}</b></a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row p-4 text-white mt-3 me-0">
                            <form action="{{ route('login') }}" class="p-4" method="POST">
                                @csrf
                                <div class="col-12">
                                    <div class="auth-input {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                        <input type="text" name="email" id="email" autofocus autocomplete="email"
                                            value="{{ old('email') }}" required>
                                        <label for="email">{{ __('cruds.users.fields.email_long') }}</label>
                                    </div>
                                    @if ($errors->has('email'))
                                        <label for="email" class="text-danger">
                                            <small><i class='bx bx-error-circle'></i>
                                                {{ __('global.auth.invalid_credentials') }}</small>
                                        </label>
                                    @endif
                                </div>

                                <div class="col-12">
                                    <div class="auth-input mt-5">
                                        <input type="password" name="password" id="password"
                                            autocomplete="current-password" required>
                                        <label for="password">{{ __('cruds.users.fields.password') }}</label>
                                    </div>
                                    <div class="row">
                                        <div class="col-5">
                                            <div class="text-start mt-2">
                                                <input type="checkbox" id="remember" name="remember">
                                                <span for="remember">{{ __('global.auth.remember_me') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-7">
                                            <div class="text-end mt-2">
                                                <a for="password"
                                                    class="text-muted">{{ __('global.auth.forgot_password') }}?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button class="w-100 btn btn-primary rounded-pill mt-5" disabled id="login-button">
                                        <i class='bx bx-log-in me-1 align-baseline'></i> {{ __('global.auth.login_button') }}
                                    </button>
                                    <p class="text-center mt-2">{{ __('global.auth.dont_have_an_account') }}? <a
                                            href="{{ route('register') }}"
                                            class="text-white"><b>{{ __('global.auth.register_box_title') }}</b></a></p>
                                </div>
                            </form>
                        </div>

                        <div class="mt-5 text-center text-white">
                            <div class="hr-text">
                                <hr class="ms-3" />
                                <span class="px-4">{{ __('global.auth.continue_with') }}</span>
                                <hr class="me-3" />
                            </div>
                            <div class="row p-3 me-0">
                                <div class="col-4">
                                    <button class="btn btn-white w-100"><i class='bx bxl-google'></i> Google</button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-white w-100">Facebook</button>
                                </div>
                                <div class="col-4">
                                    <button class="btn btn-white w-100"><i class='bx bxl-apple'></i> Apple</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#email, #password').keyup(function() {
                if ($('#email').val() != '' && $('#password').val() != '') {
                    $('#login-button').removeAttr('disabled');
                } else {
                    $('#login-button').prop('disabled', true);
                }
            });
        });
    </script>
@endsection
