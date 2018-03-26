@extends('layouts.default')
@section('content')

            <h3>{{ $event->name }}</h3>
            <div class="v-center" >
                <i data-feather="calendar"></i>
                <span>
                    <strong>Дата:</strong> {{ $event->date() }} (на голосуванні)
                </span>
            </div>
            <div class="v-center">
                <i data-feather="map-pin"></i>
                <span>
                    <strong>Місто: </strong>{{ $event->location() }}
                </span>
            </div>
            <div class="v-center">
                <i data-feather="users"></i>
                <span>
                    <strong>Учасники ({{ $event->participants()->count() }}): </strong>
                    @foreach($event->participants() as $participant)
                        {{ $participant->login }}
                    @endforeach
                </span>
            </div>

            @if(!Auth::user()->isParticipant($event))
                <div class="btn-gr -right">
                    <a class="btn" href="{{ route('event.participate', ['eventId'=>$event->id]) }}">
                        <i data-feather="plus"></i>
                        <span>Взяти участь</span>
                    </a>
                </div>
            @endif




@endsection