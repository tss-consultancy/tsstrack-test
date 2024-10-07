<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;
use Redirect;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
            $users = Users::all();
            $data = compact('users');
            return view('users.index')->with($data);
     

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
       
            return view('users.create');
     

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
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'required',
            'phone_no' => 'required|numeric|unique:users,user_mobile|digits:10',
        ]);
     
            
            $users = new Users;
            $users->user_name = $request['name'];
            $users->user_email = $request['email'];
            $users->user_mobile = $request['phone_no'];
            $users->user_password = Hash::make($request['password']);;
            $users->save();
            return Redirect::to('/users/index')->with('added','User added Successfully!');
     

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
       
            $user = Users::find($id);
            if (is_null($user)) {
                return Redirect::to('users.index');
            }else{
                $data = compact('user');
                return view('users.show')->with($data);
            }
     

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
       
     
            $user = Users::find($id);
            if (is_null($user)) {
                Redirect::to('users.index');
            }else{
                $data = compact('user');
                return view('users.edit')->with($data);
    
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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'user_email')->ignore($id, 'user_id'),
            ],
            'password' => 'required',
            'phone_no' => 'required|numeric|digits_between:1,10',
        ]);
  
            $users = Users::find($id);
            $users->user_name = $request['name'];
            $users->user_email = $request['email'];
            $users->user_mobile = $request['phone_no'];
            $users->user_password = Hash::make($request['password']);
            $users->save();
            return Redirect::to('/users/index')->with('added','User updated Successfully!');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
            $user = Users::find($id)->delete(); 
            return Redirect::to('/users/index')->with('deleted', 'User deleted successfully!');
   

    }


}
