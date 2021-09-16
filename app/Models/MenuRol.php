<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuRol extends Model
{
    use HasFactory;

    protected $table = 'menu_rol';

    protected $fillable = [
        'idRol',
        'idMenu'
    ];

}
