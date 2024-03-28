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
        "goals",
        "role",
    ];
    protected $casts = [
        "director"  => ["array"]
    ];
    public function files(){
        return $this->hasMany(ProgramRequestFile::class,"program_request_id","id");
    }
}
