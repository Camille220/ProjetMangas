<?php

namespace App\Http\Controllers;

use Exception;
use App\dao\ServiceManga;
use App\Models\Manga;
use App\dao\ServiceGenre;
use App\dao\ServiceDessinateur;
use App\dao\ServiceScenariste;
use Illuminate\Http\Request;
use MongoDB\Driver\Session;

class MangaController extends Controller
{
    public function listerMangas()
    {
        try{
            $serviceManga = new ServiceManga();
            $mangas = $serviceManga->getMangasAvecNoms();
            foreach ($mangas as $manga) {
                if (!file_exists('assets/images/'.$manga->couverture)){
                    $manga->couverture='erreur.png';
                }
            }
            return view('vues/pageMangas',compact('mangas'));
        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view('vues/pageErreur',compact('erreur'));
        }
    }

    public function ajouterManga()
    {
        try {
            $title="Ajouter un manga";
            $manga=new Manga();
            $serviceGenre=new ServiceGenre();
            $genres=$serviceGenre->getGenres();
            $serviceDessinateur=new ServiceDessinateur();
            $dessinateurs=$serviceDessinateur->getDessinateur();
            $serviceScenariste= new ServiceScenariste();
            $scenaristes=$serviceScenariste->getScenariste();
            return view('vues/formManga',compact('title','manga','genres',"dessinateurs",'scenaristes'));

        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view('vues/pageErreur',compact('erreur'));
        }
    }

    public function validerManga(Request $request)
    {
        try{
            $serviceManga=new ServiceManga();
            $id_manga=$request->input('hid_id');
            if($id_manga==0){
            $manga = new Manga();
            }else{
                $manga=$serviceManga->getManga($id_manga);
            }
            $manga->titre=$request->input('txt_titre');
            $manga->id_genre=$request->input('sel_genre');
            $manga->id_dessinateur=$request->input('sel_dessinateur');
            $manga->id_scenariste=$request->input('sel_scenariste');
            $manga->prix=$request->input('num_prix');
            $couv=$request->file('fil_couv');
            if (isset($couv)){
                $manga->couverture=$couv->getClientOriginalName();
                $couv->move(public_path().'/assets/images/',$manga->couverture);
            }
            $serviceManga->saveManga($manga);
            return redirect('listerMangas');
        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view('vues/pageErreur',compact('erreur'));
        }
    }

    public function modifierManga($id)
    {
        try{
            $title="Modifier un manga";
            $serviceManga=new ServiceManga();
            $manga=$serviceManga->getManga($id);
            $serviceGenre=new ServiceGenre();
            $genres=$serviceGenre->getGenres();
            $serviceDessinateur=new ServiceDessinateur();
            $dessinateurs=$serviceDessinateur->getDessinateur();
            $serviceScenariste= new ServiceScenariste();
            $scenaristes=$serviceScenariste->getScenariste();
            return view('vues/formManga',compact('title','manga','genres',"dessinateurs",'scenaristes'));
        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view('vues/pageErreur',compact('erreur'));
        }
    }

    public function supprimerManga($id)
    {
        try {
            $serviceManga = new ServiceManga();
            $serviceManga->delManga($id);
        }catch (Exception $e){
            Session::put('erreur',$e->getMessage());
        }
        return redirect(route('mangas'));
    }

    public function getMangaGenre($id)
    {
        try{
            $serviceManga = new ServiceManga();
            $mangas = $serviceManga->MangaParGenre($id);
            foreach ($mangas as $manga) {
                if (!file_exists('assets/images/'.$manga->couverture)){
                    $manga->couverture='erreur.png';
                }
            }
            return view('vues/pageMangas',compact('mangas'));
        }catch(Exception $e){
            $erreur=$e->getMessage();
            return view('vues/pageErreur',compact('erreur'));
        }
    }

    public function getgenre()
    {
        try {
            $title="Liste des mangas par genre";
            $serviceGenre=new ServiceGenre();
            $genre=$serviceGenre->getGenres();
            return view('vues/ChoisirMangaGenre',compact('title','genre'));
        }catch (Exception $e){
            $erreur=$e->getMessage();
            return view('vues/pageErreur',compact('erreur'));
        }
    }


    public function postGenre(Request $request)
    {
        try{
            $idgenre = $request->input('sel_genre');
            return redirect(route ('mangasGenre',[$idgenre]));

        }catch (Exception $e){
            if ($idgenre ==0){
                $erreur="Vous devez choisir un genre";
                echo $erreur;
                return redirect('getGenre');


            }else{
                $erreur=$e->getMessage();
            }
            return view('vues/pageErreur',compact('erreur'));
        }
    }




}
