<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramRequest extends Model
{
    use HasFactory;
    protected $table ="program_requests";
    protected $fillable = [
        "director",
        "mission",
        "order_number",
        "goals",
        "role",
    ];
    protected $casts = [
        "director"  => "json",
        "order_number"  => "integer",
    ];
    public function files(){
        return $this->hasMany(ProgramRequestFile::class,"program_request_id","id");
    }
}
