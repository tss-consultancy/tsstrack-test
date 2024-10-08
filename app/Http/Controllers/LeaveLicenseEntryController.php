<?php

namespace App\Http\Controllers;

use App\Models\LeaveLicenseEntry; 
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\Models\LeaveLicense; 
use Illuminate\Http\Response;


class LeaveLicenseEntryController extends Controller
{
    // Display a listing of the entries
    public function index(Request $request)
    {
        // Retrieve all leave license entries
        $leaveLicenses = LeaveLicenseEntry::all();

        // Calculate totals
        $totalRent = $leaveLicenses->sum('rent_amount');
        $totalDeposit = $leaveLicenses->sum('deposit_amount');
        $totalEscalation = $leaveLicenses->sum(function($license) {
            return ($license->rent_amount * $license->escalation_percentage) / 100;
        });

        // Get the number of years from the request (default is 1 year if not provided)
        $years = $request->input('years', 1);

        // Future rent calculation based on the selected number of years
        $futureRentAmount = $leaveLicenses->map(function($license) use ($years) {
            $currentRent = $license->rent_amount;
            for ($i = 0; $i < $years; $i++) {
                $currentRent += ($currentRent * ($license->escalation_percentage / 100));
            }
            return $currentRent;
        })->sum();

        // Total rent calculation over the selected years including escalation
        $totalRentAfterYears = $leaveLicenses->sum(function($license) use ($years) {
            $currentRent = $license->rent_amount;
            // Loop through each year to calculate the rent increase due to escalation
            for ($i = 0; $i < $years; $i++) {
                $escalationAmount = ($currentRent * $license->escalation_percentage) / 100;
                $currentRent += $escalationAmount;
            }
            return $currentRent;
        });

        return view('leave-license-entries.index', compact(
            'leaveLicenses', 
            'totalRent', 
            'totalDeposit', 
            'totalEscalation', 
            'futureRentAmount', 
            'totalRentAfterYears', 
            'years'
        ));
    }

    // Show the form for creating a new entry
    public function create()
    {
        return view('leave-license-entries.create');
    }

    // Store a newly created entry with PDF upload
    public function store(Request $request)
    {
        // Validate the input
        $request->validate([
            'unit' => 'required',
            'owner' => 'required',
            'rent_amount' => 'required|numeric',
            'deposit_amount' => 'required|numeric',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'escalation_percentage' => 'required|numeric',
            'escalation_date' => 'required|date',
            'commitment_date' => 'required|date|after_or_equal:from_date',
            'contract_date' => 'required|date|after_or_equal:commitment_date',
            'remarks' => 'nullable|string',
            'pdf' => 'nullable|mimes:pdf|max:10000' // Limit the PDF size to 10MB
        ]);

        // Store the Leave License entry
        $license = new LeaveLicenseEntry();
        $license->unit = $request->unit;
        $license->owner = $request->owner;
        $license->rent_amount = $request->rent_amount;
        $license->deposit_amount = $request->deposit_amount;
        $license->from_date = $request->from_date;
        $license->to_date = $request->to_date;
        $license->escalation_percentage = $request->escalation_percentage;
        $license->escalation_date = $request->escalation_date;
        $license->commitment_date = $request->commitment_date;
        $license->contract_date = $request->contract_date;
        $license->remarks = $request->remarks;

        // Handle the PDF upload
        if ($request->hasFile('pdf')) {
            $fileName = time() . '_' . $request->file('pdf')->getClientOriginalName();
            $filePath = $request->file('pdf')->storeAs('uploads', $fileName, 'public');
            $license->pdf = $filePath;
        }

        $license->save();

        // Redirect to the index page with a success message
        return redirect()->route('leave-license.index')->with('added', 'Leave License entry added successfully.');
    }

    // Show the form for editing the specified entry
    public function edit($id)
    {
        // Fetch the leave license entry by ID
        $leave_license = LeaveLicenseEntry::findOrFail($id);
    
        // Pass the leave_license variable to the edit view
        return view('leave-license-entries.edit', compact('leave_license'));
    }

    // Update the specified entry
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $request->validate([
            'unit' => 'required|string|max:255',
            'owner' => 'required|string|max:255',
            'rent_amount' => 'required|numeric',
            'deposit_amount' => 'required|numeric',
            'from_date' => 'required|date',
            'to_date' => 'required|date',
            'escalation_date' => 'required|date',
            'escalation_percentage' => 'required|numeric',
            'commitment_date' => 'required|date|after_or_equal:from_date',
            'contract_date' => 'required|date|after_or_equal:commitment_date',
            'remarks' => 'nullable|string|max:1000',
            'pdf' => 'nullable|file|mimes:pdf|max:10000',
        ]);

        // Find the leave license entry
        $leaveLicenseEntry = LeaveLicenseEntry::findOrFail($id);

