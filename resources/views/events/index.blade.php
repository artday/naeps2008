@extends('layouts.default')
@section('content')
<h4>Upcoming Events:</h4><br>

@foreach($events as $event)

<div class="card">
   <h4 class="link-header">
       <a href="{{ route('event',$event->id) }}">{{ $event->name }}</a>
   </h4>
    <div class="v-center">
        <i data-feather="calendar"></i>
        <strong>Дата: </strong>
        {{ $event->date() }}
    </div>
    <div class="v-center">
        <i data-feather="map-pin"></i>
        <strong>Місто: </strong>
        {{ $event->location() }}
    </div>
    <div class="v-center">
        <i data-feather="users" ></i>
        <strong>Учасники ({{ $event->participants()->count() }}): </strong>

        @foreach($event->participants() as $participant)
            {{ $participant->login }}
        @endforeach
    </div>

    @if(!Auth::user()->isParticipant($event))
        <div class="btn-gr -right">
            <a class="btn" href="{{ route('event.participate', ['eventId'=>$event->id]) }}">
                <i data-feather="plus"></i>
                <span>Взяти участь</span>
            </a>
        </div>
    @else
        <div class="btn-gr -right">
            <a class="btn" href="{{ route('event.leave', ['eventId'=>$event->id]) }}">
                <i data-feather="minus"></i>
                <span>Залишити</span>
            </a>
        </div>
    @endif
</div><br>

@endforeach

@endsection
