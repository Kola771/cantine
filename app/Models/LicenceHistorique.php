<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenceHistorique extends Model
{
    use HasFactory;
    protected $fillable = [
        "enterprise_name",
        "etat",
        "licence_year_start",
        "licence_year_end",
    ];
}
