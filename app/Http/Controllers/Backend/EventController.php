<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Event\Event;
use App\Http\Requests\Event\EventRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $event;

    function __construct(Event $event)
    {
        $this->event = $event;
    }
    public function index()
    {
        $event = $this->event->orderBy('created_at', 'desc')->get();
        return view('backend.event.index', compact('event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        if($event = $this->event->create($request->data())) {
            return redirect()->route('event.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('backend.event.edit', compact('event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        if ($event->update($request->data())) {
            $event->fill([
                'slug' => $request->title,
            ])->save();
        }
        return redirect()->route('event.index')->withSuccess(trans('Event has been updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = $this->event->find($id);
        $event->delete();
        return response()->json([
            'success' => 'Event deleted successfully!'
        ]);
    }

    public function searchByFilter(Request $request)
    {
        $filter = $request->filter;
        if (isset($filter)) {
            if ($filter == "finish_event") {
                $event = $this->event->where('end_date', '<', date('Y-m-d'))->get();
            }

            if ($filter == "upcoming_event") {

                $event = $this->event->where('start_date', '>', date('Y-m-d'))->get();
            }
            if($filter == "finished_seven_event") {
               $today = Carbon::now()->subDays(7);
                $event = $this->event->whereBetween('end_date', [$today, date('Y-m-d')])->get();
            }

            if($filter == "upcoming_seven_event") {
               $today = Carbon::now()->addDays(7);
                $event = $this->event->whereBetween('start_date', [date('Y-m-d'),$today])->get();
            }
        }

        return view('backend.event.index', compact('event','filter'));

    }

}
