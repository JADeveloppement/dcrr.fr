<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Fluides;
use App\Models\Marques;
use App\Models\ListeSites;
use App\Models\DataModele;
use App\Models\DataRole;

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
    $marque = 6;
    $fluide_frigorigène = 14;
    return [
        Marques::where("id", $marque)->first()->marque,
        Fluides::where("id", $fluide_frigorigène)->first()->nom_fluide,
    ];
});

Route::get('/', function ():\Illuminate\View\View {
    return view('welcome');
});

Route::get("/signin", function():\Illuminate\View\View {
    Cookie::queue("dcrr_login", "", -1);
    return view("signin");
});

Route::get("/profil", function():\Illuminate\View\View {
    if (Cookie::has("dcrr_login")){
        $c = Cookie::get("dcrr_login");
        $user = User::where("email", $c)->first();
        if ($user){
            if ($user->data_role->id == intval(DataRole::where('value', "Administrateur")->first()->id) || $user->data_role->id == intval(DataRole::where('value', "Employé")->first()->id)) return view("profil_entreprise");
            else if ($user->data_role->id == intval(DataRole::where('value', "Client")->first()->id)) return view("profil_client");
        } else return redirect("/signin");
    } else return view("signin");
});

Route::get("/profil_entreprise", function():\Illuminate\View\View {
    return view("profil_entreprise");
});


Route::post("/do_signin", function(Request $r) : String{
    $nomprenom = request()->nomprenom;
    $email = request()->email;
    $password = request()->password;
    $telephone = request()->telephone;
    $entreprise = request()->entreprise;
    $poste = request()->poste;
    $newsletter = request()->newsletter;

    $user = new User;

    if (User::where("email", $email)->exists()){
        return json_encode(
            ["r" => -1]
        );
    }

    $user->nomprenom = $nomprenom;
    $user->email = $email;
    $user->password = $password;
    $user->telephone = $telephone;
    $user->entreprise = $entreprise;
    $user->poste = $poste;
    $user->newsletter = intval($newsletter);
    $user->role = intval(DataRole::where("value", "Client")->first()->id);
    $user->active = 0;
    $user->createdAt = Carbon::createFromTimestamp(time())->toDateTimeString();

    return json_encode([
        "r" => $user->save()
    ]);
});

Route::post("/do_login", function(Request $r): String{
    $login = request()->login;
    $password = request()->password;

    $user = User::where("email", $login);

    $res = 0;
    if ($user->exists()){
        $user_infos = $user->first();
        if ($user_infos->active == 1){
            if ($user_infos->password == $password){
                $res = $user_infos->nomprenom;
                Cookie::queue("dcrr_login", $user_infos->email, 600000);
                if ($user_infos->data_role->value == intval(DataRole::where("value", "Administrateur")->first()->id) || $user_infos->data_role->value == intval(DataRole::where("value", "Employé")->first()->id))
                    $res = "/profil_entreprise";
                else $res = "/profil_client";
            }
            else $res = -1; // bad password
        } else $res = -2; // not active
    } else $res = -3; // bad credentials

    return json_encode([
        "r" => $res
    ]);
});

Route::post("/add_site", function(Request $r):Array {
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
});