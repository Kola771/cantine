<?php

namespace App\Http\Controllers\Auth;

use App\Models\AdminEntreprise;
use App\Models\roles;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     * @return \Illuminate\Http\Response
     */
    // public function store(LoginRequest $request): RedirectResponse
    public function store(LoginRequest $request)
    {
        // Je vérifie si l'email entré existe dans la base de données
        $verification = User::where("email", $request->email)->first();
        // Si la vérification donne null alors l'email entré n'existe pas
        if($verification === null)
        {
            return response()->json(["error" => "L'email entré n'existe pas en base de données !!!"]);
        } else {
            // Je vérifie si le mot de passe entré correspond au mot de passe de l'utilisateur ayant le mail
            if(Hash::check($request->password, $verification->password) == true)
            {
                // Vérifions si l'utilisateur qui veut se connecter à véritablement droit à une connexion
                $resultat = $this->sessionLicence($verification->idAdmin);
                if(isset($resultat["message"]))
                {
                    $isRole = roles::where("id", $verification->idRole)->first();
                    if($isRole !== null)
                    {
                        Auth::login($verification);
                        $request->session()->regenerate();
                        switch(strtolower($isRole->role_name))
                        {
                            case "superadministrateur":
                                return response()->json(["success" => "/dashboard"]);
                            case "administrateur":
                                return response()->json(["success" => "/accueilUser"]);
                            case "comptabilite":
                                break;
                            case "utilisateur":
                                return response()->json(["success" => "/accueilUser"]);
                        }
                    }
                } else {
                    return response()->json(["error" => $resultat["error"]]);
                }
            } else {
                return response()->json(["error" => "Le mot de passe n'est pas correct !!!"]);
            }
        }
    }

    // Cette fonction vérifie si une licence est toujour valide
    public function sessionLicence($idAdmin)
    {
        // Récupération des données de l'administrateur relié à une licence d'une entreprise
        $getAdminEntreprise = AdminEntreprise::where("id", $idAdmin)->first();
        if($getAdminEntreprise === null)
        {
            return (["error" => "Impossible de vous connecter !!!"]); 
        } else {
            $dateStartLicence = $getAdminEntreprise->licence_year_start;
            $dateEndLicence = $getAdminEntreprise->licence_year_end;
            // Date actuelle
            $dateNow = date("Y-m-d");
            if($dateStartLicence === null && $dateEndLicence === null)
            {
                return (["message" => "Vous pouvez vous connecter en tant que Super Administrateur !!!"]); 
            } else {
                if($dateStartLicence <= $dateNow && $dateNow <= $dateEndLicence) {
                    return (["message" => "Vous pouvez vous connecter !!!"]); 
                } else {
                    return (["error" => "Votre licence a expiré !!!"]); 
                }
            }
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
