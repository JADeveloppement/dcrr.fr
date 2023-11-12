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

use App\Models\ListeActionUser;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\UserController;

use Illuminate\Http\Request;

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
    Route::post("/add_modele", "add_modele");
    Route::get("/test_commande", "test_commande");
    Route::post("/calc_categorierisque", "calc_categorierisque");
    Route::post("/calc_chapitre", "calc_chapitre");
    Route::post("/calc_dms", "calc_dms");
});

//get detail of generic modele
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

    $volume = $modele->volume ? $modele->volume : "";
    $dn = $modele->diametre_nominal ? $modele->diametre_nominal : "";
    $chapitre = $modele->chapitre ? $modele->chapitre : "";
    $categorierisque = $modele->categorie_de_risque ? $modele->categorie_de_risque : "";
    $dms = $modele->declaration_MES ? $modele->declaration_MES : 0;

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
        "volume" => $volume,
        "dn" => $dn,
        "chapitre" => $chapitre,
        "categorierisque" => $categorierisque,
        "dms" => $dms,
    ]);
});

// get details of model created by user
Route::post("/get_modele_data_detail", function(Request $r){
    $id = request()->id;

    $lmdetail = ListeModele::select('data_modele_type.modele_type as type',
                                    'data_modele_nature.modele_nature as nature',
                                    'data_modele_designation.modele_designation as designation',
                                    'data_modele_reference.modele_reference as complement_reference',
                                    'data_modele_fabricant.modele_fabricant as fabricant',
                                    'listeModele.volume',
                                    'listeModele.p_max_constructeur',
                                    'listeModele.p_min_constructeur',
                                    'listeModele.p_test',
                                    'listeModele.p_max_reel',
                                    'listeModele.p_min_reel',
                                    'listeModele.t_max_constructeur',
                                    'listeModele.t_min_constructeur',
                                    'listeModele.t_max_reel',
                                    'listeModele.t_min_reel',
                                    'listeModele.tarage',
                                    'listeModele.date_mes',
                                    'listeModele.categorie_fluide_frigorigene',
                                    'listeModele.numero_de_serie',
                                    'listeModele.annee',
                                    'listeModele.modele_parent',
                                    'listeModele.user_parent',
                                    'listeModele.site_parent',
                                    'listeModele.chapitre',
                                    'listeModele.diametre_nominal',
                                    'listeModele.categorie_de_risque',
                                    'listeModele.periodicite_inspection')
                            ->join("data_modele_type", "data_modele_type.id", "=", "listeModele.type")
                            ->join("data_modele_nature", "data_modele_nature.id", "=", "listeModele.nature")
                            ->join("data_modele_designation", "data_modele_designation.id", "=", "listeModele.designation")
                            ->join("data_modele_reference", "data_modele_reference.id", "=", "listeModele.complement_reference")
                            ->join("data_modele_fabricant", "data_modele_fabricant.id", "=", "listeModele.fabricant")
                            ->where("listeModele.id", $id)->first();

    return $lmdetail;
});

Route::post("/activate_user", function(Request $r):String {
    return json_encode([
        "r" => User::find($r->input("id"))->update([
            "active" => 1
        ])
    ]);
});

Route::post("/get_user", function(Request $r):String {
    $from = $r->input("table");

    if ($from == "users") {
        return json_encode([
            "r" => User::find($r->input("id")),
            "action" => 1
        ]);
    } else if ($from == "listeactionusers") {
        $listeaction = ListeActionUser::find($r->input("id"));
        return json_encode([
            "r" => $listeaction,
            "origin" => User::find($listeaction->parentId),
            "action" => 2
        ]);
    }
});