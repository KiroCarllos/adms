<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicAdvisor extends Model
{
    use HasFactory;
    protected $table ="academic_advisors";
    protected $fillable = [
        "users",
    ];
    protected $casts = [
        "users" => "array",
    ];

}
