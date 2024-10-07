<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Members;
use App\Models\Committees;
use Redirect;
use Illuminate\Validation\Rule;
class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
            $members = Members::with('committee')->get();
            
            $data = compact('members');
            return view('members.index')->with($data);
      

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
            $committees = Committees::all();
            $data = compact('committees');
            return view('members.create')->with($data);
    

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
   
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,user_email',
                'states' => 'required',
                'contact' => 'required|numeric|unique:members,member_mobile|digits_between:1,10',
            ]);
            
            $committee_id = $request['states'];
            $existingMember = Members::where('committee_id', $committee_id)
            ->where('member_name', $request['name'])
            ->exists();

            if ($existingMember) {
            return back()->withErrors(['states' => 'This member is already assigned to this committee.']);
            }
            foreach ($committee_id as $value) {
                $members = new Members;
                $members->member_name = $request['name'];
                $members->member_mobile = $request['contact'];
                $members->member_email = $request['email'];
                $members->committee_id = $value;
                $members->save();
            }
            
            return Redirect::to('/members/index')->with('added','Member added Successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
   
            
            
            $members = Members::find($id);
           
            $committees = Committees::find($members->committee_id);
            
            
            if (is_null($members)) {
                return Redirect::to('/members/index');
            }else{
                $data = compact('members','committees');
                return view('members.show')->with($data);
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
      

            $members = Members::find($id);
            $committee_names = Committees::all();
            $committees = Committees::find($members->id);
           
            if (is_null($members)) {
                return Redirect::to('/members/index');
            }else{
                $data = compact('members','committees','committee_names');
                return view('members.edit')->with($data);
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
      
            $members =  Members::find($id);
            $committee_id = $request['committee'];
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,user_email',
                'committee' => [
                    'required',
                    Rule::unique('members', 'committee_id')->ignore($members->committee_id, 'committee_id'),
                ],
                'contact' => 'required|numeric|digits:10',
            ]);
                $members->member_name = $request['name'];
                $members->member_mobile = $request['contact'];
                $members->member_email = $request['email'];
                $members->committee_id = $committee_id;
                $members->save();
            return Redirect::to('/members/index')->with('added','Member updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
            $members = Members::find($id)->delete();
            return Redirect::to('/members/index')->with('deleted', 'Member deleted successfully!');
 

    }
}
