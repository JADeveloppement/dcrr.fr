<?php

use Illuminate\Support\Facades\Route;

use Carbon\Carbon;

use App\Models\User;

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
    return view("signin");
});

Route::get("/profil", function():\Illuminate\View\View {
    return view("profil_client");
});

Route::get("/profil_entreprise", function():\Illuminate\View\View {
    return view("profil_entreprise");
});

Route::get("/test_commande", function(Request $r){
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
        $user->save()
    ]);
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