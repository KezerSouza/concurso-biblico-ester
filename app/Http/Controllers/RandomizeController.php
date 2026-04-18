<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\View\View;

class RandomizeController extends Controller
{
    public function index(): View
    {
        $teams = Team::query()->orderBy('id')->get();

        return view('randomize', compact('teams'));
    }
}
