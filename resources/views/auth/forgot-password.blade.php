@extends('layouts.login')

@section('content')

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="card card-outline card-primary">
                <div class="card-header text-center">
                    <a href="../../index2.html" class="h1"><b>Admin</b>LTE</a>
                </div>


                <!-- Session Status -->


                <!-- Validation Errors -->
                <span class="invalid-feedback" role="alert">
                </span>
                <div class="card-body login-box-msg">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Şifrenizi sıfırlamak için size bir mail göndereceğiz.') }}
                    </div>

                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input id="email" class="form-control" type="email" name="email" :value="old('email')"
                                required autofocus />
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit"
                                    onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();"
                                    class="btn btn-primary btn-block">{{ __('Email Password Reset Link') }}</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>

                    </form>
                    <p class="mt-3 mb-1">
                        <a href="login.html">Login</a>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    @endsection
