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
                    <h2><i class="bi bi-box-arrow-in-right"></i> Login</h2>
                    <hr>

                      <!-- Register buttons -->
                      <div class="text-center">
                        <p>Login with:</p>
                        <button type="button" class="btn btn-link btn-floating mx-1">
                          <i class="fab fa-facebook-f"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                          <i class="fab fa-google"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                          <i class="fab fa-twitter"></i>
                        </button>

                        <button type="button" class="btn btn-link btn-floating mx-1">
                          <i class="fab fa-github"></i>
                        </button>
                      </div>
                    <form>
                      <!-- Email input -->
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                      </div>

                      <!-- Password input -->
                      <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                      </div>

                      <!-- Submit button -->
                      <button type="submit" class="btn btn-primary btn-block mb-4 w-100">
                        Login
                      </button>
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
