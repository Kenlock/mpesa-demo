<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuItems extends Model
{
    protected $table = 'hotel_menu_items';
    //
    public function itemType()
    {
      return $this->belongsTo('App\MenuItemType', 'item_type');
    }
}
