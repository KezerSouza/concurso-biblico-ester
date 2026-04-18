<?php

namespace App\Http\Controllers;

use App\Models\PointHistory;
use App\Models\Team;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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

        $validator = Validator::make(
            $request->all(),
            ['points' => ['required', 'integer', 'min:1']],
            ['points.required' => 'Pontuação não informada.', 'points.min' => 'A pontuação informada deve ser pelo menos 1.'],
        );

        if ($validator->fails()) {
            return back()->with('error', 'Não foi possível adicionar pontos: '.$validator->errors()->first());
        }

        $team->increment('score', $points);
        $team->pointHistories()->create(['points' => $points]);

        return back()->with('success', "{$points} pontos adicionados à {$team->name}!");
    }

    public function removePoints(Request $request, Team $team): RedirectResponse
    {
        $points = $request->integer('points');

        $validator = Validator::make(
            $request->all(),
            ['points' => ['required', 'integer', 'min:1']],
            ['points.required' => 'Pontuação não informada.', 'points.min' => 'A pontuação informada deve ser pelo menos 1.'],
        );

        if ($validator->fails()) {
            return back()->with('error', 'Não foi possível remover pontos: '.$validator->errors()->first());
        }

        $team->decrement('score', $points);
        $team->pointHistories()->create(['points' => -$points]);

        return back()->with('success', "{$points} pontos removidos de {$team->name}!");
    }

    public function history(Request $request): View
    {
        $teams = Team::query()->orderBy('id')->get();

        $teamId = $request->query('team');

        $histories = PointHistory::query()
            ->with('team')
            ->when($teamId, fn ($query) => $query->where('team_id', $teamId))
            ->orderBy('id', 'desc')
            ->get();

        $selectedTeam = $teamId ? $teams->find($teamId) : null;

        return view('history', compact('teams', 'histories', 'selectedTeam'));
    }
}
