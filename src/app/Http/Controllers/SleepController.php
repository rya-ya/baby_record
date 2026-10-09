<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baby;
use App\Models\Day;
use App\Models\Sleep;
use Illuminate\Support\Facades\Gate;

class SleepController extends Controller
{
    public function index($babyId, Request $request)
    {
        $baby = Baby::FindOrFail($babyId);
        $date = $request->date;

        Gate::authorize('view', $baby);

        return view('sleep.create',[
            'baby'=>$baby,
            'date'=>$date,
        ]);
    }

    public function create($babyId, Request $request)
    {
        $baby = Baby::FindOrFail($babyId);

        Gate::authorize('view', $baby);

        $validated = $request->validate(Sleep::$rules, Sleep::$messages);

        //開始時間と終了時間が同じ場合はエラー
        //日をまたぐ睡眠も考慮し、終了時間が開始時間よりより前は入力可能とする
        if ($validated['start_time'] === $validated['end_time']){
            return back()
                ->withErrors([
                    'end_time' => '寝た時間と起きた時間は異なる時間を入力してください',
                ])
                ->withInput();
        }

        //対象のDayを取得。無ければ作成
        $day = Day::firstOrCreate([
            'baby_id' => $baby->id,
            'day' => $validated['date'],
        ]);

        session()->flash('success',"おねんねを追加しました");

        $result = Sleep::create([
            'day_id' => $day->id,
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'memo' => $validated['memo'],
        ]);

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $validated['date'],
        ]);

    }

    public function edit($babyId, $sleepId, Request $request)
    {
        $baby = Baby::FindOrFail($babyId);
        $sleep = Sleep::FindOrFail($sleepId);
        $date = $request->date;

        // おねんね記録が指定された赤ちゃんのものか確認
        if ($sleep->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('update', $sleep);

        return view('sleep.edit',[
            'baby' => $baby,
            'sleep' => $sleep,
            'date' => $date,
        ]);
    }

    public function update($babyId, $sleepId, Request $request)
    {
        $baby = Baby::FindOrFail($babyId);
        $sleep = Sleep::FindOrFail($sleepId);

        // おねんね記録が指定された赤ちゃんのものか確認
        if ($sleep->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('update', $sleep);

        $validated = $request->validate(Sleep::$rules, Sleep::$messages);

        //開始時間と終了時間が同じ場合はエラー
        //日をまたぐ睡眠も考慮し、終了時間が開始時間よりより前は入力可能とする
        if ($validated['start_time'] === $validated['end_time']){
            return back()
                ->withErrors([
                    'end_time' => '寝た時間と起きた時間は異なる時間を入力してください',
                ])
                ->withInput();
        }

        $result = $sleep->update($validated);

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $validated['date'],
        ]);
    }

    public function destroy($babyId, $sleepId, Request $request)
    {
        $baby = Baby::FindOrFail($babyId);
        $sleep = Sleep::FindOrFail($sleepId);
        $date=$request->date;

        // おねんね記録が指定された赤ちゃんのものか確認
        if ($sleep->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('delete', $sleep);

        $result = $sleep->delete();

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $date,
        ]);
    }
}
