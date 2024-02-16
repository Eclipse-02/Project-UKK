<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromotionCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'code_name',
        'discount',
        'begin_at',
        'end_at'
    ];
}
