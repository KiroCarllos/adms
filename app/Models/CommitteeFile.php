<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommitteeFile extends Model
{
    use HasFactory;
    protected $table ="committee_files";
    protected $fillable = [
        "committee_id",
        "type",
        "file",
    ];
}
