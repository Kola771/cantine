<?php

namespace App\Http\Controllers;

use App\Models\LicenceHistorique;
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
