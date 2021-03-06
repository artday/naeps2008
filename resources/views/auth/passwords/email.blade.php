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
        <form id="log-form" action="{{ route('password.email') }}" method="POST" class="res-form" >

            <div class="res-form-group{{ $errors->has('email') ? ' form-error' : '' }}">
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input id="log-email" type="email" name="email" value="{{ old('email') }}" >
                <label for="log-email" class="">E-Mail Address</label>
            </div>

            <button form="log-form" type="submit" class=""><span>Send Password Reset Link</span></button>
            {{ csrf_field() }}

        </form>
    </div>

@endsection


