<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BudgetProduct;

class BudgetProductSeeder extends Seeder
{
    public function run(): void
    {
        BudgetProduct::create([
            'name' => 'Budget Tracker',
            'description' => 'Track your income, expenses and monthly budget with a practical Excel template.',
            'price' => 500,
            'preview_file' => 'previews/FINANCIAL PLANNERTEMPLATE.pdf',
            'excel_file' => 'budget-trackers/FINANCIAL PLANNERTEMPLATE.xlsx',
            'active' => true,
        ]);

        BudgetProduct::create([
            'name' => 'Debt Tracker',
            'description' => 'Monitor your debts, repayments, balances and progress toward becoming debt free.',
            'price' => 500,
            'preview_file' => 'previews/debt-tracker-preview.pdf',
            'excel_file' => 'budget-trackers/debt-tracker.xlsx',
            'active' => true,
        ]);

        BudgetProduct::create([
            'name' => 'Financial Goals Tracker',
            'description' => 'Set and monitor your financial goals and track your progress over time.',
            'price' => 500,
            'preview_file' => 'previews/financial-goals-tracker-preview.pdf',
            'excel_file' => 'budget-trackers/financial-goals-tracker.xlsx',
            'active' => true,
        ]);

        BudgetProduct::create([
            'name' => 'Investment Tracker',
            'description' => 'Track your investments, contributions and portfolio growth.',
            'price' => 500,
            'preview_file' => 'previews/investment-tracker-preview.pdf',
            'excel_file' => 'budget-trackers/investment-tracker.xlsx',
            'active' => true,
        ]);

        BudgetProduct::create([
            'name' => 'Net Worth Calculator',
            'description' => 'Calculate and monitor your net worth by tracking assets and liabilities.',
            'price' => 500,
            'preview_file' => 'previews/net-worth-preview.pdf',
            'excel_file' => 'budget-trackers/net-worth-calculator.xlsx',
            'active' => true,
        ]);
    }
}