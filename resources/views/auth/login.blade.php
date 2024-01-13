@extends('layouts.app', ['section' => 'Login'])
@section('content')
<!-- Section: Design Block -->
<section class="background-radial-gradient">
    <div class="login-container">
        <div class="container px-4 py-5 px-md-5 text-center text-lg-start">
            <div class="row gx-lg-5 align-items-center mb-5 mt-5">
              <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                  The best offer <br />
                  <span style="color: hsl(218, 81%, 75%)">for your business</span>
                </h1>
                <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                  Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                  Temporibus, expedita iusto veniam atque, magni tempora mollitia
                  dolorum consequatur nulla, neque debitis eos reprehenderit quasi
                  ab ipsum nisi dolorem modi. Quos?
                </p>
              </div>

              <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                <div class="card bg-glass text-white">
                  <div class="card-body px-4 py-5 px-md-5">
                    <h2>Login</h2>
                    <hr>
                    <div>
                        <!-- Register buttons -->
                        <div class="text-center">
                            <h5 class="fw-normal pb-3 mb-2 text-white" >Sign in with:</h5>
                            <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-google"></i>
                            </button>

                            <button type="button" class="btn btn-link btn-floating mx-1">
                            <i class="fab fa-twitter"></i>
                            </button>

                            <div class="divider align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0 text-white">Or</p>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <!-- Email input -->
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" autofocus placeholder="{{ trans('global.login_email') }}" name="email" value="{{ old('email', null) }}">
                            <label for="email">Email address</label>

                            @if ($errors->has('email'))
                              <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                              </div>
                            @endif
                        </div>

                        <!-- Password input -->
                        <div class="form-floating">
                            <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password" placeholder="{{ trans('global.login_password') }}">
                            <label for="password">Password</label>
                        </div>

                        <div class="checkbox checkbox-css m-b-30 row mt-3 d-inline-block">
                          <div class="icheck-primary">
                            <input type="checkbox" name="remember" id="remember">
                            <label for="remember">{{ trans('global.remember_me') }}</label>
                          </div>
                        </div>

                        <!-- Forgot Password link -->
                        <div class="justify-content-end mb-3 d-inline-block mt-3" style="float: right;">
                            <a href="#" class="ms-auto">Forgot Password?</a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-block mb-3 w-100 mt-4">
                            <i class="bi bi-box-arrow-in-right"></i> {{ trans('global.login') }}
                        </button>

                        <p class="text-center">Not have an account? <a href="#">Register here</a></p>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </section>
  <!-- Section: Design Block -->
@endsection
