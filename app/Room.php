<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table = 'hotel_rooms';
    //

    public function roomType()
    {
        return $this->belongsTo('App\RoomType', 'room_type_id');
    }
}
