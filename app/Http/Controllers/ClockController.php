<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ClockController extends Controller
{
    public function stopwatch(): View
    {
        return view('stopwatch');
    }

    public function temporizador(): View
    {
        return view('temporizador');
    }
}
