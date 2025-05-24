<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loyer;
use App\Models\User;

class LoyerController extends Controller
{
    /**
     * Afficher la liste des loyers
     */
    public function index()
    {
        $loyers = Loyer::with('user')->paginate(10);
        return view('admin.loyers.index', compact('loyers'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $users = User::all();
        return view('admin.loyers.create', compact('users'));
    }

    /**
     * Enregistrer un nouveau loyer
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'user_id' => 'required|exists:users,id',
        'nom_locataire' => 'required|string|max:255',
        'adresse_bien' => 'required|string|max:255',
        'montant_loyer' => 'required|numeric|min:0',
        'date_debut' => 'required|date',
        'date_fin' => 'nullable|date|after:date_debut',
        'statut' => 'required|in:actif,termine,en_attente',
        'notes' => 'nullable|string'
    ]);

    try {
        $loyer = Loyer::create($validatedData);

        return redirect()->route('loyers.index')
            ->with('success', 'Loyer créé avec succès.');
    } catch (\Exception $e) {
        return back()->withErrors(['error' => 'Erreur lors de la création du loyer.'])
            ->withInput();
    }
}

    /**
     * Afficher les détails d'un loyer
     */
    public function show(Loyer $loyer)
    {
        $loyer->load(['charges', 'transactions']);
        return view('admin.loyers.show', compact('loyer'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Loyer $loyer)
    {
        $users = User::all();
        return view('admin.loyers.edit', compact('loyer', 'users'));
    }

    /**
     * Mettre à jour un loyer
     */
    public function update(Request $request, Loyer $loyer)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'nom_locataire' => 'required|string|max:255',
            'adresse_bien' => 'required|string|max:255',
            'montant_loyer' => 'required|numeric|min:0',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after:date_debut',
            'statut' => 'required|in:actif,termine,en_attente',
            'notes' => 'nullable|string'
        ]);

        $loyer->update($validated);

        return redirect()->route('loyers.index')
            ->with('success', 'Loyer mis à jour avec succès.');
    }

    /**
     * Supprimer un loyer
     */
    public function destroy(Loyer $loyer)
    {
        $loyer->delete();

        return redirect()->route('loyers.index')
            ->with('success', 'Loyer supprimé avec succès.');
    }
}
