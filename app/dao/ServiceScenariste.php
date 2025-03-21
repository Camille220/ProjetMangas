<?php

namespace App\dao;

use App\Models\Scenariste;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceScenariste
{
    public function getScenariste()
    {
        try {
            return Scenariste::all();
        }catch(QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }
}
