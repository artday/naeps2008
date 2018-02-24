@extends('layouts.default')
@section('content')
            <h3>{{ $event->name }}</h3>
            <br>
            <div style="float: left">
                <i data-feather="calendar" style="color: silver"></i>
                <strong>Дата: </strong>
                {{ $event->date() }}
            </div>
            <div>
                <i data-feather="map-pin" style="color: silver"></i>
                <strong>Місто: </strong>
                {{ $event->location() }}
            </div>
            <br>
            <div>
                <i data-feather="users" style="color: silver"></i>
                <strong>Учасники ({{ $event->participants->count() }}): </strong>
                @foreach($event->participants as $participant)
                    {{ $participant->user->login }}
                @endforeach
                {{--Король Василь, Шевченко Юрій, Діма Юрченко, Тромпак Василь--}}
            </div>

            <div class="btn-gr -right">
                <a class="btn"><i data-feather="plus"></i><span>Взяти участь</span></a>
            </div>
@endsection