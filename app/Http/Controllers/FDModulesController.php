<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frequencies;
use App\Models\Banks;
use App\Models\FDModules;
use Redirect;
use Carbon\Carbon;
class FDModulesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $fd = FDModules::all();
        $total=0;
        foreach ($fd as $key ) {
            $total+=$key->amount;
        }
        $data = compact('fd','total');
        
        return view('fd-modules.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $frequencies = Frequencies::all();
        $bank = Banks::all();
        $data = compact('frequencies','bank');
        return view('fd-modules.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'bank' => 'required',
            'date_of_fd' => 'required|date',
            'fdnumber' => 'required|unique:fixed_deposits,fd_number',
            'amount' => 'required',
            'roi'=> 'required',
            'frequency' => 'required',
            'maturity_date' => 'required|date|after:date_of_fd|different:date_of_fd',
            'remarks' => 'required'
        ]);
        $fd = new FDModules;
        $fd->bank_id = $request['bank'];
        $fd->date_of_fd = $request['date_of_fd'];
        $fd->fd_number = $request['fdnumber'];
        $fd->amount = $request['amount'];
        $fd->rate_of_interest = $request['roi'];
        $fd->frequency_id = $request['frequency'];
        $fd->date_of_maturity = $request['maturity_date'];
        $fd->remarks = $request['remarks'];
        $fd->save();
        return Redirect::to('/fd-modules/index')->with('added','FD added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fd = FDModules::find($id);
        if (is_null($fd)) {
            return Redirect::to('/fd-modules/index');
        } else {
            $data = compact('fd');
            return view('fd-modules.show')->with($data);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fd = FDModules::find($id);
    
        $frequencies = Frequencies::all();
        $banks = Banks::all();
        if (is_null($fd)) {
            return Redirect::to('/fd-modules/index');
        } else {
            $data = compact('fd','frequencies','banks');
            return view('fd-modules.edit')->with($data);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
 
        $request->validate([
            'bank' => 'required',
            'date_of_fd' => 'required|date',
            'fdnumber' => 'required',
            'amount' => 'required',
            'roi'=> 'required',
            'frequency' => 'required',
            'maturity_date' => 'required|date|after:date_of_fd|different:date_of_fd',
            'remarks' => 'required'
        ]);
        $fd = FDModules::find($id);
        if (!$fd) {
            return back()->withErrors(['id' => 'FD not found.']);
        }
        $fd = FDModules::find($id);
        $fd->bank_id = $request['bank'];
        $fd->date_of_fd = $request['date_of_fd'];
        $fd->fd_number = $request['fdnumber'];
        $fd->amount = $request['amount'];
        $fd->rate_of_interest = $request['roi'];
        $fd->frequency_id = $request['frequency'];
        $fd->date_of_maturity = $request['maturity_date'];
        $fd->remarks = $request['remarks'];
        $fd->save();
        return Redirect::to('/fd-modules/index')->with('added','FD updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fd = FDModules::find($id)->delete();
        return Redirect::to('/fd-modules/index')->with('deleted', 'FD deleted successfully!');
    }
    public function showForm(){
        $fds = FDModules::all();
        $data = compact('fds');
        return view('calculate-fd.index')->with($data);
    }
    public function calculateInterest(Request $request)
    {
        $fdDetails = [];
        $totalInterest = 0;

    
        $request->validate([
            'fd_ids' => 'required|array',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $selectedFDs = FDModules::whereIn('id', $request->fd_ids)->get();

        foreach ($selectedFDs as $fd) {
            $bank_name = $fd->bank_name;
            $amount = $fd->amount; 
            $rate = $fd->rate_of_interest; 

            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $days = $startDate->diffInDays($endDate);
            $interest = $amount * ($rate / 100) * ($days / 365);
            $totalInterest += $interest;
            
            $fdDetails[] = [
                'bank_name' =>$fd->bank_id,
                'fd_number' => $fd->fd_number, 
                'amount' => $amount,
                'rate' => $rate,
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'days' => $days,
                'interest' => round($interest, 2),
            ];
           
        }

        return view('calculate-fd.report', compact('fdDetails', 'totalInterest'));
    }
    public function toggleStatus(Request $request, $id)
{
    $fdModule = FDModule::findOrFail($id);
    $fdModule->status = $request->status;
    $fdModule->save();

    return response()->json(['success' => true, 'status' => $fdModule->status]);
}
}
