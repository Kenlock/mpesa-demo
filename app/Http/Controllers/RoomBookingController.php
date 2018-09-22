<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
class RoomBookingController extends Controller
{
    public function __construct() {
      $defaultHotel = Hotel::where('key', config('app.default_hotel_key'))->firstOrFail();
      $this->defaultHotelId = $defaultHotel->id;
    }

    public function index() {

      $links = \App\Booking::where('hotel_id', $this->defaultHotelId)->paginate(config('app.default_pagination'));
      //echo '<pre>';
      //print_r($links);
      return view('roombooking.index', ['links' => $links]);
    }

    public function roomData(Request $request) {
      $room_types = \App\RoomType::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      $room_data = [];
      foreach($room_types as $room_type) {
        $room_data[$room_type->id] = ['name' => $room_type->name, 'rooms' => []];
      }
      $rooms = \App\Room::where('is_active', 1)->where('occupied', 'No')->where('hotel_id', $this->defaultHotelId)->get();
      foreach($rooms as $room) {
        $room_data[$room->room_type_id]['rooms'][] = ['id' => $room->id, 'room_no' => $room->room_no ];
      }
      return response()->json($room_data);
    }

    public function add(Request $request) {
      if($request->has('name'))
      {
        $validatedData = $request->validate([
            'name' => 'required',
            'item_type' => 'required',
            'item_price' => 'required'
        ]);
        $roombooking= new \App\RoomBooking;
        $roombooking->hotel_id = $this->defaultHotelId;
        $roombooking->name = $request->get('name');
        $roombooking->item_type = $request->get('item_type');

        $roombooking->item_price = $request->get('item_price');
        $roombooking->is_active = (int)$request->get('is_active');

        $roombooking->save();

        return redirect('roombooking')->with('success', 'Information has been added');
      }
      $session_data = $request->session()->get('booking');
      $roombooking_types = \App\MenuItemType::where('is_active', 1)->get();
      $room_types = \App\RoomType::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      /*$room_data = [];
      foreach($room_types as $room_type) {
        $room_data[$room_type->id] = ['name' => $room_type->name, 'rooms' => []];
      }
      $rooms = \App\Room::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();
      foreach($rooms as $room) {
        $room_data[$room->room_type_id]['rooms'][] = ['id' => $room->id, 'room_no' => $room->room_no ];
      }*/
      /*echo '<pre>';
      print_r($room_data);die;*/
      // $j_room_data = json_encode($room_data);
      return view('roombooking.add', ['roomtypes' => $room_types, 'session_data' => $session_data]);
    }

    public function edit($id, Request $request) {
      // https://appdividend.com/2018/02/23/laravel-5-6-crud-tutorial/

      $booking = \App\Booking::find($id);
      $guest = \App\Guests::where('booking_id', $id)->firstOrFail();
      $roomBookData = \App\RoomOccupations::where('is_active', 1)->where('booking_id', $id)->get();

      $rooms = [];
      foreach($roomBookData as $roomBook) {
        $room = \App\Room::find($roomBook->room_id);

        $rooms[] = (object) [
          'id' => $roomBook->room_id,
          'type' => $room->room_type_id,
        ];
      }

      // print_r($rooms);die;

      if($request->has('name')) {
        $validatedData = $request->validate([
          'name' => 'required',
          'item_type' => 'required',
          'item_price' => 'required'
        ]);

        $menuitem->name = $request->get('name');
        $menuitem->item_type = $request->get('item_type');

        $menuitem->item_price = $request->get('item_price');
        $menuitem->is_active = (int)$request->get('is_active');
        $menuitem->save();

        return redirect('roombooking')->with('success', 'Information has been updated');
      }

      $booking->start_date_formatted = date('Y-m-d', strtotime($booking->start_date));
      $booking->end_date_formatted = date('Y-m-d', strtotime($booking->end_date));
      // echo $booking->end_date_formatted;die;
      $room_types = \App\RoomType::where('is_active', 1)->where('hotel_id', $this->defaultHotelId)->get();

      return view('roombooking.edit', ['booking' => $booking, 'rooms' => $rooms, 'guest' => $guest, 'roomtypes' => $room_types]);
    }

