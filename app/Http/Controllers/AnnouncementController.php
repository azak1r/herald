<?php

namespace nullx27\Herald\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use nullx27\Herald\Models\Announcement;
use nullx27\Herald\Models\Event;

class AnnouncementController extends Controller
{

    public function create(Request $request, Event $event)
    {
        if(! \Auth::user()->can('create', $event)) {
            return abort(403, 'Not sufficient permissions');
        }


        $this->validate($request,[
            'date' => 'required|date'
        ]);


        $date = Carbon::parse($request->get('date'));

        if(Carbon::now()->greaterThan($date)) {
            return back()->withErrors(['msg' => 'Announcement date is in the past']);
        }


        $event->announcements()->create(['date' => $request->get('date')]);

        return back();

    }

    public function destroy(Request $request, Announcement $announcement)
    {
        if(! \Auth::user()->can('delete', $announcement))  {
            return abort(403, 'Not sufficient permissions');
        }

        $announcement->delete();

        return back();
    }
}
