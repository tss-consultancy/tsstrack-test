<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frequencies;
use App\Models\Committees;
use Redirect;

class FrequenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
            $frequencies = Frequencies::all();
            $data = compact('frequencies');
            return view('frequencies.index')->with($data);
  

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
            //   session()->forget('login');
            
            return view('frequencies.create');
    
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
            //   session()->forget('login');
            
            $request->validate([
                'title' => 'required|unique:frequencies,frequency_name|string|max:255',
            ]);
            
            $frequencies = new Frequencies;
            $frequencies->frequency_name = $request['title'];
            $frequencies->save();
            return Redirect::to('/frequencies/index')->with('added','Frequency added Successfully!');
     
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
            //   session()->forget('login');
            
            $frequencies = Frequencies::find($id);
            if (is_null($frequencies)) {
                return Redirect::to('frequencies/index');
            }
            else{
                $data = compact('frequencies');
                return view('frequencies.show')->with($data);
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
      
            //   session()->forget('login');
            
            $frequencies = Frequencies::find($id);
            if (is_null($id)) {
                return Redirect::to('/frequencies/index');
            }
            else{
                $data = compact('frequencies');
                return view('frequencies.edit')->with($data);
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
       
            //   session()->forget('login');
            
            $request->validate([
                'title' => 'required|unique:frequencies,frequency_name|string|max:255',
            ]);
            $frequencies = Frequencies::find($id);
            $frequencies->frequency_name = $request['title'];
            $frequencies->save();
            return Redirect::to('/frequencies/index')->with('added','Frequency updated Successfully!');
  
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
            //   session()->forget('login');
            
            if (is_null($id)) {
                return Redirect::to('/frequencies/index');
            }
            else{
                $frequencies = Frequencies::find($id)->delete();
                return Redirect::to('/frequencies/index')->with('deleted', 'Frequency deleted successfully!');
            }
       
        
    }
}
