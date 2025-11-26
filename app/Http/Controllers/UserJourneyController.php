<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class UserJourneyController extends Controller
{
    public function index(): View
    {
        return view('journey.index');
    }

    public function step($step): View
    {
        return view("journey.step{$step}");
    }

    public function processStep($step)
    {
        // Process step data here
        $nextStep = $step + 1;
        
        if ($nextStep > 7) {
            return redirect()->route('user.journey');
        }
        
        return redirect()->route('journey.step', $nextStep);
    }
}