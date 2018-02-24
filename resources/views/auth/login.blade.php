@extends('layouts.default')

@section('content')

    @if(Session::exists('request_reactivation_link'))
        <a class="forgot-link" href="{{ route('auth.activate.resend') }}">Resend activation email</a>
    @endif

    <div class="slider-wrapper">

        <div class="slider-toggler flex">
            <div class="btn-gr -full">
                <a href="{{ route('login') }}" class="btn focus">Login<i data-feather="log-in"></i></a>
                <a href="{{ route('register') }}" class="btn">Register<i data-feather="user-plus"></i></a>
            </div>
        </div>

        {{-- Login Form --}}
        <form action="{{ route('login') }}" method="POST" class="res-form" >

            <div class="res-form-group{{ $errors->has('email') ? ' form-error' : '' }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input id="email" type="email" name="email" value="{{ old('email') }}" >
                <label for="email" class="">E-Mail Address</label>
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

            <label>
                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>

            <button type="submit" class=""><span>Log in</span></button>
            {{ csrf_field() }}

        </form>
    </div>
    {{-- Forgot link --}}
    <a class="forgot-link" href="{{ route('password.request') }}">Forgot Your Password?</a>

@endsection
