<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuOrder extends Model
{
    protected $table = 'hotel_menu_orders';
    //
    public function guest()
    {
      return $this->belongsTo('App\Guests', 'guest_id');
    }

    public function room()
    {
      return $this->belongsTo('App\Room', 'room_id');
    }

    public function hotel()
    {
      return $this->belongsTo('App\Hotel', 'hotel_id');
    }
}
