@extends('layouts.default')

@section('content')

    @if(Session::exists('request_reactivation_link'))
        <a class="forgot-link" href="{{ route('auth.activate.resend') }}">Resend activation email</a>
    @endif

    <div class="slider-wrapper">

        <div class="slider-toggler flex">
            <div class="btn-gr -full">
                <a href="{{ route('login') }}" class="btn">Login<i data-feather="log-in"></i></a>
                <a href="{{ route('register') }}" class="btn  focus">Register<i data-feather="user-plus"></i></a>
            </div>
        </div>

        {{-- Register Form --}}
        <form action="{{ route('register') }}" method="POST" class="res-form" >

            <div class="res-form-group{{ $errors->has('login') ? ' form-error' : '' }}">
                @if ($errors->has('login'))
                    <span class="help-block">
                        <strong>{{ $errors->first('login') }}</strong>
                    </span>
                @endif
                <label for="login" class="">Login</label>
                <input id="login" type="text" class="" name="login" value="{{ old('login') }}" >
            </div>

            <div class="res-form-group{{ $errors->has('email') ? ' form-error' : '' }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <label for="email" class="">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" >
            </div>

            <div class="res-form-group{{ $errors->has('password') ? ' form-error' : '' }}">
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                <label for="password" class="">Password</label>
                <input id="password" type="password" class="" name="password" >
            </div>

            <div class="res-form-group{{ $errors->has('password_confirmation') ? ' form-error' : '' }}">
                @if ($errors->has('password_confirmation'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                    </span>
                @endif
                <label for="password-confirm" class="">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
            </div>

            <button type="submit" class=""><span>Register</span></button>
            {{ csrf_field() }}

        </form>
    </div>
    {{-- Forgot link --}}
    <a class="forgot-link" href="{{ route('password.request') }}">Forgot Your Password?</a>

@endsection
