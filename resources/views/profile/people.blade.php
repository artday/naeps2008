@extends('layouts.default')
@section('content')
    <h4>Група НАЕПС-2008</h4>

    @foreach($people as $user)
        <a class="clr" href="{{ route('profile', ['user'=>$user]) }}">
            @include('user.partials.userblock')
        </a>
    @endforeach


@endsection