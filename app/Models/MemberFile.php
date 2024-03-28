<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberFile extends Model
{
    use HasFactory;
    protected $table ="member_files";
    protected $fillable = [
        "user_id",
        "type",
        "file",
    ];
}
