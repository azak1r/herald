<?php

namespace nullx27\Herald\Http\Controllers;

use Carbon\Carbon;
use nullx27\Herald\Http\Requests\EventFormRequest;
use nullx27\Herald\Jobs\AnnounceEvent;
use nullx27\Herald\Models\Event;
use Illuminate\Http\Request;
use nullx27\Herald\Notifications\Discord;

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
        $event->due = $request->due;
        $event->user_id = 1; //@todo: Auth::user()->id

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
        $event->update($request->all());

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \nullx27\Herald\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
    }

    public function announce(Event $event)
    {
        dispatch(new AnnounceEvent($event));

        return back();

    }
}
