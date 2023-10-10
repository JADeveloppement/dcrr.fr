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
use Cookie;

class AdminController extends Controller
{

    public function add_site(Request $r){
        $proprietaire = request()->id;
        $code_client = request()->code_client;
        $nom_client = request()->nom_client;
        $nom_site = request()->nom_site;
        $code_site = request()->code_site;
        $marque = request()->marque;
        $date_mise_en_service = request()->date_mise_en_service;
        $fluide_frigorigène = request()->fluide_frigorigène;
        $designation_equipement = request()->designation_equipement;
        $conforme = 0;
    
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
            $ls->marquename = $marque;
            $ls->date_mise_en_service = $date_mise_en_service;
            $ls->fluide_frigorigène = $fluide_frigorigène;
            $ls->designation_equipement = $designation_equipement;
            $ls->conforme = $conforme;
            $result = $ls->save();
        }
        else if ($user_role == DataRole::where("value", "Employé")->first()->id){
    
        }
    
        return [
            $auth,
            $result,
            Marques::find(intval($marque))->marque,
            Fluides::find(intval($fluide_frigorigène))->nom_fluide,
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
}
