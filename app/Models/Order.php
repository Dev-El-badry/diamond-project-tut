<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['room_id', 'hotel_id', 'user_id', 'order_ref', 'price', 'order_status'];

    public function room()
    {
        return $this->belongsTo(HotelRoom::class, 'room_id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
