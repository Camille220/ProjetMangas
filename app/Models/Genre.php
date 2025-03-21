<?php

namespace App\Models;

use Illuminate\DataBase\Eloquent\Model;

class Genre extends Model
{
    protected $table='genre';
    protected $primaryKey='id_genre';
    public $timestamps=false;
}
