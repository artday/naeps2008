<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventParticipant as Participant;
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
        return view('events.index')->with('user', request()->user())->with('events', $events);
    }

    /**
     *  return event
     */
    public function event(Event $event)
    {
        return view('events.event', compact('event'))->with('user', request()->user());
    }



    public function participate(Event $event)
    {

        if($event->users()->where('user_id', Auth::user()->id)->first())
        {
            return back()->with('warning', 'Ви вже учасник події');
        }

        $event->users()->attach(Auth::user()->id);

        return redirect()->back()->with('success', 'Ви прийняли участь у події');
    }

    public function leaveEvent(Event $event)
    {
        $event->users()->detach(Auth::user()->id);
        return redirect()->back()->with('success', 'Ви залишили подію');
    }

}
