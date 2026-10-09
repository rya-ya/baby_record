<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Baby;
use Illuminate\Support\Facades\Gate;

class BabyController extends Controller
{
    public function index($homeId)
    {
        $home = Home::FindOrFail($homeId);

        Gate::authorize('view', $home);
        return view('babies.create',[
            'home'=>$home,
        ]);
    }

    public function create($homeId, Request $request)
    {
        $home = Home::FindOrFail($homeId);

        Gate::authorize('update', $home);

        $validated = $request->validate(Baby::$rules, Baby::$messages);

        $result = Baby::create([
            'name' => $validated['name'],
            'gender' => $validated['gender'],
            'birthday' => $validated['birthday'],
            'memo' => $validated['memo'],
            'home_id' => $home->id,
        ]);

        session()->flash('success',"赤ちゃんを追加しました");

        return redirect()->route('homes.edit',[
            'home' => $home,
        ]);
    }

    public function edit($homeId, $babyId)
    {
        $home = Home::FindOrFail($homeId);
        $baby = Baby::FindOrFail($babyId);

        // URLの家族と、赤ちゃんの所属する家族が一致するか確認
        if ($baby->home_id !== $home->id) {
            abort(404);
        }

        Gate::authorize('update', $baby);

        return view('babies.edit',[
            'home'=>$home,
            'baby'=>$baby,
        ]);
    }

    public function update($homeId, $babyId, Request $request)
    {
        $home = Home::FindOrFail($homeId);
        $baby = Baby::FindOrFail($babyId);

        // URLの家族と、赤ちゃんの所属する家族が一致するか確認
        if ($baby->home_id !== $home->id) {
            abort(404);
        }

        Gate::authorize('update', $baby);

        $validated = $request->validate(Baby::$rules, Baby::$messages);

        $result = $baby->update($validated);

        session()->flash('success',"赤ちゃんを変更しました");

        return redirect()->route('homes.edit',[
            'home' => $home,
        ]);
    }

    public function destroy($homeId, $babyId)
    {
        $home = Home::FindOrFail($homeId);
        $baby = Baby::FindOrFail($babyId);

        // URLの家族と、赤ちゃんの所属する家族が一致するか確認
        if ($baby->home_id !== $home->id) {
            abort(404);
        }

        Gate::authorize('delete', $baby);

        $result = $baby->delete();

        session()->flash('success',"赤ちゃんを削除しました");

        return redirect()->route('homes.edit',[
            'home' => $home,
        ]);
    }

    }
