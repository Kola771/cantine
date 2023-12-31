<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminEntreprise extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "entreprise_name",
        "admin_lastname",
        "admin_firstname",
        "licence_year_start",
        "licence_year_end",
    ];
}
