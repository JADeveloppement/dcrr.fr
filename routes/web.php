<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Fluides;
use App\Models\Marques;
use App\Models\ListeSites;
use App\Models\ListeModele;
use App\Models\DataModele;
use App\Models\DataModeleType;
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
    $id = DataModeleType::where("modele_type", request()->type)->first()->id;
    return json_encode([
        "id" => $id,
        "r" => DataModele::join("data_modele_type", "data_modele_type.id", "=", "data_generic_modele.type")
                        ->select("data_generic_modele.id", "data_modele_type.modele_type", "data_generic_modele.designation")->where("type", $id)->get(),
    ]);
});

Route::post("/get_liste_modele", function(Request $r)
{
    $id = DataModeleType::where("modele_type", request()->type)->first()->id;
    return json_encode([
        "id" => $id,
        "r" => DataModele::join("data_modele_type", "data_modele_type.id", "=", "data_generic_modele.type")
                        ->join("data_modele_designation", "data_modele_designation.id", "=", "data_generic_modele.designation")
                        ->join("data_modele_reference", "data_modele_reference.id", "=", "data_generic_modele.complement_reference")
                        ->select("data_generic_modele.id", "data_modele_type.modele_type", "data_modele_designation.modele_designation", "data_modele_reference.modele_reference")->where("type", $id)->get(),
    ]);
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
    $type = $modele->modele_type->modele_type;
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
        "type" => $type,
        "nature" => $nature,
        "fabricant" => $fabricant,
        "designation" => $designation,
        "complement_reference" => $reference,
        "pminc" => $pminc,
        "pmaxc" => $pmaxc,
        "tminc" => $tminc,
        "tmaxc" => $tmaxc,
        "tarage" => $tarage,
    ]);
});

Route::post("/add_modele", function(Request $r): String
{
    $id = request()->id;
    $categorie_ff = request()->categorie_ff;
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

    $datasource = DataModele::select("data_generic_modele.id as id",
                                    "data_modele_type.modele_type as type",
                                    "data_modele_nature.modele_nature as nature",
                                    "data_modele_fabricant.modele_fabricant as fabricant",
                                    "data_modele_designation.modele_designation as designation",
                                    "data_modele_reference.modele_reference as complement_reference",
                                    "data_generic_modele.p_min_constructeur as pminc",
                                    "data_generic_modele.p_max_constructeur as pmaxc",
                                    "data_generic_modele.t_min_constructeur as tminc",
                                    "data_generic_modele.t_max_constructeur as tmaxc",
                                    "data_generic_modele.tarage as tarage")
                            ->join("data_modele_type", "data_modele_type.id", "=", "data_generic_modele.type")
                            ->join("data_modele_nature", "data_modele_nature.id", "=", "data_generic_modele.nature")
                            ->join("data_modele_fabricant", "data_modele_fabricant.id", "=", "data_generic_modele.fabricant")
                            ->join("data_modele_designation", "data_modele_designation.id", "=", "data_generic_modele.designation")
                            ->join("data_modele_reference", "data_modele_reference.id", "=", "data_generic_modele.complement_reference")
                            ->where("data_generic_modele.id", $id)->first();
    return json_encode([
        "r" => $datasource,
        [$id,$categorie_ff,$pmaxr,$pminr,$tmaxr,$tminr,$date_mes,$numerodeserie,$annee,$user_parent,$site_parent,$ensemble_parent]
    ]);
});
