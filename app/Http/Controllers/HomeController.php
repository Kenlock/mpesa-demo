<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index() {
      return view('home.index', []);
    }

    public function __construct() {
      $defaultHotel = Hotel::where('key', config('app.default_hotel_key'))->firstOrFail();
      $this->defaultHotelId = $defaultHotel->id;
    }
    public function roomData(Request $request) {
      $room_types = \App\RoomType::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      $room_data = [];
      foreach($room_types as $room_type) {
        $room_data[$room_type->id] = ['name' => $room_type->name, 'rooms' => []];
      }
      $rooms = \App\Room::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      foreach($rooms as $room) {
        $room_data[$room->room_type_id]['rooms'][] = ['id' => $room->id, 'room_no' => $room->room_no ];
      }
      return response()->json($room_data);
    }

    public function roomLogin(Request $request) {
      $room_types = \App\RoomType::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      if($request->has('room'))
      {
        // echo 'EEEE';die;
        $roomObj = \App\Room::find($request->get('room'));
        $session_data = [
          'room_id' => $request->get('room'),
          'room_type_id' => $request->get('room_type'),
          'guest_id' => null
        ];
        // print_r($session_data);
        if($roomObj->booking_id !== null) {
          $guestObj = \App\Guests::where('booking_id', $roomObj->booking_id)->firstOrFail();
          $session_data['guest_id'] = $guestObj->id;
        }

        $request->session()->put('room', $session_data);
        return redirect('roomorder')->with('success', 'Information has been updated');
      }

      $session_room = $request->session()->get('room');
      //print_r($session_room);
      $current_room = '';
      if($session_room['room_id']) {
        // $request->session()->get('room');
        $roomObj = \App\Room::find($session_room['room_id']);
        // print_r($roomObj->room_no);
        $current_room = $roomObj->room_no;
      }

      return view('home.roomlogin', ['current_room' => $current_room, 'roomtypes' => $room_types]);
    }

    public function adminLogin(Request $request) {
      if($request->has('username'))
      {
        $request->session()->put('user_session', [
          'id' => 1,
          'username' => $request->get('username')
        ]);

        return redirect('admindashboard')->with('success', 'Information has been added');
      }
      return view('home.adminlogin');
    }

    public function adminDashboard(Request $request) {
      /*if(!$request->session()->get('user_seesion'))
      {
        return redirect('adminLogin')->with('success', 'Information has been added');
      }*/
      // $links = \App\Room::where('hotel_id', $this->defaultHotelId)->where('occupied', $this->defaultHotelId)->paginate(config('app.default_pagination'));
      $rooms = DB::table('hotel_rooms')
        ->leftJoin('hotel_booking', 'hotel_rooms.booking_id', '=', 'hotel_booking.id')
        ->leftJoin('hotel_guests', 'hotel_rooms.booking_id', '=', 'hotel_guests.id')
        ->select('hotel_rooms.room_no', 'hotel_rooms.booking_id', 'hotel_rooms.occupied', 'hotel_booking.start_date', 'hotel_booking.end_date',
                'hotel_guests.first_name', 'hotel_guests.last_name', 'hotel_guests.city', 'hotel_guests.state' )
        ->where([
            [ 'hotel_rooms.hotel_id', '=', $this->defaultHotelId ],
          ])
        ->orderBy('hotel_rooms.id', 'asc')
        ->get();
      /*  echo '<pre>';
        print_r($rooms);
die;*/
      return view('home.admindashboard', ['rooms' => $rooms]);
    }
}
