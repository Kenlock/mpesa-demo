<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index() {
      $links = \App\Hotel::paginate(config('app.default_pagination'));
      //echo '<pre>';
      //print_r($links);
      return view('hotels.index', ['links' => $links]);
    }

    public function add(Request $request) {
      if($request->has('name'))
      {
        $validatedData = $request->validate([
            'name' => 'required',
            'key' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'contact_name' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
        ]);
        $hotel= new \App\Hotel;
        $hotel->name = $request->get('name');
        $hotel->key = $request->get('key');
        $hotel->address = $request->get('address');
        $hotel->city = $request->get('city');
        $hotel->state = $request->get('state');
        $hotel->pincode = $request->get('pincode');
        $hotel->contact_name = $request->get('contact_name');
        $hotel->contact_phone1 = $request->get('phone1');
        $hotel->contact_phone2 = $request->get('phone2');
        //$hotel->created_at = now();
        //$hotel->modified_at = now();
        $hotel->is_active = (int)$request->get('is_active');

        $hotel->save();

        return redirect('hotels')->with('success', 'Information has been added');
      }
      return view('hotels.add', []);
    }

    public function edit($id, Request $request) {
      // https://appdividend.com/2018/02/23/laravel-5-6-crud-tutorial/

      $hotel = \App\Hotel::find($id);

      if($request->has('name'))
      {
        $validatedData = $request->validate([
            'name' => 'required',
            'key' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required',
            'contact_name' => 'required',
            'phone1' => 'required',
            'phone2' => 'required',
        ]);
        $hotel->name = $request->get('name');
        $hotel->key = $request->get('key');
        $hotel->address = $request->get('address');
        $hotel->city = $request->get('city');
        $hotel->state = $request->get('state');
        $hotel->pincode = $request->get('pincode');
        $hotel->contact_name = $request->get('contact_name');
        $hotel->contact_phone1 = $request->get('phone1');
        $hotel->contact_phone2 = $request->get('phone2');
        //$hotel->created_at = now();
        //$hotel->modified_at = now();
        $hotel->is_active = (int)$request->get('is_active');;

        $hotel->save();

        return redirect('hotels')->with('success', 'Information has been added');
      }

      return view('hotels.edit', ['hotel' => $hotel]);
    }
}
