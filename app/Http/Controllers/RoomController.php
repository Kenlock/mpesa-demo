<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
class RoomController extends Controller
{
    public function __construct() {
      $defaultHotel = Hotel::where('key', config('app.default_hotel_key'))->firstOrFail();
      $this->defaultHotelId = $defaultHotel->id;
    }

    public function index() {

      $links = \App\Room::where('hotel_id', $this->defaultHotelId)->paginate(config('app.default_pagination'));
      //echo '<pre>';
      //print_r($links);
      return view('rooms.index', ['links' => $links]);
    }

    public function add(Request $request) {
      if($request->has('room_no'))
      {
        $validatedData = $request->validate([
            'room_no' => 'required',
            'room_type' => 'required'
        ]);
        $room= new \App\Room;
        $room->hotel_id = $this->defaultHotelId;
        $room->room_no = $request->get('room_no');
        $room->room_type_id = $request->get('room_type');
        $room->occupied = 'No';
        $room->is_active = (int)$request->get('is_active');

        $room->save();

        return redirect('rooms')->with('success', 'Information has been added');
      }
      $room_types = \App\RoomType::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      return view('rooms.add', ['roomtypes' => $room_types]);
    }

    public function edit($id, Request $request) {
      // https://appdividend.com/2018/02/23/laravel-5-6-crud-tutorial/

      $room = \App\Room::find($id);

      if($request->has('room_no'))
      {
        $validatedData = $request->validate([
            'room_no' => 'required',
            'room_type' => 'required'
        ]);

        $room->room_no = $request->get('room_no');
        $room->room_type_id = $request->get('room_type');
        $room->is_active = (int)$request->get('is_active');
        $room->save();

        return redirect('rooms')->with('success', 'Information has been updated');
      }
      $room_types = \App\RoomType::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      return view('rooms.edit', ['room' => $room, 'roomtypes' => $room_types]);
    }
}
