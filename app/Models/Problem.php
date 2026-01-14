<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;

    protected $fillable = [
        'zone',
        'sub_zone',
        'problem_type',
        'solved_by',
        'status',
    ];
}
