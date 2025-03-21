<?php

namespace App\dao;

use App\Models\Dessinateur;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceDessinateur
{
    public function getDessinateur()
    {
        try {
            return Dessinateur::all();
        }catch(QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }
}
