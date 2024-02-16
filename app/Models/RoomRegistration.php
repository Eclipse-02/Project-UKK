<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'type_id',
        'add_on_id',
        'user_id',
        'checkin',
        'checkout',
        'promotion_code'
    ];
}
