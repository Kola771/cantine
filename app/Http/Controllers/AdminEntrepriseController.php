<?php

namespace App\Http\Controllers;

use App\Models\AdminEntreprise;
use App\Models\LicenceHistorique;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Mail\MonMessage;
use Illuminate\Support\Facades\Mail;

class AdminEntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Super/AdminEnterprise/Create');
    }

    // fonction pour recharger les données de la page
    public function indexAdmin()
    {
        // Je veux récupérer tous les adminEntreprise
        $allAdmins = AdminEntreprise::all()->toArray();
        return response()->json([
            "admins" => $allAdmins
        ]);
    }

    // fonction pour créer un administrateur entreprise
    public function createAdminEnt(Request $request)
    {
        // Je vérifie si le nom d'entreprise entré par l'utilisateur existe déjà dans la base de données
        $getEntreprise = AdminEntreprise::where("entreprise_name", $request->enterprise)->first();
        if ($getEntreprise !== null) {
            return response()->json(["error" => "Cette entreprise existe déjà dans notre base de données !!!"]);
        } else {
            try {
                // création de la licence d'historique
                LicenceHistorique::create([
                    "enterprise_name" => trim($request->enterprise),
                    "etat" => "achetee",
                    "licence_year_start" => $request->start,
                    "licence_year_end" => $request->end
                ]);

                // création de l'administrateur d'entreprise
                AdminEntreprise::create([
                    "entreprise_name" => trim($request->enterprise),
                    "admin_lastname" => trim($request->nom),
                    "admin_firstname" => trim($request->prenom),
                    "licence_year_start" => $request->start,
                    "licence_year_end" => $request->end
                ]);
                return response()->json(["success" => "Administrateur créé avec succès !!!"]);
            } catch (\Exception $e) {
                return response()->json(["error" => "Une erreur est subvenue lors de l'opération !!!"]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Fonction pour créer des comptes utilisateurs pour les administrateurs entreprises
    public function createAdminUser(Request $request)
    {
        $form = $request->form;
        // vérifions si l'email de l'utilisateur se trouve déjà dans la table users
        $getEmail = User::where("email", $form["email"])->first();
        if ($getEmail !== null) {
            return response()->json(["error" => "Un utilisateur utilise déjà cet email."]);
        } else {
            // Création d'un mot de passe
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Longueur du caractère
            $longueurCaracteres = strlen($caracteres);

            // Initialiser le mot de passe
            $motDePasse = '';

            // Générer le mot de passe
            for ($i = 0; $i < 12; $i++) {
                $motDePasse .= $caracteres[rand(0, $longueurCaracteres - 1)];
            }
            // Mot de passe par défaut actuellement
            $motDePasse = "azerty123";
            // Création du compte
            try {
                User::create([
                    'lastname' => $form["lastname"],
                    'firstname' => $form["firstname"],
                    'email' => $form["email"],
                    'matricule' => $form["matricule"],
                    'password' => Hash::make($motDePasse),
                    'idRole' => 2,
                    'idAdmin' => $form["idAdmin"],
                ]);
                return response()->json(["success" => "Compte utilisateur créé avec succès."]);
            } catch (\Throwable $th) {
                return response()->json(["error" => "Une erreur est subvenue lors de l'enrégistrement !"]);
            }
        }
        // $destinataire = 'azankpoeric40@gmail.com';

        // Mail::to($destinataire)->send(new MonMessage());

        // return 'E-mail envoyé avec succès';
    }

    // Fonction pour rechercher toutes les occurrences d'un élement dans la colonne entreprise_name
    public function searchInputAdminEnt(Request $request) {
        $getEntreprise = AdminEntreprise::where("entreprise_name", "LIKE", "%{$request->search}%")->get()->toArray();
        return response()->json($getEntreprise);
    }

    /**
     * Display the specified resource.
     */
    public function show($id, AdminEntreprise $adminEntreprise)
    {
        // Vérifions si nous trouvons une occurence
        $getEntreprise = AdminEntreprise::where("id", $id)->first();
        if ($getEntreprise !== null) {
            return Inertia::render('Super/AdminEnterprise/CreateAdmin', [
                "donnees" => $getEntreprise
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, AdminEntreprise $adminEntreprise)
    {
        $getone = $adminEntreprise::where("id", $request->id)->first();
        if ($getone !== null) {
            return response()->json($getone);
        } else {
            return response()->json(["error" => "L'administrateur Entreprise n'existe pas !!!"]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminEntreprise $adminEntreprise)
    {
        $bool = false;
        // Je vérifie si le nom d'entreprise entré par l'utilisateur existe déjà dans la base de données
        $getEntreprise = AdminEntreprise::where("entreprise_name", $request->enterprise)->first();
        if ($getEntreprise !== null) {
            if ($getEntreprise->id === intval($request->tableau["id"])) {
                $bool = true;
            } else {
                return response()->json(["error" => "Ce nom d'entreprise existe déjà !!!"]);
            }
        } else {
            $bool = true;
        }

        if ($bool) {
            $allHistorique = LicenceHistorique::where("enterprise_name", $request->tableau["entreprise_name"])->get()->toArray();
            if (count($allHistorique) > 0) {
                foreach ($allHistorique as $key => $value) {
                    // Modification du nom de l'entreprise dans la table LicenceHistorique
                    try {
                        LicenceHistorique::where("id", intval($value["id"]))->update([
                            "enterprise_name" => trim($request->enterprise)
                        ]);
                    } catch (\Exception $e) {
                        return response()->json(["error" => "Une erreur est subvenue lors de l'opération !!!"]);
                    }
                }
            }

            try {
                LicenceHistorique::create([
                    "enterprise_name" => trim($request->enterprise),
                    "etat" => "modifiee",
                    "licence_year_start" => $request->start,
                    "licence_year_end" => $request->end
                ]);

                // modification de l'administrateur d'entreprise
                AdminEntreprise::where("id", intval($request->tableau["id"]))->update([
                    "entreprise_name" => trim($request->enterprise),
                    "admin_lastname" => trim($request->nom),
                    "admin_firstname" => trim($request->prenom),
                    "licence_year_start" => $request->start,
                    "licence_year_end" => $request->end
                ]);

                return response()->json(["success" => "Données de l'administrateur modifiées avec succès !!!"]);
            } catch (\Exception $e) {
                return response()->json(["error" => "Une erreur est subvenue lors de l'opération !!!"]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, AdminEntreprise $adminEntreprise)
    {
        // Vérifions si nous trouvons une occurence
        $getEntreprise = AdminEntreprise::where("id", $request->id)->first();
        if ($getEntreprise !== null) {
            try {
                $getEntreprise->delete();
                return response()->json(["success" => "Administrateur supprimé avec succès !!!"]);
            } catch (\Exception $e) {
                return response()->json(["error" => "Une erreur est subvenue lors de la suppression !!!"]);
            }
        } else {
            return response()->json(["error" => "L'Administrateur que vous tentez de supprimer n'existe plus en base de données !!!"]);
        }

    }
}
