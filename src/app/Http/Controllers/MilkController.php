<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baby;
use App\Models\Day;
use App\Models\Milk;
use Illuminate\Support\Facades\Gate;

class MilkController extends Controller
{

    public function index($babyId, Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $date = $request->date;

        Gate::authorize('view', $baby);

        return view('milk.create',[
            'baby' => $baby,
            'date' => $date,
        ]);
    }

    public function create($babyId, Request $request)
    {
        $baby = Baby::findOrFail($babyId);

        Gate::authorize('view', $baby);

        $validated = $request->validate(Milk::$rules, Milk::$messages);

        //対象のDayを取得。無ければ作成
        $day = Day::firstOrCreate([
            'baby_id' => $baby->id,
            'day' => $validated['date'],
        ]);

        $result = Milk::create([
            'day_id' => $day->id,
            'time' => $validated['time'],
            'amount' => $validated['amount'],
            'memo' => $validated['memo'],
        ]);

        session()->flash('success',"ミルクを追加しました");

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $validated['date'],
        ]);
    }

    public function edit($babyId, $milkId , Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $milk = Milk::findOrFail($milkId);
        $date = $request->date;

        // ミルク記録が指定された赤ちゃんのものか確認
        if ($milk->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('update', $milk);

        return view('milk.edit',[
            'baby' => $baby,
            'milk' => $milk,
            'date' => $date,
        ]);
    }

    public function update($babyId, $milkId , Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $milk = Milk::findOrFail($milkId);

        // ミルク記録が指定された赤ちゃんのものか確認
        if ($milk->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('update', $milk);

        $validated = $request->validate(Milk::$rules, Milk::$messages);

        $result = $milk->update($validated);

        session()->flash('success',"記録内容を変更しました");

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $validated['date'],
        ]);
    }

    public function destroy($babyId, $milkId , Request $request)
    {
        $baby = Baby::findOrFail($babyId);
        $milk = Milk::findOrFail($milkId);
        $date = $request->date;

        // ミルク記録が指定された赤ちゃんのものか確認
        if ($milk->day->baby_id !== $baby->id) {
            abort(404);
        }

        Gate::authorize('delete', $milk);

        $result = $milk->delete();

        session()->flash('success',"記録内容を削除しました");

        return redirect()->route('days.index',[
            'baby' => $baby,
            'date' => $date,
        ]);
    }
}
