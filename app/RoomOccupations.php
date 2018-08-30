<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomOccupations extends Model
{
    protected $table = 'hotel_room_occupations';
    //
    public function guest()
    {
      return $this->belongsTo('App\Guests', 'guest_id');
    }

    public function hotel()
    {
      return $this->belongsTo('App\Hotel', 'hotel_id');
    }
}
