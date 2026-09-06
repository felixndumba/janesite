<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class BudgetTrackerController extends Controller
{
    /**
     * Display the Budget Tracker page.
     *
     * No database is used.
     */
    public function index()
    {
        return view('budget-tracker.index');
    }


    /**
     * Preview the Budget Tracker Excel file.
     *
     * This displays the Excel file as a file response.
     */
    public function preview()
    {
        $file = storage_path(
            'app/private/budget-tracker/FINANCIALPLANNERTEMPLATE.xlsx'
        );

        if (!File::exists($file)) {
            abort(404, 'Budget Tracker preview file not found.');
        }

        return response()->file($file);
    }


    /**
     * Download the Budget Tracker Excel file.
     */
    public function download()
    {
        $file = storage_path(
            'app\private\budget-tracker\FINANCIAL PLANNERTEMPLATE.xlsx'
        );

        if (!File::exists($file)) {
            abort(404, 'Budget Tracker Excel file not found.');
        }

        return response()->download(
            $file,
            'FINANCIALPLANNER.xlsx',
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            ]
        );
    }
}