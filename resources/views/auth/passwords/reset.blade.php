@extends('layouts.default')

@section('content')

    @if(Session::exists('request_reactivation_link'))
        <a class="forgot-link" href="{{ route('auth.activate.resend') }}">Resend activation email</a>
    @endif

    <div class="slider-wrapper">

        <div class="slider-toggler flex">
            <span class="form-heading">Reset Password</span>
        </div>

        {{-- Resend Form --}}
        <form action="{{ route('password.request') }}" method="POST" class="res-form" >

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="res-form-group{{ $errors->has('email') ? ' form-error' : '' }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <label for="email" class="">E-Mail Address</label>
                <input id="email" type="email" name="email" value="{{ $email or old('email') }}">
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

            <button type="submit" class=""><span>Reset Password</span></button>
            {{ csrf_field() }}

        </form>
    </div>

@endsection
