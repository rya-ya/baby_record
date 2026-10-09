<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Baby;
use App\Models\Day;
use App\Models\Diaper;
use Illuminate\Support\Facades\Gate;

class DiaperController extends Controller
{
    function index($babyId, Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $date = $request->date;

        Gate::authorize('view', $baby);

        return view('diaper.create',[
            'baby' => $baby,
            'date' => $date,
        ]);
    }

    function create($babyId, Request $request)
    {
        $baby = Baby::findOrFail($babyId);

        Gate::authorize('view', $baby);
        
        $validated = $request->validate(Diaper::$rules, Diaper::$messages);

        //対象のDayを取得。無ければ作成
        $day = Day::firstOrCreate([
            'baby_id' => $baby->id,
            'day' => $validated['date'],
        ]);

        $result = Diaper::create([
            'day_id' => $day->id,
            'time' => $validated['time'],
            'type' => $validated['type'],
            'memo' => $validated['memo'],
        ]);

        session()->flash('success',"おむつを追加しました");

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $validated['date'],
        ]);
    }

    public function edit($babyId, $diaperId, Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $diaper = Diaper::findOrFail($diaperId);
        $date = $request->date;

        // おむつ記録が指定された赤ちゃんのものか確認
        if ($diaper->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('update', $diaper);

        return view('diaper.edit',[
            'baby' => $baby,
            'diaper' => $diaper,
            'date' => $date,
        ]);
    }

    function update($babyId, $diaperId, Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $diaper = Diaper::findOrFail($diaperId);

        // おむつ記録が指定された赤ちゃんのものか確認
        if ($diaper->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('update', $diaper);

        $validated = $request->validate(Diaper::$rules, Diaper::$messages);

        $result = $diaper->update($validated);

        session()->flash('success',"記録内容を変更しました");

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $validated['date'],
        ]);
    }

    public function destroy($babyId, $diaperId, Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $diaper = Diaper::findOrFail($diaperId);
        $date = $request->date;

        // おむつ記録が指定された赤ちゃんのものか確認
        if ($diaper->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('delete', $diaper);

        $result = $diaper->delete();

        session()->flash('success',"記録内容を削除しました");

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $date,
        ]);
    }
}
