<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
class MenuItemsController extends Controller
{
    public function __construct() {
      $defaultHotel = Hotel::where('key', config('app.default_hotel_key'))->firstOrFail();
      $this->defaultHotelId = $defaultHotel->id;
    }

    public function index() {

      $links = \App\MenuItems::where('hotel_id', $this->defaultHotelId)->paginate(config('app.default_pagination'));
      //echo '<pre>';
      //print_r($links);
      return view('menuitems.index', ['links' => $links]);
    }

    public function add(Request $request) {
      if($request->has('name'))
      {
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

        return redirect('menuitems')->with('success', 'Information has been added');
      }

      $menuitems_types = \App\MenuItemType::where('is_active', 1)->get();

      return view('menuitems.add', ['menuitemstypes' => $menuitems_types]);
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
