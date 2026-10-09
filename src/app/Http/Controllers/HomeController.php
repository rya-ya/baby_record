<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Baby;
use Illuminate\Support\Facades\Gate;

class HomeController extends Controller
{
    public function index($homeId)
    {
        $home = Home::FindOrFail($homeId);

        Gate::authorize('view', $home);

        $baby = Baby::with([
            'home',
        ])
        ->where('home_id',$home->id)
        ->get();

        return view('homes.index', [
            'home' => $home,
            'babies' => $baby,
        ]);
    }

    public function edit($homeId)
    {
        $home = Home::FindOrFail($homeId);

        Gate::authorize('update',$home);

        $baby = Baby::with([
            'home',
        ])
        ->where('home_id',$home->id)
        ->get();

        return view('homes.edit', [
            'home' => $home,
            'babies' => $baby,
        ]);
    }
}
