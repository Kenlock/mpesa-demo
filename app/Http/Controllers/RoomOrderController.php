<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
class RoomOrderController extends Controller
{
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
    public function index(Request $request) {
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
      $info = [];
      if($session_room['room_id']) {
        // $request->session()->get('room');
        $roomObj = \App\Room::find($session_room['room_id']);
        // print_r($roomObj->room_no);
        $current_room = $roomObj->room_no;

        $guestObj = \App\Guests::find($session_room['guest_id']);
        $bookingObj = \App\Booking::find($guestObj->booking_id);
        $info['guest_name'] = $guestObj->first_name.' '.$guestObj->last_name;

        $info['rented_start'] = $bookingObj->start_date;

        $info['rented_end'] = $bookingObj->end_date;

      }

      return view('roomorder.index', ['current_room' => $current_room, 'info' => $info]);
    }

    public function add(Request $request) {
      //$links = \App\MenuItems::get('hotel_id', $this->defaultHotelId));
      $menuitems = \App\MenuItems::where('hotel_id', $this->defaultHotelId)->get();

      $prices = [];
      foreach($menuitems as $menuitem) {
        $prices[$menuitem->id] = [ 'type' => $menuitem->item_type,  'price' => $menuitem->item_price ];
      }
      // print_r($prices);
      $session_room = $request->session()->get('room');
      if($request->has('item_qty'))
      {
        // print_r($request->get('item_qty'));die;
        $item_qty_arr = $request->get('item_qty');
        if(is_array($item_qty_arr)) {
          $menuorder = new \App\MenuOrder;
          $menuorder->hotel_id = $this->defaultHotelId;
          $menuorder->guest_id = $session_room['guest_id'];
          $menuorder->room_id = $session_room['room_id'];
          $menuorder->order_date = date('Y-m-d H:i:s');
          // $menuorder->total_price = $this->defaultHotelId;
          $menuorder->order_fullfilled = 'YES';
          // $menuorder->name = $request->get('name');
          $menuorder->is_active = 1;

          $menuorder->save();
          $tprice = 0;
          foreach($item_qty_arr as $key => $item_qty) {
            //echo $key.' = ';
            //echo $item_qty.' - ';
            // $menuitems = \App\MenuItems::where('hotel_id', $this->defaultHotelId)->get();
            if($item_qty > 0) {
              $tprice += ( $prices[$key]['price'] * $item_qty );
              $menuorderitem = new \App\MenuOrderItems;
              $menuorderitem->menu_order_id = $menuorder->id;
              $menuorderitem->menu_item_id = $key;
              $menuorderitem->qty = $item_qty;
              $menuorderitem->price = $prices[$key]['price'];
              $menuorderitem->is_active = 1;
              $menuorderitem->save();
            }

          }

          $menuorder->total_price = $tprice;
          $menuorder->save();

        }

        return redirect('roomorder')->with('success', 'Information has been added');
      }

      $menuitems_types = \App\MenuItemType::where('is_active', 1)->get();

      return view('roomorder.add', ['menuitems' => $menuitems]);
    }

    public function orderlist(Request $request) {
      $session_room = $request->session()->get('room');
      $links = \App\MenuOrder::where('hotel_id', $this->defaultHotelId)->where('guest_id', $session_room['guest_id'])->orderBy('order_date', 'desc')->paginate(50);
      //echo '<pre>';
      //print_r($links);
      return view('roomorder.orderlist', ['links' => $links]);
    }

    public function view($id, Request $request) {

      $menuorder = \App\MenuOrder::find($id);

      return view('menuorder.view', ['menuorder' => $menuorder]);
    }

    public function edit($id, Request $request) {
      // https://appdividend.com/2018/02/23/laravel-5-6-crud-tutorial/

      $menuitem = \App\MenuItems::find($id);

      if($request->has('name'))
      {
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

        return redirect('menuitems')->with('success', 'Information has been updated');
      }
      $menuitems_types = \App\MenuItemType::where('is_active', 1)->get();
      return view('menuitems.edit', ['menuitem' => $menuitem, 'menuitemstypes' => $menuitems_types]);
    }
}
