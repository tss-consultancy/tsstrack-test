<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaveLicenseEntry; // Use LeaveLicenseEntry for forecasts
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EscalationForecastExport; // Ensure you have this export class

class ForecastReportController extends Controller
{
    public function index()
    {
        return view('forecast-report'); // View for the report form
    }

    public function generateReport(Request $request)
    {
        // Validate the request to ensure date range is provided
        $request->validate([
            'from_date' => 'required|date|after_or_equal:today',
            'to_date' => 'required|date|after:from_date',
        ]);

        // Retrieve the date range
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');

        // Fetch data for the report
        $data = LeaveLicenseEntry::all(); // Get all leave license entries

        // Calculate escalation for each entry
        foreach ($data as $entry) {
            $entry->escalation_amount = $this->calculateEscalation($entry, $fromDate, $toDate);
        }

        // Return the report view with the calculated data
        return view('forecast-report-result', compact('data', 'fromDate', 'toDate'));
    }

    protected function calculateEscalation($entry, $fromDate, $toDate)
    {
        // Implement your logic for escalation calculation here
        $escalationAmount = ($entry->rent * $entry->escalation / 100) * $this->getMonthsDifference($fromDate, $toDate);
        return round($escalationAmount, 2);
    }

    protected function getMonthsDifference($start, $end)
    {
        $startDate = \Carbon\Carbon::parse($start);
        $endDate = \Carbon\Carbon::parse($end);
        return $startDate->diffInMonths($endDate);
    }

    public function downloadPdf(Request $request)
    {
        $data = LeaveLicenseEntry::all();
        foreach ($data as $entry) {
            $entry->escalation_amount = $this->calculateEscalation($entry, $request->from_date, $request->to_date);
        }
        $pdf = PDF::loadView('pdf.forecast-report', compact('data'));
        return $pdf->download('forecast_report.pdf');
    }

    public function downloadExcel(Request $request)
    {
        return Excel::download(new EscalationForecastExport($request->from_date, $request->to_date), 'forecast_report.xlsx');
    }
}
