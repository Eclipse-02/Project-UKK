<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RoomRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'type_id',
        'addons',
        'user_id',
        'checkin',
        'checkout',
        'promotion_code'
    ];

    protected $casts = [
        'addons' => 'array'
    ];

    function room() : BelongsTo {
        return $this->belongsTo(Room::class);
    }

    function type() : BelongsTo {
        return $this->belongsTo(RoomType::class);
    }

    function addOn() : BelongsTo {
        return $this->belongsTo(RoomAddOn::class);
    }

    function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
