<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
class RoomTypeController extends Controller
{
    public function __construct() {
      $defaultHotel = Hotel::where('key', config('app.default_hotel_key'))->firstOrFail();
      $this->defaultHotelId = $defaultHotel->id;
    }

    public function index() {

      $links = \App\RoomType::where('hotel_id', $this->defaultHotelId)->paginate(config('app.default_pagination'));
      //echo '<pre>';
      //print_r($links);
      return view('roomtypes.index', ['links' => $links]);
    }

    public function add(Request $request) {
      if($request->has('name'))
      {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);
        $roomtype= new \App\RoomType;
        $roomtype->hotel_id = $this->defaultHotelId;
        $roomtype->name = $request->get('name');
        $roomtype->price = $request->get('price');
        $roomtype->is_active = (int)$request->get('is_active');

        $roomtype->save();

        foreach($request->get('facilities') as $facility) {
          if(!empty($facility)) {
            $roomtypefacility= new \App\RoomTypeFacility;
            $roomtypefacility->room_type_id = $roomtype->id;
            $roomtypefacility->facility = $facility;
            $roomtypefacility->save();
          }
        }

        return redirect('roomtypes')->with('success', 'Information has been added');
      }
      return view('roomtypes.add', []);
    }

    public function edit($id, Request $request) {
      // https://appdividend.com/2018/02/23/laravel-5-6-crud-tutorial/

      $roomtype = \App\RoomType::find($id);
      $roomtype_facilities = \App\RoomTypeFacility::where('room_type_id', $id);
      /*foreach($roomtype_facilities as $facility) {
        echo $facility->facility;
        echo '<br>';
      }die;*/
      // echo $roomtype_facilities->count();die;
      if($request->has('name'))
      {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);
        $roomtype->name = $request->get('name');
        $roomtype->price = $request->get('price');
        $roomtype->is_active = (int)$request->get('is_active');

        $roomtype->save();

        \App\RoomTypeFacility::where('room_type_id', $id)->delete();
        foreach($request->get('facilities') as $facility) {
          if(!empty($facility)) {
            $roomtypefacility= new \App\RoomTypeFacility;
            $roomtypefacility->room_type_id = $roomtype->id;
            $roomtypefacility->facility = $facility;
            $roomtypefacility->save();
          }
        }
        return redirect('roomtypes')->with('success', 'Information has been updated');
      }

      return view('roomtypes.edit', ['roomtype' => $roomtype, 'roomtype_facilities' => $roomtype_facilities]);
    }
}
