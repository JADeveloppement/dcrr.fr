<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Fluides;
use App\Models\Marques;
use App\Models\ListeSites;
use App\Models\ListeModele;
use App\Models\DataModele;
use App\Models\DataRole;
use App\Models\DataModeleType;
use Cookie;

class AdminController extends Controller
{
    private function get_cat($categorie_ff, $dn, $v, $p, $type):String
    {
        if ($type == 2)
            return "";
        else if ($type == 1)
            return "IV";
        else {
            if ($categorie_ff == 1){
                if ($p*$dn < 1000 || $dn < 25 || $p*$v < 50)
                    return "Art4.3 ou I";
                else if ($p*$dn < 3500 && $p*$dn > 1000 && $dn > 25 || $p*$v >= 50 && $p*$v < 200)
                    return "II";
                else if ($p*$dn > 3500 && $dn > 25 || $p*$v >= 200 && $p*$v < 1000)
                    return "III";
                else if ($p*$v >= 1000)
                    return "IV";
            } else if ($categorie_ff == 2){
                if ($p*$dn < 3500 || $dn < 100 || $p*$v < 200)
                    return "Art4.3 ou I";
                else if ($p*$dn < 5000 && $p*$dn > 3500 && $dn > 100 || $p*$v >= 200 && $p*$v < 1000)
                    return "II";
                else if ($p*$dn > 5000 && $dn > 100 || $p*$v >= 1000 && $p*$v < 3000)
                    return "III";
                else if ($p*$v > 3000)
                    return "IV";
            }
        }
    }

    protected function get_chap($type, $pmax, $ptest):String
    {
        if ($type == 1 || $type == 2)
            return "";
        else if ($type == "Tuyauterie")
            return "D";
        else if (intval($ptest) == 2 * intval($pmax))
            return "B";
        else return "C";
    }

    public function test_commande(Request $r){
        // EMPTY
    }

    public function add_site(Request $r){
        $proprietaire = request()->id;
        $code_client = request()->code_client;
        $nom_client = request()->nom_client;
        $nom_site = request()->nom_site;
        $code_site = request()->code_site;
        // $marque = request()->marque;
        // $date_mise_en_service = request()->date_mise_en_service;
        // $fluide_frigorigène = request()->fluide_frigorigène;
        // $designation_equipement = request()->designation_equipement;
        // $conforme = 0;
    
        $user_role = User::where("email", Cookie::get("dcrr_login"))->first()->data_role->id;
    
        $auth = "NC";
        $result = false;
    
        if ($user_role == DataRole::where("value", "Administrateur")->first()->id){
            $ls = new ListeSites;
            $ls->proprietaire = $proprietaire;
            $ls->code_client = $code_client;
            $ls->nom_client = $nom_client;
            $ls->nom_site = $nom_site;
            $ls->code_site = $code_site;
            // $ls->marquename = $marque;
            // $ls->date_mise_en_service = $date_mise_en_service;
            // $ls->fluide_frigorigène = $fluide_frigorigène;
            // $ls->designation_equipement = $designation_equipement;
            // $ls->conforme = $conforme;
            $result = $ls->save();
        }
        else if ($user_role == DataRole::where("value", "Employé")->first()->id){
    
        }
    
        return [
            $auth,
            $result,
            // Marques::find(intval($marque))->marque,
            // Fluides::find(intval($fluide_frigorigène))->nom_fluide,
        ];
    }
       
    public function add_ensemble(Request $r){
        $user_parent = request()->user_parent;
        $site_parent = request()->site_parent;
        $modele_parent = request()->modele_parent;
        $modele_to_add = request()->modele_to_add;
        $annee = request()->annee;
        $numerodeserie = request()->numerodeserie;
    
        $model_generic = DataModele::where("id", intval($modele_to_add))->first();
        $model = new ListeModele;
        $model->type = intval($model_generic->type);
        $model->nature = intval($model_generic->nature);
        $model->designation = intval($model_generic->designation);
        $model->complement_reference = intval($model_generic->complement_reference);
        $model->fabricant = intval($model_generic->fabricant);
        $model->volume = intval($model_generic->volume);
        $model->p_max_constructeur = intval($model_generic->p_max_constructeur);
        $model->p_min_constructeur = intval($model_generic->p_min_constructeur);
        $model->p_test = intval($model_generic->p_test);
        $model->tarage = intval($model_generic->tarage);
        $model->t_min_constructeur = intval($model_generic->t_min_constructeur);
        $model->t_max_constructeur = intval($model_generic->t_max_constructeur);
        $model->p_min_reel = 0;
        $model->p_max_reel = 0;
        $model->t_min_reel = 0;
        $model->t_max_reel = 0;
        $model->annee = $annee;
        $model->chapitre = 0;
        $model->categorie_de_risque = 0;
        $model->periodicite_inspection = 0;
        $model->date_mes = 0;
        $model->numero_de_serie = $numerodeserie;
        $model->modele_parent = $modele_parent;
        $model->user_parent = $user_parent;
        $model->site_parent = $site_parent;
    
        if ($model->save())
            return json_encode(["r" => 1]);
        else return json_encode(["r" => 0]);
    }

