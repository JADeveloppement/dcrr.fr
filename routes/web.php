<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

use App\Models\User;
use App\Models\Fluides;
use App\Models\Marques;
use App\Models\ListeSites;

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
            if ($user->role == 2 || $user->role == 1) return view("profil_entreprise");
            else if ($user->role == 0) return view("profil_client");
        } else return redirect("/signin");
    } else return view("signin");
});

Route::get("/profil_entreprise", function():\Illuminate\View\View {
    return view("profil_entreprise");
});

Route::get("/test_commande", function(Request $r){
    $site = ListeSites::with(["fluide", "marque"])->get();

    foreach ($site as $s) {
        $siteM = optional($s->marque)->marque;
        $siteF = optional($s->fluide)->nom_fluide;

        echo "<p>
            <b>Fluide : </b> $siteF
            <b>Marque : </b> $siteM
        </p>";
    }

    // $siteFluide = $site->fluide;
    // $siteMarque = $site->marque;

    // return "<p>Marque : ".$siteMarque."</p>";
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
    $user->role = 0;
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
                if ($user_infos->role == 1 || $user_infos->role == 2)
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