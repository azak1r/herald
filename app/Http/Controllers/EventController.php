<?php

namespace nullx27\Herald\Http\Controllers;

use Carbon\Carbon;
use nullx27\Herald\Notifications\Discord;
use Vinkla\Hashids\Facades\Hashids;
use Illuminate\Support\Facades\Auth;
use nullx27\Herald\Http\Requests\EventFormRequest;
use nullx27\Herald\Jobs\AnnounceEvent;
use nullx27\Herald\Models\Event;
use Illuminate\Http\Request;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::where('due', '>', Carbon::now())
            ->where('user_id', '=', Auth::user()->id)
            ->orderBy('due', 'asc')
            ->paginate(7);

        $sorted = [];

        foreach ($events as $event) {
            $date  = Carbon::parse($event->due)->toDateString();
            $sorted[$date][] = $event;
        }

        ksort($sorted);

        return view('event.index', ['dates' => $sorted, 'raw_events' => $events]);
    }

    public function all()
    {
        $events = Event::where('due', '>', Carbon::now())
            ->orderBy('due', 'asc')
            ->paginate(7);

        $sorted = [];

        foreach ($events as $event) {
            $date  = Carbon::parse($event->due)->toDateString();
            $sorted[$date][] = $event;
        }

        ksort($sorted);

        return view('event.index', ['dates' => $sorted, 'raw_events' => $events]);
    }

    public function old()
    {
        $events = Event::where('due', '<', Carbon::now())
            ->orderBy('due', 'desc')
            ->paginate(7);

        $sorted = [];

        foreach ($events as $event) {
            $date  = Carbon::parse($event->due)->toDateString();
            $sorted[$date][] = $event;
        }

        ksort($sorted);

        return view('event.index', ['dates' => $sorted, 'raw_events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event();

        return view('event.create', ['event' => $event]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EventFormRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventFormRequest $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->description = $request->description;
        $event->due = Carbon::parse($request->due);
        $event->user_id = auth()->user()->id;

        $event->save();

        return redirect()->route('events.show', $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \nullx27\Herald\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('event.show', ['event' => $event]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \nullx27\Herald\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {

        return view('event.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EventFormRequest  $request
     * @param  \nullx27\Herald\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventFormRequest $request, Event $event)
    {

        $event->title = $request->title;
        $event->description = $request->description;
        $event->due = Carbon::parse($request->due);

        $event->save();

        return redirect()->route('events.show', $event->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \nullx27\Herald\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if(!Auth::user()->can('delete', $event)) {
            return abort(403, 'Not authroized for that action');
        }

        $event->delete();

        return redirect()->route('events.index');

    }

    /**
     * @param Event $event
     * @return \Illuminate\Http\RedirectResponse
     */
    public function announce(Event $event)
    {

        dd($event->notify(new Discord()));
        //dispatch(new AnnounceEvent($event));

        return back();

    }

    /**
     * @param Request $request
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function countdown(Request $request, $id)
    {
        $real_id = Hashids::decode($id)[0];

        $event = Event::findOrFail($real_id);

        return view('countdown.index', ['event' => $event]);
    }
}
