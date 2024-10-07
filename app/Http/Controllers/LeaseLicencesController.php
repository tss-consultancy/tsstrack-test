<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeaseLicences;
use Carbon\Carbon;
use Redirect;

class LeaseLicencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lease = LeaseLicences::all();
        $total=0;
        foreach ($lease as $key ) {
            $total+=$key->rent;
        }
        $data = compact('lease','total');
        return view('lease-licences.index')->with($data); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lease-licences.create');
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
            'unit' => 'required|unique:leaselicenceentry,unit',
            'owner' => 'required',
            'rent' => 'required',
            'deposit' => 'required',
            'from_date'=> 'required|date',
            'to_date'=> 'required|date',
            'escalation_date'=> 'required|date',
            'escalation_rate' => 'required',
            'commitment_date'=> 'required|date',
            'contract_date'=> 'required|date',
            'remarks' => 'required'
        ]);
        $lease = new LeaseLicences;
        $lease->unit = $request['unit'];
        $lease->owner = $request['owner'];
        $lease->rent = $request['rent'];
        $lease->deposit = $request['deposit'];
        $lease->lease_start_date = $request['from_date'];
        $lease->lease_end_date = $request['to_date'];
        $lease->escalation_date = $request['escalation_date'];
        $lease->escalation_percentage = $request['escalation_rate'];
        $lease->date_of_commitment = $request['commitment_date'];
        $lease->date_of_contract = $request['contract_date'];
        $lease->remarks = $request['remarks'];
        $rent = $request['rent'];
        $rate = $request['escalation_rate'];
        $startdate = Carbon::parse($request['from_date']);
        $enddate = Carbon::parse($request['to_date']);
        $days = $startdate->diffInDays($enddate);
        $lease->escalation_amount = $rent * ($rate / 100) * ($days / 365);
        $lease->save();
        return Redirect::to('/lease-licences/index')->with('added','Lease Licence added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lease = LeaseLicences::find($id);
        if (is_null($lease)) {
            return Redirect::to('/lease-licences/index');
        } else {
            $data = compact('lease');
            return view('lease-licences.show')->with($data);
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
        $lease = LeaseLicences::find($id);
        if (is_null($lease)) {
            return Redirect::to('/lease-licences/index');
        } else {
            $data = compact('lease');
            return view('lease-licences.edit')->with($data);
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
            'unit' => 'required',
            'owner' => 'required',
            'rent' => 'required',
            'deposit' => 'required',
            'from_date'=> 'required|date',
            'to_date'=> 'required|date',
            'escalation_date'=> 'required|date',
            'escalation_rate' => 'required',
            'commitment_date'=> 'required|date',
            'contract_date'=> 'required|date',
            'remarks' => 'required'
        ]);
        $lease = Leaselicences::find($id);
        if (!$lease) {
            return back()->withErrors(['id' => 'FD not found.']);
        }
        $lease->unit = $request['unit'];
        $lease->owner = $request['owner'];
        $lease->rent = $request['rent'];
        $lease->deposit = $request['deposit'];
        $lease->lease_start_date = $request['from_date'];
        $lease->lease_end_date = $request['to_date'];
        $lease->escalation_date = $request['escalation_date'];
        $lease->escalation_percentage = $request['escalation_rate'];
        $lease->date_of_commitment = $request['commitment_date'];
        $lease->date_of_contract = $request['contract_date'];
        $lease->remarks = $request['remarks'];
        $lease->escalation_percentage = $request['escalation_rate'];
        $rent = $request['rent'];
        $rate = $request['escalation_rate'];
        $startdate = Carbon::parse($request['from_date']);
        $enddate = Carbon::parse($request['to_date']);
        $days = $startdate->diffInDays($enddate);
        $lease->escalation_amount = $rent * ($rate / 100) * ($days / 365);
        $lease->save();
        return Redirect::to('/lease-licences/index')->with('added','Lease Licence updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lease = LeaseLicences::find($id)->delete();
        return Redirect::to('/lease-licences/index')->with('deleted', 'Lease Licence deleted successfully!');
    }
    public function showForm(){
        $leases = LeaseLicences::all();
        $data = compact('leases');
        return view('calculate-lease.index')->with($data);
    }
    public function calculateLease(Request $request)
    {
       
        $LeaseDetails = [];
        $totalEscalationAmount = 0;

    
        $request->validate([
            'lease_ids' => 'required|array',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $selectedleases = LeaseLicences::whereIn('id', $request->lease_ids)->get();

        foreach ($selectedleases as $lease) {
            $unit = $lease->unit;
            $amount = $lease->rent; 
            $rate = $lease->escalation_percentage; 

            $startDate = Carbon::parse($request->start_date);
            $endDate = Carbon::parse($request->end_date);

            $days = $startDate->diffInDays($endDate);
            $escalation_amount = $amount * ($rate / 100) * ($days / 365);
            $totalEscalationAmount += $escalation_amount;
            
            $LeaseDetails[] = [
                'unit' =>$lease->unit,
                'amount' => $amount,
                'rate' => $rate,
                'start_date' => $startDate->toDateString(),
                'end_date' => $endDate->toDateString(),
                'days' => $days,
                'interest' => round($escalation_amount, 2),
            ];
           
        }

        return view('calculate-lease.report', compact('LeaseDetails', 'totalEscalationAmount'));
    }
}
