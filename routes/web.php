<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Fluides;
use App\Models\Marques;
use App\Models\ListeSites;
use App\Models\ListeModele;
use App\Models\DataModele;
use App\Models\DataRole;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("/test_commande", function(Request $r){
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
});

Route::get("/test", [AdminController::class, "test"]);

Route::controller(LandingpageController::class)->group(function(){
    Route::get("/signin", "signin");
    Route::post("/do_login", "do_login");
    Route::post("/do_signin", "do_signin");
    Route::view('/', 'welcome');
});

Route::controller(UserController::class)->group(function(){
    Route::get("/profil", "profil");
    Route::view("/profil_entreprise", "profil_entreprise");
});

Route::controller(AdminController::class)->group(function(){
    Route::post("/add_site", "add_site");
    Route::post("/add_ensemble", "add_ensemble");
});

Route::post("get_modele_detail", function(Request $r):String
{
    $modele = DataModele::find(intval(request()->id));
    $nature = $modele->modele_nature->modele_nature;
    $fabricant = $modele->modele_fabricant->modele_fabricant;
    $designation = $modele->modele_designation->modele_designation;
    $reference = $modele->modele_reference->modele_reference;
    $pminc = $modele->p_min_constructeur;
    $pmaxc = $modele->p_max_constructeur;
    $tminc = $modele->t_min_constructeur;
    $tmaxc = $modele->t_max_constructeur;
    $tarage = $modele->tarage;
    return json_encode([
        "nature" => $nature,
        "fabricant" => $fabricant,
        "designation" => $designation,
        "reference" => $reference,
        "pminc" => $pminc,
        "pmaxc" => $pmaxc,
        "tminc" => $tminc,
        "tmaxc" => $tmaxc,
        "tarage" => $tarage,
    ]);
});
