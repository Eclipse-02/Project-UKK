<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'room_number',
        'facility',
        'status'
    ];

    protected $casts = [
        'facility' => 'array'
    ];

    function type() : BelongsTo {
        return $this->belongsTo(RoomType::class, 'type_id', 'id');
    }
}