        // Handle PDF upload if a new file is uploaded
        if ($request->hasFile('pdf')) {
            // Optionally delete the old PDF if you want to replace it
            if ($leaveLicenseEntry->pdf) {
                Storage::delete($leaveLicenseEntry->pdf); // Adjust path if necessary
            }

            $pdf = $request->file('pdf');
            $pdfName = time() . '_' . $pdf->getClientOriginalName();
            $pdf->storeAs('uploads', $pdfName, 'public'); // Store PDF in the 'public/uploads' folder
            $leaveLicenseEntry->pdf = $pdfName; // Update the PDF path in the database
        }

        // Update the entry with the new data
        $leaveLicenseEntry->update($request->except('pdf'));

        // Redirect to the index page with a success message
        return redirect()->route('leave-license.index')->with('success', 'Leave License Entry updated successfully.');
    }

    // Remove the specified entry
    public function destroy($id)
    {
        // Find the leave license entry by ID
        $leaveLicenseEntry = LeaveLicenseEntry::findOrFail($id);

        // Optionally delete the PDF file when the entry is deleted
        if ($leaveLicenseEntry->pdf) {
            Storage::delete($leaveLicenseEntry->pdf); // Adjust path if necessary
        }

        // Delete the entry
        $leaveLicenseEntry->delete();

        // Redirect to the index page with a success message
        return redirect()->route('leave-license.index')->with('success', 'Leave License Entry deleted successfully.');
    }

    // Display the specified entry
    public function show($id)
    {
        // Find the leave license entry by ID
        $leaveLicenseEntry = LeaveLicenseEntry::findOrFail($id);

        // Return the show view with the entry data
        return view('leave-license-entries.show', compact('leaveLicenseEntry'));
    }

    // Calculate escalation amount
    public function calculateEscalation($id)
{
    // Find the license entry by ID
    $license = LeaveLicenseEntry::findOrFail($id);
    
    // Check if necessary fields are present
    if (!$license->from_date || !$license->to_date || !$license->escalation_percentage || !$license->rent_amount) {
        return redirect()->back()->with('error', 'Required fields are missing.');
    }

    // Calculate the number of months based on from_date and to_date
    $fromDate = Carbon::parse($license->from_date);
    $toDate = Carbon::parse($license->to_date);
    $months = $fromDate->diffInMonths($toDate);

    // Get the rent amount and escalation percentage
    $rentAmount = $license->rent_amount; 
    $escalationPercent = $license->escalation_percentage; 
    
    // Calculate the escalation amount
    $escalationAmount = ($rentAmount * $escalationPercent / 100) * $months;

    // Calculate the total amount
    $totalAmount = $rentAmount + $escalationAmount;

    // Pass the escalation amount, months, total amount, and license data to the view
    return view('leave-license-entries.escalation', compact('escalationAmount', 'months', 'totalAmount', 'license'));
}

    

    // Utility function to calculate the total months
    private function calculateMonths($fromDate, $toDate)
    {
        $start = new \DateTime($fromDate);
        $end = new \DateTime($toDate);

        // Calculate the difference
        $diff = $start->diff($end);

        // Get the total months
        return ($diff->y * 12) + $diff->m;
    }

    // Show escalation calculation for a specific entry
    public function showEscalationCalculation($id)
    {
        // Find the license entry by ID
        $license = LeaveLicenseEntry::findOrFail($id);

        return view('leave-license-entries.escalation-calculation', compact('license'));
    }

   
public function download()
{
    // Fetch the data from the database
    $leaveLicenses = LeaveLicense::all(); // Ensure LeaveLicense is imported correctly

    // Create a file pointer
    $file = fopen('php://output', 'w');

    // Set the headers to prompt for download
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="leave_licenses.csv"');

    // Add column headers to the CSV
    fputcsv($file, [
        'Sr No', 
        'Unit', 
        'Owner', 
        'Rent Amount', 
        'Deposit Amount', 
        'From Date', 
        'To Date', 
        'Escalation Date', 
        'Escalation (%)', 
        'Escalation Amount'
    ]);

    // Add data rows to the CSV
    foreach ($leaveLicenses as $index => $license) {
        fputcsv($file, [
            $index + 1, // Sr No
            $license->unit,
            $license->owner,
            number_format($license->rent_amount, 2),
            number_format($license->deposit_amount, 2),
            \Carbon\Carbon::parse($license->from_date)->format('d-m-Y'),
            \Carbon\Carbon::parse($license->to_date)->format('d-m-Y'),
            \Carbon\Carbon::parse($license->escalation_date)->format('d-m-Y'),
            $license->escalation_percentage,
            number_format($license->rent_amount * ($license->escalation_percentage / 100) + $license->rent_amount, 2)
        ]);
    }

    // Close the file pointer
    fclose($file);
    exit;
}



}