    public function add_modele(Request $r){
        $id = request()->id;
        $pmaxr = request()->pmaxr;
        $pminr = request()->pminr;
        $tmaxr = request()->tmaxr;
        $tminr = request()->tminr;
        $date_mes = request()->date_mes;
        $numerodeserie = request()->numerodeserie;
        $annee = request()->annee;
        $user_parent = request()->user_parent;
        $site_parent = request()->site_parent;
        $ensemble_parent = request()->ensemble_parent;
                
        $type = (DataModeleType::find(DataModele::find(request()->id)->type))->id;
        
        $categorie_ff = intval((ListeSites::select("listeSites.id as id",
                                            "liste_fluides.categorie as cat")
                                    ->join("liste_fluides", "liste_fluides.id", "=", "listeSites.fluide_frigorigène")
                                    ->where("listeSites.id", request()->site_parent)->first())->cat);

        $dn = intval(DataModele::find(request()->id)->diametre_nominal);
        $v = intval(DataModele::find(request()->id)->volume);
        $p = intval(DataModele::find(request()->id)->p_test);

        $categorie_equipement = $this->get_cat($categorie_ff, $dn, $v, $p, $type);

        $datasource = DataModele::find($id);
        $listeModele = new ListeModele;
        $listeModele->type = $datasource->type ? $datasource->type : null;
        $listeModele->nature = $datasource->nature ? $datasource->nature : null;
        $listeModele->designation = $datasource->designation ? $datasource->designation : null;
        $listeModele->complement_reference = $datasource->complement_reference ? $datasource->complement_reference : null;
        $listeModele->fabricant = $datasource->fabricant ? $datasource->fabricant : null;
        $listeModele->volume = $datasource->volume ? $datasource->volume : null;
        $listeModele->p_max_constructeur = $datasource->p_max_constructeur ? $datasource->p_max_constructeur : null;
        $listeModele->p_min_constructeur = $datasource->p_min_constructeur ? $datasource->p_min_constructeur : null;
        $listeModele->p_test = $datasource->p_test ? $datasource->p_test : null;
        $listeModele->t_max_constructeur = $datasource->t_max_constructeur ? $datasource->t_max_constructeur : null;
        $listeModele->t_min_constructeur = $datasource->t_min_constructeur ? $datasource->t_min_constructeur : null;
        $listeModele->tarage = $datasource->tarage ? $datasource->tarage : null;
        $listeModele->diametre_nominal = $datasource->diametre_nominal ? $datasource->diametre_nominal : null;
        $listeModele->categorie_de_risque = $datasource->categorie_de_risque ? $datasource->categorie_de_risque : null;
        $listeModele->periodicite_inspection = $datasource->periodicite_inspection ? $datasource->periodicite_inspection : null;
        $listeModele->numero_de_serie = $numerodeserie ? $numerodeserie : null;
        $listeModele->date_mes = $date_mes ? $date_mes : null;
        $listeModele->categorie_fluide_frigorigene = $categorie_equipement;
        $listeModele->p_max_reel = $pmaxr ? $pmaxr : null;
        $listeModele->p_min_reel = $pminr ? $pminr : null;
        $listeModele->t_max_reel = $tmaxr ? $tmaxr : null;
        $listeModele->t_min_reel = $tminr ? $tminr : null;
        $listeModele->annee = $annee ? $annee : null;
        $listeModele->user_parent = $user_parent;
        $listeModele->site_parent = $site_parent;
        $listeModele->modele_parent = $ensemble_parent;
        
        $pmax = $datasource->p_max_constructeur ? intval($datasource->p_max_constructeur) : 0;
        $listeModele->chapitre = $this->get_chap($type, $pmax, $p);

        return json_encode([
            "r" => $listeModele->save(),
        ]);
    }
}
