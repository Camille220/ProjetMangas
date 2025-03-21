<?php

namespace App\Models;

use Illuminate\DataBase\Eloquent\Model;

class Dessinateur extends Model
{
    protected $table='dessinateur';
    protected $primaryKey='id_dessinateur';
    public $timestamps=false;
}
