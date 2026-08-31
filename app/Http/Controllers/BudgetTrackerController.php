<?php

namespace App\Http\Controllers;

class BudgetTrackerController extends Controller
{
    /**
     * Display the Budget Tracker coming soon page.
     */
    public function index()
    {
        return view('budget-tracker.index');
    }
}