<?php

namespace App\Http\Controllers;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPassword extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.forgot');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'useremail'=>'required|email|exists:users,user_email'
        ]);
        return view('auth.forgot');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function sendForgotPasswordEmail(Request $request)
    {
        // Validate the email address
        $request->validate(['useremail' => 'required|email|exists:users,user_email']);

        // Try to send the reset link
        $status = Password::sendResetLink(
            ['user_email' => $request->input('useremail')]
        );

        // Check if the reset link was sent successfully
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['useremail' => __($status)]);
    }
}
