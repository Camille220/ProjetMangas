<?php

namespace App\dao;

use App\Models\Manga;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Exceptions\MonException;

class ServiceManga
{
    public function getMangasAvecNoms()
    {
        try{
            $mangas=DB::table('manga')
                ->select('id_manga','titre','prix','couverture',
                    'genre.lib_genre','dessinateur.nom_dessinateur','scenariste.nom_scenariste')
                ->join('genre','genre.id_genre','=','manga.id_genre')
                ->join('dessinateur','dessinateur.id_dessinateur','=','manga.id_dessinateur')
                ->join('scenariste','scenariste.id_scenariste','=','manga.id_scenariste')
                ->get();
            return $mangas;
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function saveManga(Manga $manga){
        try{
            $manga->save();
        }catch (QueryException $e){
            $erreur=$e->getMessage();
            if($manga->id_genre==0){
                $erreur="Vous devez sélectionnez un genre";
            }else if ($manga->id_dessinateur==0){
                $erreur="Vous devez sélectionnez un dessinateur";
            }else if($manga->id_scenariste==0){
                $erreur="Vous devez sélectionnez un scénariste";
            }else if(!isset($manga->couverture)){
                $erreur="Vous devez chosir une image de couverture";
            }
            throw new MonException($erreur,5);
        }
    }

    public function getManga($id){
        try{
            return Manga::query()
                ->findOrFail($id);
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function delManga($id)
    {
        try {
            Manga::destroy($id);
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }
    }

    public function MangaParGenre($idGenre)
    {
        try{
            $manga=DB::table('manga')
                ->select('id_manga','titre','prix','couverture',
                    'genre.lib_genre','dessinateur.nom_dessinateur','scenariste.nom_scenariste')
                ->join('genre','genre.id_genre','=','manga.id_genre')
                ->join('dessinateur','dessinateur.id_dessinateur','=','manga.id_dessinateur')
                ->join('scenariste','scenariste.id_scenariste','=','manga.id_scenariste')
                ->where('manga.id_genre',$idGenre)
            ->get();
            return $manga;
        }catch (QueryException $e){
            throw new MonException($e->getMessage(),5);
        }

    }
}
