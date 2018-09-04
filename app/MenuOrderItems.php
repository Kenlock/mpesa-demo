<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuOrderItems extends Model
{
    protected $table = 'hotel_menu_order_items';
    //
    public function menuOrder()
    {
      return $this->belongsTo('App\MenuOrder', 'menu_order_id');
    }

    public function menuItem()
    {
      return $this->belongsTo('App\MenuItems', 'menu_item_id');
    }

}
