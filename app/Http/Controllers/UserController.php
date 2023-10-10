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

class UserController extends Controller
{
    public function profil():\Illuminate\View\View 
    {
        if (Cookie::has("dcrr_login")){
            $c = Cookie::get("dcrr_login");
            $user = User::where("email", $c)->first();
            if ($user){
                if ($user->data_role->id == intval(DataRole::where('value', "Administrateur")->first()->id) || $user->data_role->id == intval(DataRole::where('value', "Employé")->first()->id)) return view("profil_entreprise");
                else if ($user->data_role->id == intval(DataRole::where('value', "Client")->first()->id)) return view("profil_client");
            } else return redirect("/signin");
        } else return view("signin");
    }
}
