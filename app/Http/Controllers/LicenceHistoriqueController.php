<?php

namespace App\Http\Controllers;

use App\Models\LicenceHistorique;
use App\Models\roles;
use App\Models\User;
use Illuminate\Http\Request;
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
        $name = $_FILES["myFile"]["name"];
        $endExt = pathinfo($name, PATHINFO_EXTENSION);
        if (strtolower($endExt) === "csv") {
            $tmp_name = $_FILES["myFile"]["tmp_name"];
            $size = $_FILES["myFile"]["size"];
            $error = $_FILES["myFile"]["error"];
            $maximal = 10000000;
            if ($size <= $maximal) {
                if ($error == 0) {
                    // $nouveauNom = uniqid("file-", true);
                    // $file = $nouveauNom . "." . $endExt;
                    // $location = base_path() . "/storage/app/public/imgCantine/" . $file;
                    // move_uploaded_file($tmp_name, $location);
                    $nouveauNom = base_path() . "/storage/app/public/imgCantine/" . "file-657c74328ab7b3.69308837.csv";
                    $data = [];
                    $fp = fopen($nouveauNom, 'r');
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
    
                                    }
                                }
                                dd($data[$i], $isRole);
                            }
                        }
                    } else {
                        return json_encode(["error" => "Le nombre de colonnes attendues n'est pas atteint !!!"]);
                    }

                    dd($data);
                } else {
                    return json_encode(["error" => "Le fichier ne peut être prise en charge !!!"]);
                }
            } else {
                return json_encode(["error" => "La taille de cette image dépasse la taille maximale que nous validons (10Mo) !!!"]);
            }
        } else {
            return response()->json(["error" => "L'extension attendue est : csv."]);
        }
        dd($name, $endExt);
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
}
