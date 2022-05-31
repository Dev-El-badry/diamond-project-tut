<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HotelRoom extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['code', 'hotel_id', 'price'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
