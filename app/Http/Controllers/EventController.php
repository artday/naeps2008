<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  List of Events
     */
    public function index()
    {
        $events = Event::get();
        return view('events.index')->with('events', $events);
    }

    /**
     *  return event
     */
    public function event(Request $request)
    {
        $event = Event::find($request->eventId);
        return view('events.event', ['event'=>$event]);
    }


    public function participate(Request $request)
    {
        $event = Event::find($request->eventId);

//        if(Auth::user()->isParticipant($event))
        if(Auth::user()->isParticipant($event))
        {
            return redirect()->back()->with('warning', 'Ви вже приєднані до події');
        }
        EventParticipant::create([
            'user_id'=>Auth::user()->id,
            'event_id'=> $event->id
        ]);

//        dd($participant);

        return redirect()->back()->with('success', 'Ви прийняли участь у події');
    }

}
