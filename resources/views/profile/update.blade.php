@extends('layouts.default')
@section('content')
    <div class="alert alert-info" role="alert">
        Завантаження aватара поки що не доступне...
        наразі використовується сервіс gravatar. Щоб поміняти аватар, прив'яжіть його до свого email на
        <a href="https://gravatar.com" target="_blank">gravatar.cом</a>
    </div>

    <form class="res-form" action="" method="post">

        <div class="res-form-group{{ $errors->has('login') ? ' form-error' : '' }}">
            @if ($errors->has('login'))
                <span class="help-block">
                        <strong>{{ $errors->first('login') }}</strong>
                </span>
            @endif
            <input type="text" name="login" id="login" value="{{ Request::old('login') ?: $user->login }}">
            <label for="login">Login</label>
        </div>

        <div class="res-form-group{{ $errors->has('first_name') ? ' form-error' : '' }}">
            @if ($errors->has('first_name'))
                <span class="help-block">
                        <strong>{{ $errors->first('first_name') }}</strong>
                </span>
            @endif
            <input type="text" name="first_name" id="first_name" value="{{ $user->profile->first_name }}">
            <label for="first_name">Ім'я</label>
        </div>

        <div class="res-form-group{{ $errors->has('middle_name') ? ' form-error' : '' }}">
            @if ($errors->has('middle_name'))
                <span class="help-block">
                        <strong>{{ $errors->first('middle_name') }}</strong>
                </span>
            @endif
            <input type="text" name="middle_name" id="middle_name" value="{{ $user->profile->middle_name }}">
            <label for="middle_name">По батькові</label>
        </div>

        <div class="res-form-group{{ $errors->has('last_name') ? ' form-error' : '' }}">
            @if ($errors->has('last_name'))
                <span class="help-block">
                        <strong>{{ $errors->first('last_name') }}</strong>
                </span>
            @endif
            <input type="text" name="last_name" id="last_name" value="{{ $user->profile->last_name }}">
            <label for="last_name">Прізвище</label>
        </div>

        <div class="res-form-group{{ $errors->has('tel') ? ' form-error' : '' }}">
            @if ($errors->has('tel'))
                <span class="help-block">
                        <strong>{{ $errors->first('tel') }}</strong>
                </span>
            @endif
            <input type="tel" name="tel" id="tel" value="{{ $user->profile->tel ? $user->profile->tel : '+380' }}">
            <label for="tel">Телефон</label>
        </div>

        <button type="submit" class=""><span>Зберегти</span></button>
        {{ csrf_field() }}

    </form>
    <br>

@endsection