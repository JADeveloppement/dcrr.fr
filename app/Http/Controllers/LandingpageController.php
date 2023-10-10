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

class LandingpageController extends Controller
{
    public function signin():\Illuminate\View\View
    {
        Cookie::queue("dcrr_login", "", -1);
        return view("signin");
    }

    public function do_login(Request $r):String
    {
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
    }

    public function do_signin(Request $r) :String
    {
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
    }
}