    public function saveSearch(Request $request) {
      try {
        if($request->has('total_guests'))
        {
          $validatedData = $request->validate([
            'total_guests' => 'required',
            'total_rooms' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
          ]);

          $session_data = [
            'search' => [
              'total_guests' => $request->get('total_guests'),
              'total_rooms' => $request->get('total_rooms'),
              'start_date' => $request->get('start_date'),
              'end_date' => $request->get('end_date')
            ],
            'rooms' => [],
            'guests' => [],
          ];
          $request->session()->put('booking', $session_data);

        }
        return response()->json(['message' => 'Data Saved', 'session_data' => $session_data ]);
      } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
      }
    }

    public function saveRooms(Request $request) {
      try {
        if($request->has('room'))
        {
          /*$validatedData = $request->validate([
            'total_guests' => 'required',
            'total_rooms' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
          ]);*/

          $session_data = $request->session()->get('booking');
          $req_room_types = $request->get('room_type');
          $req_rooms = $request->get('room');
          for($i=0;$i<count($req_room_types);$i++) {
            $rooms[] = [ 'type' => $req_room_types[$i], 'id' => $req_rooms[$i] ];
          }
          $session_data['rooms'] = $rooms;
          $request->session()->put('booking', $session_data);

        }
        return response()->json(['message' => 'Data Saved', 'session_data' => $session_data ]);
      } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
      }
    }

    public function saveGuests(Request $request) {
      try {
        if($request->has('first_name'))
        {
          /*$validatedData = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'id_proof_type1' => 'required',
            'id_proof1' => 'required'
          ]);*/

          $session_data = $request->session()->get('booking');

          $session_data['guests'] = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address' => $request->get('address'),
            'city' => $request->get('city'),
            'state' => $request->get('state'),
            'pincode' => $request->get('pincode'),
            'id_proof_type1' => $request->get('id_proof_type1'),
            'id_proof1' => $request->get('id_proof1'),
            'id_proof_type2' => $request->get('id_proof_type2'),
            'id_proof2' => $request->get('id_proof2'),
            'address_proof_type1' => $request->get('address_proof_type1'),
            'address_proof1' => $request->get('address_proof1'),
            'address_proof_type2' => $request->get('address_proof_type2'),
            'address_proof2' => $request->get('address_proof2')
          ];
          $request->session()->put('booking', $session_data);
          return response()->json(['message' => 'Data Saved', 'session_data' => $session_data ]);
        }

      } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
      }
    }

    public function saveBooking(Request $request) {
      try {
        $session_data = $request->session()->get('booking');

        $booking = new \App\Booking;
        $booking->hotel_id = $this->defaultHotelId;
        $booking->total_guests = $session_data['search']['total_guests'];
        $booking->total_rooms = $session_data['search']['total_rooms'];
        $booking->start_date = $session_data['search']['start_date'];
        $booking->end_date = $session_data['search']['end_date'];
        $booking->paid = 'No';
        $booking->is_active = 1;
        $booking->save();
        $booking_id = $booking->id;

        $guest = new \App\Guests;
        $guest->hotel_id = $this->defaultHotelId;
        $guest->booking_id = $booking_id;
        $guest->first_name = $session_data['guests']['first_name'];
        $guest->last_name = $session_data['guests']['last_name'];
        $guest->address = $session_data['guests']['address'];
        $guest->city = $session_data['guests']['city'];
        $guest->state = $session_data['guests']['state'];
        $guest->pincode = $session_data['guests']['pincode'];
        $guest->IDNumberType1 = $session_data['guests']['id_proof_type1'];
        $guest->IDNumber1 = $session_data['guests']['id_proof1'];
        $guest->IDNumberType2 = $session_data['guests']['id_proof_type2'];
        $guest->IDNumber2 = $session_data['guests']['id_proof2'];
        $guest->AddrNumberType1 = $session_data['guests']['address_proof_type1'];
        $guest->AddrNumber1 = $session_data['guests']['address_proof1'];
        $guest->AddrNumberType2 = $session_data['guests']['address_proof_type2'];
        $guest->AddrNumber2 = $session_data['guests']['address_proof2'];
        $guest->is_active = 1;
        $guest->save();
        $guest_id = $guest->id;

        for($i=0;$i<count($session_data['rooms']);$i++) {
          $occupation = new \App\RoomOccupations;
          $occupation->booking_id = $booking_id;
          $occupation->guest_id = $guest_id;
          $occupation->room_id = $session_data['rooms'][$i]['id'];
          $occupation->start_date = $session_data['search']['start_date'];
          $occupation->end_date = $session_data['search']['end_date'];
          $occupation->paid = 'No';
          $occupation->is_active = 1;
          $occupation->save();

          $room = \App\Room::find($session_data['rooms'][$i]['id']);
          $room->booking_id = $booking_id;
          $room->occupied = 'Yes';
          $room->save();
        }

        return response()->json(['message' => 'Data Saved', 'session_data' => $session_data ]);
      } catch (\Exception $e) {
        return response()->json(['message' => $e->getMessage()]);
      }

    }
}
