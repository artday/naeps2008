@extends('layouts.default')
@section('content')
<h4>Upcoming Events:</h4><br>

@foreach($events as $event)
<div class="card">
   <h3>
       <a href="{{ route('event',$event->id) }}">{{ $event->name }}</a>
   </h3>
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
    <div>
        <i data-feather="users" style="color: silver"></i>
        <strong>Учасники ({{ $event->participants->count() }}): </strong>
        @foreach($event->participants as $participant)
            {{ $participant->user->login }}
        @endforeach
        {{--{{ var_dump($event->participants) }}--}}
        {{--Король Василь, Шевченко Юрій, Діма Юрченко, Тромпак Василь--}}
    </div>

    <div class="btn-gr -right">
        <a class="btn" href="{{ route('event.participate', ['eventId'=>$event->id]) }}"><i data-feather="plus"></i><span>Взяти участь</span></a>
    </div>
</div><br>

@endforeach

@endsection
