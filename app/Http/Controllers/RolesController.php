<?php

namespace App\Http\Controllers;

use App\Models\roles;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RolesController extends Controller
{
    /**
     * Function pour charger la page des utililsateurs
     */
    public function accueilUser()
    {
        return Inertia::render('Users/Accueil/PageAccueil');
    }

    /**
     * Function pour charger la page du dashboard administrateur
     */
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    /**
     * Function pour charger la page login
     */
    public function logIn()
    {
        return Inertia::render('Auth/Login');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(roles $roles)
    {
        //
    }
}
