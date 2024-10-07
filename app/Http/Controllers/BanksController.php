<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banks;
use Redirect;
class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bank = Banks::all();
        $data = compact('bank');
        return view('banks.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('banks.create');
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
            'banktitle' => 'required',
        ]);
        $bank = new Banks;
        $bank->bank_name = $request['banktitle'];
        $bank->save();
        return Redirect::to('/banks/index')->with('added','Bank added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = Banks::find($id);
        if (is_null($bank)) {
            return Redirect::to('/banks/index');
        } else {
            $data = compact('bank');
            return view('banks.show')->with($data);
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
        $bank = Banks::find($id);
        if (is_null($bank)) {
            return Redirect::to('/banks/index');
        }else{
            $data = compact('bank');
            return view('banks.edit')->with($data);
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
            'banktitle' => 'required',
        ]);
        $bank = Banks::find($id);
        if (!$bank) {
            return back()->withErrors(['id' => 'Bank not found.']);
        }
        $bank->bank_name = $request['banktitle'];
        $bank->save();
        return Redirect::to('/banks/index')->with('added','Bank updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (is_null($id)) {
            return Redirect::to('/banks/index');
        }
        else{
        $bank = Banks::find($id)->delete();
        return Redirect::to('/banks/index')->with('deleted', 'Bank deleted successfully!');
        }
    }
}
