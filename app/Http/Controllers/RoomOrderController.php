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

    public function index() {
      if($request->has('room'))
      {
        $session_data = [
          'room_id' => $request->has('room'),
          'guest_id' => $request->has('guest_id')
        ];
        $request->session()->put('room', $session_data);
      }
      return view('roomorder.index', []);
    }

    public function add(Request $request) {
      //$links = \App\MenuItems::get('hotel_id', $this->defaultHotelId));
      $menuitems = \App\MenuItems::where('hotel_id', $this->defaultHotelId)->get();

      if($request->has('item_qty'))
      {
        print_r($request->get('item_qty'));die;
        $item_qty_arr = $request->get('item_qty');
        if(is_array($item_qty_arr)) {
          $menuorder = new \App\MenuOrder;
          $menuorder->hotel_id = $this->defaultHotelId;
          $menuorder->guest_id = $this->defaultHotelId;
          $menuorder->room_id = $this->defaultHotelId;
          $menuorder->order_date = $this->defaultHotelId;
          $menuorder->total_price = $this->defaultHotelId;
          $menuorder->order_fullfilled = 'Y';
          $menuorder->name = $request->get('name');
          $menuorder->is_active = (int)$request->get('is_active');

          $menuorder->save();

          foreach($item_qty_arr as $key => $item_qty) {
            $menuorderitem = new \App\MenuOrderItems;
            $menuorderitem->menu_order_id = $menuorder->id;
            $menuorderitem->menu_item_id = $key;
            $menuorderitem->qty = $item_qty;
            $menuorderitem->price = $this->defaultHotelId;
            $menuorderitem->is_active = (int)$request->get('is_active');
            $menuorderitem->save();
          }
        }
        $validatedData = $request->validate([
            'name' => 'required',
            'item_type' => 'required',
            'item_price' => 'required'
        ]);
        $menuitems= new \App\MenuItems;
        $menuitems->hotel_id = $this->defaultHotelId;
        $menuitems->name = $request->get('name');
        $menuitems->item_type = $request->get('item_type');

        $menuitems->item_price = $request->get('item_price');
        $menuitems->is_active = (int)$request->get('is_active');

        $menuitems->save();

        return redirect('roomorder')->with('success', 'Information has been added');
      }

      $menuitems_types = \App\MenuItemType::where('is_active', 1)->get();

      return view('roomorder.add', ['menuitems' => $menuitems]);
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
