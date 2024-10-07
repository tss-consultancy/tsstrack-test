<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\AllowedIPs;
use Redirect;
class AllowedIpsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ip = AllowedIPs::all();
        $data = compact('ip');
        return view('allowed-ips.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('allowed-ips.create');
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
            'ip' => 'required|unique:allowedip,ipaddress|ipv4|regex:/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/',
            'status' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ], [
            'ip.required' => 'IP address is required',
            'ip.ipv4' => 'Please enter a valid IPv4 address like 49.36.15.162',
            'ip.regex' => 'The IP address must be in the format 0.0.0.0 and cannot contain special characters',
        ]);
        $ip = new AllowedIPs;
        $ip->ipaddress = $request['ip'];
        $ip->city = $request['city'];
        $ip->status = $request['status'];
        $ip->description = $request['description'];
        $ip->area = $request['area'];
        $ip->state = $request['state'];
        $ip->country = $request['country'];
        $ip->save();
        return Redirect::to('/allowed-ips/index')->with('added','Record added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ip = AllowedIPs::find($id);
        $data = compact('ip');
        return view('allowed-ips.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ip = AllowedIPs::find($id);
        if (is_null($ip)) {
            return Redirect::to('/allowed-ips/index');
        }else{
            $data = compact('ip');
            return view('allowed-ips/edit')->with($data);
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
            'ip' => 'required|ipv4|regex:/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/',
            'status' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
        ], [
            'ip.required' => 'IP address is required',
            'ip.ipv4' => 'Please enter a valid IPv4 address like 49.36.15.162',
            'ip.regex' => 'The IP address must be in the format 0.0.0.0 and cannot contain special characters',
        ]);
        $ip = AllowedIPs::find($id);
        $ip->ipaddress = $request['ip'];
        $ip->city = $request['city'];
        $ip->status = $request['status'];
        $ip->description = $request['description'];
        $ip->area = $request['area'];
        $ip->state = $request['state'];
        $ip->country = $request['country'];
        $ip->save();
        return Redirect::to('/allowed-ips/index')->with('added','Record updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ip = AllowedIPs::find($id)->delete();
        return Redirect::to('/allowed-ips/index')->with('deleted','Record deleted Successfully!');
    }
    public function getIpInfo(Request $request)
    {
        $ip = $request->input('ip');
        $key = 'B504164B8139C8E5B6CD0C7F2359CDFA';
        $response = Http::get("https://api.ip2location.io/?key={$key}&ip={$ip}");
       
        return $response->json();
    }
    
}
