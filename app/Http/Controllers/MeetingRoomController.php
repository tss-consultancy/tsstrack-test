<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MeetingRooms;
use Redirect;
class MeetingRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meeting_rooms = MeetingRooms::all();
        $data = compact('meeting_rooms');
        return view('meeting-rooms.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('meeting-rooms.create');
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
            'title'=>'required|unique:meeting_rooms,meeting_room_name|string|max:255',
        ]);
        $meeting_rooms = new MeetingRooms;
        $meeting_rooms->meeting_room_name = $request['title'];
        $meeting_rooms->save();
        return Redirect::to('/meeting-rooms/index')->with('added','Meeting Room added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $meeting_rooms = MeetingRooms::find($id);
        $data = compact('meeting_rooms');
        return view('meeting-rooms.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
        $meeting_rooms = MeetingRooms::find($id);
        $data = compact('meeting_rooms');
        return view('meeting-rooms.edit')->with($data);
       
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
            'title'=>'required|unique:meeting_rooms,meeting_room_name|string|max:255',
        ]);
        $meeting_rooms = MeetingRooms::find($id);
        $meeting_rooms->meeting_room_name = $request['title'];
        $meeting_rooms->save();
        return Redirect::to('/meeting-rooms/index')->with('added','Meeting Room updated Successfully!');
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
            return Redirect::to('/meeting-rooms/index');
        }
        else{
            $meeting_rooms = MeetingRooms::find($id)->delete();
            return Redirect::to('/meeting-rooms/index')->with('deleted', 'Meeting Room deleted successfully!');
        }
    }
}
