<?php

namespace App\Http\Controllers;

use App\Models\AdminEntreprise;
use App\Models\LicenceHistorique;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class LicenceHistoriqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    // fonction pour afficher tous les utilisateurs du site
    public function indexUser()
    {
        $all = User::all();
        $count = count($all) / 10;
        dd($count);
        $users = User::select("users.id", "users.lastname", "users.firstname", "users.email", "users.matricule", "roles.role_name", "admin_entreprises.entreprise_name", "roles.id as idRoleName")
            ->join("roles", "roles.id", "=", "users.idRole")
            ->join("admin_entreprises", "admin_entreprises.id", "=", "users.idAdmin")
            ->get()->toArray();
        $roles = roles::all()->toArray();
        $entreprise = AdminEntreprise::all()->toArray();


        return response()->json(["users" => $users, "roles" => $roles, "entreprise" => $entreprise]);
    }

    /**
     * Function pour charger la page de gestion des utilisateurs
     */
    public function gestionUserIndex()
    {
        return Inertia::render('Super/GestionUser/Index');
    }

    // Fonction pour créer un utilisateur via un fichier csv
    public function createUser()
    {
        $identifiantAdmin = null;
        if (isset($_POST["entreprise"]) && $_POST["entreprise"] !== null) {
            $identifiantAdmin = intval($_POST["entreprise"]);
        } else {
            $identifiantAdmin = Auth::user()->idAdmin;
        }
        $name = $_FILES["myFile"]["name"];
        $endExt = pathinfo($name, PATHINFO_EXTENSION);
        if (strtolower($endExt) === "csv") {
            $tmp_name = $_FILES["myFile"]["tmp_name"];
            $size = $_FILES["myFile"]["size"];
            $error = $_FILES["myFile"]["error"];
            $maximal = 10000000;
            if ($size <= $maximal) {
                if ($error == 0) {
                    $nouveauNom = uniqid("file-", true);
                    $file = $nouveauNom . "." . $endExt;
                    $location = base_path() . "/storage/app/public/imgCantine/" . $file;
                    move_uploaded_file($tmp_name, $location);
                    $data = [];
                    $fp = fopen($location, 'r');
                    while (($row = fgetcsv($fp)) !== false) {
                        $data[] = $row;
                    }
                    fclose($fp);

                    if (count($data[0]) === 5) {
                        for ($i = 0; $i < count($data); $i++) {
                            if ($i != 0) {
                                $verification = User::where("email", $data[$i][2])->first();
                                $isRole = roles::where("role_name", $data[$i][4])->first();
                                if ($verification === null) {
                                    if ($isRole !== null) {
                                        // Création d'un mot de passe
                                        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

                                        // Longueur du caractère
                                        $longueurCaracteres = strlen($caracteres);

                                        // Initialiser le mot de passe
                                        $motDePasse = '';

                                        // Générer le mot de passe
                                        for ($y = 0; $y < 12; $y++) {
                                            $motDePasse .= $caracteres[rand(0, $longueurCaracteres - 1)];
                                        }
                                        // Mot de passe par défaut actuellement
                                        $motDePasse = "azerty123";
                                        // Création du compte
                                        try {
                                            User::create([
                                                'lastname' => $data[$i][0],
                                                'firstname' => $data[$i][1],
                                                'email' => $data[$i][2],
                                                'matricule' => $data[$i][3],
                                                'password' => Hash::make($motDePasse),
                                                'idRole' => $isRole->id,
                                                'idAdmin' => $identifiantAdmin,
                                            ]);
                                        } catch (\Throwable $th) {
                                            return response()->json(["error" => "Une erreur est subvenue lors de l'enrégistrement !"]);
                                        }
                                    }
                                }
                            }
                        }
                        unlink($location);
                        return response()->json(["success" => "Les comptes utilisateurs ont été créé avec succès !"]);
                    } else {
                        return json_encode(["error" => "Le nombre de colonnes attendues n'est pas atteint !!!"]);
                    }
                } else {
                    return json_encode(["error" => "Le fichier ne peut être prise en charge !!!"]);
                }
            } else {
                return json_encode(["error" => "La taille de cette image dépasse la taille maximale que nous validons (10Mo) !!!"]);
            }
        } else {
            return response()->json(["error" => "L'extension attendue est : csv."]);
        }
    }

    // Fonction pour créer un compte utilisateur
    public function createUserNew(Request $request)
    {
        $identifiantAdmin = null;
        if (isset($request->entreprise)) {
            $identifiantAdmin = intval($request->entreprise);
        } else {
            $identifiantAdmin = Auth::user()->idAdmin;
        }
        $verification = User::where("email", $request->email)->first();
        if($verification !== null)
        {
            return response()->json(["error" => "Un utilisateur portant cet email existe déjà dans la base de données."]);
        } else {
            // Création d'un mot de passe
            $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Longueur du caractère
            $longueurCaracteres = strlen($caracteres);

            // Initialiser le mot de passe
            $motDePasse = '';

            // Générer le mot de passe
            for ($y = 0; $y < 12; $y++) {
                $motDePasse .= $caracteres[rand(0, $longueurCaracteres - 1)];
            }
            // Mot de passe par défaut actuellement
            $motDePasse = "azerty123";
            // Création du compte
            $matricule = null;
            if($request->matricule)
            {
                $matricule = $request->matricule;
            }
            try {
                User::create([
                    'lastname' => $request->nom,
                    'firstname' => $request->prenom,
                    'email' => $request->email,
                    'matricule' => $matricule,
                    'password' => Hash::make($motDePasse),
                    'idRole' => $request->role,
                    'idAdmin' => $identifiantAdmin,
                ]);
                return response()->json(["success" => "Le compte utilisateur a été créé avec succès !"]);
            } catch (\Throwable $th) {
                return response()->json(["error" => "Une erreur est subvenue lors de l'enrégistrement !"]);
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

    /**
     * Display the specified resource.
     */
    public function show(LicenceHistorique $licenceHistorique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LicenceHistorique $licenceHistorique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LicenceHistorique $licenceHistorique)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LicenceHistorique $licenceHistorique)
    {
        //
    }

    // Fonction pour supprimer un ou plusieurs utilisateurs
    public function deleteUser(Request $request, User $user)
    {
        foreach($request->tableau as $key => $value)
        {
            $requete = User::where("id", intval($value["id"]))->first();
            if($requete !== null)
            {
                try {
                    $requete->delete();
                } catch (\Throwable $th) {
                    dd($th);
                    return response()->json(["error" => "Une erreur est subvenue lors de la suppression !!!"]);
                }
            }
        }
        return response()->json(["success" => "Suppression réussie avec succès !!!"]);
    }
}
