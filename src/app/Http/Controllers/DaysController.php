<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Day;
use App\Models\Baby;
use Illuminate\Support\Facades\Gate;

class DaysController extends Controller
{
    public function index($id, Request $request)
    {
        $baby = Baby::findOrFail($id);
        $date = $request->date ?? now()->toDateString();;

        Gate::authorize('view', $baby);

        $day = Day::with([
            'baby',
            'milks',
            'diapers',
            'sleeps',
        ])
        ->where('baby_id',$baby->id)
        ->where('day',$date)
        ->first();

        $records=collect();

        if($day){
            foreach ($day->milks as $milk){
                $records->push([
                    'type' => 'milk',
                    'time' => $milk->time,
                    'data' => $milk
                ]);
            }
            foreach ($day->diapers as $diaper){
                $records->push([
                    'type' => 'diaper',
                    'time' => $diaper->time,
                    'data' => $diaper
                ]);
            }
            foreach ($day->sleeps as $sleep){
                $records->push([
                    'type' => 'sleep',
                    'time' => $sleep->start_time,
                    'data' => $sleep
                ]);
            }
        }

        $records=$records->sortBy('time')->values();

        return view('days', [
            'baby' => $baby,
            'date' => $date,
            'day' => $day,
            'records' => $records,
        ]);
    }
}
