<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnMdl extends Model
{
    use HasFactory;

    protected $table = "returns";

    protected $guarded = [];
}
