<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class celular extends Model
{
    protected $fillable = [
        'modelo',
        'memoria_ram',
        'memoria_rom',
    ];

}
