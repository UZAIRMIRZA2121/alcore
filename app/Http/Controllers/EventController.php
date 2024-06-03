<?php

// app/Http/Controllers/EventController.php

namespace App\Http\Controllers;

use App\Models\Delegate;
use App\Models\Event;
use App\Models\Sponsor;
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
        $events = Event::all();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
            'lock_date' => 'required|date',
        ]);
        $eventData = $request->all();
      
        Event::create($eventData);

        return redirect()->route('events.index')
                        ->with('success', 'Event created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $sponsors = Sponsor::where('event_id',$event->id)->get();
        $delegates = Delegate::where('event_id',$event->id)->get();
        return view('admin.events.show', compact('event', 'sponsors', 'delegates'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'name' => 'required',
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);

        $event->update($request->all());

        return redirect()->route('events.index')
                        ->with('success', 'Event updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index')
                        ->with('success', 'Event deleted successfully.');
    }


    public function details($id)
    {
        // Retrieve the event by its ID
        $event = Event::findOrFail($id);

        // Return a view with the event details
        return view('admin.events.details', compact('event'));
    }
}
