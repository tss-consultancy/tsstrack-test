<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Committees;
use App\Models\Frequencies;
use Redirect;

class CommitteesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
            $committees = Committees::with('frequencies')->get();
            $frequencies = Frequencies::all();
            $data = compact('committees','frequencies');
            return view('committees.index')->with($data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
   
            //   session()->forget('login');
            $frequencies = Frequencies::all();
            $data = compact('frequencies');
            return view('committees.create')->with($data);

            
        
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
                'title' => 'required|unique:committees,committe_name|string|max:255',
                'frequency' => 'required|unique:frequencies,frequency_name|string|max:255'
            ]);
            

            $committees = new Committees;
            $committees->committee_name = $request['title'];
            $committees->frequency_id = $request['frequency'];
            $committees->save();
            return Redirect::to('/committees/index')->with('added','Committee added Successfully!');

            
        
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
            
            $committees = Committees::find($id);
            if (is_null($committees)) {
                return Redirect::to('/committees/index');
            }else{
                $data = compact('committees');
                return view('committees.show')->with($data);
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
           
            
            $committees = Committees::find($id);
            $frequencies = Frequencies::all();
            if (is_null($committees)) {
                return Redirect::to('/committees/index');
            }else{
                $data = compact('committees','frequencies');
                return view('committees.edit')->with($data);
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
                
                
                $committees = Committees::find($id);
                $committees->committee_name = $request['title'];
                $committees->frequency_id = $request['frequency'];
                $committees->save();
                return Redirect::to('/committees/index')->with('added','Committee updated Successfully!');

        
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
            
             $committees = Committees::find($id)->delete();
             return Redirect::to('/committees/index')->with('deleted', 'Committee  deleted successfully!');

        
    }
}
