@extends('layouts.default')
@section('content')
    <h4>{{ $user->login."'s profile" }}</h4>
    @include('user.partials.userblock')
    <strong>ПІБ:</strong> {{ $user->fullName }}
    <br>
    <strong>Тел:</strong> {{ $user->profile->tel }}

    <br><br>
    @if($user->id == Auth::user()->id)
    <div class="btn-gr -full">
        <a class="btn" href="{{ route('profile.update') }}">Редагувати</a>
    </div>
    @endif
@endsection