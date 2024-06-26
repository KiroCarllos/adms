<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadEvent extends Model
{
    use HasFactory;
    protected $table ="events";
    protected $fillable = [
        "title",
        "image",
        "comment",
    ];
}
