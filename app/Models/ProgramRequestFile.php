<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRequestFile extends Model
{
    use HasFactory;
    protected $table ="program_request_files";
    protected $fillable = [
        "program_request_id",
        "type",
        "file",
    ];
}
