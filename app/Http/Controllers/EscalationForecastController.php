<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveLicenseEntry; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EscalationForecastExport;
use PDF;
use Carbon\Carbon;

class EscalationForecastController extends Controller
{
    // Display the escalation forecast form
    public function index()
    {
        return view('leave-license-entries.escalation-forecast'); 
    }

    // Show the calculated forecast based on user input dates
    public function showForecast(Request $request)
    {
        // Validate the input dates
        $request->validate([
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after_or_equal:from_date',
        ]);

        // Retrieve date inputs
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Fetch Leave License Entries
        $leaveLicenses = LeaveLicenseEntry::all();

        // Calculate escalation amount for each entry
        $forecasts = $leaveLicenses->map(function ($entry) use ($fromDate, $toDate) {
            // Calculate the number of months between the two dates
            $months = $this->calculateMonths($fromDate, $toDate);

            // Escalation calculation
            $escalationAmount = ($entry->rent * $entry->escalation / 100) * ($months / 12);
            $totalAmount = $entry->rent + $escalationAmount;

            // Store the calculated amounts in the entry
            $entry->calculated_escalation = round($escalationAmount, 2);
            $entry->total_amount = round($totalAmount, 2);

            return $entry;
        });

        // Return the view with forecasts
        return view('leave-license-entries.escalation-forecast', compact('forecasts', 'fromDate', 'toDate'));
    }


    // Download the forecast data as an Excel file
    public function downloadExcel(Request $request)
    {
        return Excel::download(new EscalationForecastExport($request->input('from_date'), $request->input('to_date')), 'escalation_forecast.xlsx');
    }

    // Download the forecast data as a PDF file
    public function downloadPDF(Request $request)
    {
        // Fetch Leave License Entries for PDF download
        $leaveLicenses = LeaveLicenseEntry::all();

        // Calculate escalation for each entry for PDF
        $forecasts = $leaveLicenses->map(function ($entry) use ($request) {
            // Calculate the number of months for the selected range
            $months = $this->calculateMonths($request->from_date, $request->to_date);

            // Escalation calculation
            $escalationAmount = ($entry->rent * $entry->escalation / 100) * ($months / 12);
            $totalAmount = $entry->rent + $escalationAmount;

            // Store the calculated amounts in the entry
            $entry->calculated_escalation = round($escalationAmount, 2);
            $entry->total_amount = round($totalAmount, 2);

            return $entry;
        });

        $pdf = PDF::loadView('leave-license-entries.pdf-escalation-forecast', compact('forecasts'));
        return $pdf->download('escalation_forecast.pdf');
    }

    // Calculate the number of months between two dates
    protected function calculateMonths($fromDate, $toDate)
    {
        $from = Carbon::createFromFormat('Y-m-d', $fromDate);
        $to = Carbon::createFromFormat('Y-m-d', $toDate);
        return $from->diffInMonths($to);
    }
}


    // Calculate the number of months between two dates
    protected function calculateMonths($fromDate, $toDate)
    {
        $from = Carbon::createFromFormat('Y-m-d', $fromDate);
        $to = Carbon::createFromFormat('Y-m-d', $toDate);
        return $from->diffInMonths($to);
    }



    public function downloadExcel(Request $request)
    {
        // You might want to filter or fetch data based on user input
        return Excel::download(new EscalationForecastExport($request->from_date, $request->to_date), 'escalation_forecast.xlsx');
    }

    public function downloadPDF(Request $request)
    {
        // Fetch your data based on the date range
        $forecasts = LeaveLicense::whereBetween('date', [$request->from_date, $request->to_date])->get();
        
        $pdf = PDF::loadView('pdf.escalation_forecast', compact('forecasts'));
        return $pdf->download('escalation_forecast.pdf');
    }
}

