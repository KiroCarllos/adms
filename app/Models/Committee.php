<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    use HasFactory;
    protected $table ="committees";
    protected $fillable = [
        "commit_name",
        "head_id",
        "decrees",
        "member_ids",
        "task_name",
        "start_date",
        "end_date",
    ];
    protected $casts = [
        "member_ids" => "array"
    ];
    public function head(){
        return $this->belongsTo(User::class,"head_id","id");
    }    public function files(){
        return $this->hasMany(CommitteeFile::class,"committee_id","id");
    }
}
