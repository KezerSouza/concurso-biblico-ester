<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $teams = Team::query()->orderBy('id')->get();

        return view('dashboard', compact('teams'));
    }

    public function addPoints(Request $request, Team $team): RedirectResponse
    {

        $points = $request->integer('points');

        $request->validate(
            ['points' => ['required', 'integer', 'min:1']],
            ['points.required' => 'Informe a pontuação.', 'points.min' => 'A pontuação deve ser pelo menos 1.'],
        );

        $team->increment('score', $points);

        return back()->with('success', "{$points} pontos adicionados à {$team->name}!");
    }
}
