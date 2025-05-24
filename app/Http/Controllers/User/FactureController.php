<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture; // Assurez-vous que ce modèle existe

class FactureController extends Controller
{
    public function index()
    {
        $factures = Facture::latest()->paginate(10);
        return view('user.factures', compact('factures'));
    }

    public function create()
    {
        return view('user.factures.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero' => 'required|string|max:50|unique:factures',
            'montant' => 'required|numeric|min:0',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date|after_or_equal:date_emission',
            'statut' => 'required|in:payée,en_attente,en_retard',
            'type' => 'required|in:loyer,charges,reparations,autres',
            'description' => 'nullable|string',
        ]);

        $facture = Facture::create($validated);
        
        return redirect()->route('user.factures.index')
                         ->with('success', 'Facture créée avec succès');
    }

    public function edit(Facture $facture)
    {
        return view('user.factures.edit', compact('facture'));
    }

    public function update(Request $request, Facture $facture)
    {
        $validated = $request->validate([
            'numero' => 'required|string|max:50|unique:factures,numero,' . $facture->id,
            'montant' => 'required|numeric|min:0',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date|after_or_equal:date_emission',
            'statut' => 'required|in:payée,en_attente,en_retard',
            'type' => 'required|in:loyer,charges,reparations,autres',
            'description' => 'nullable|string',
        ]);

        $facture->update($validated);
        
        return redirect()->route('user.factures.index')
                         ->with('success', 'Facture mise à jour avec succès');
    }

    public function show(Facture $facture)
    {
        return view('user.factures.show', compact('facture'));
    }

    public function download(Facture $facture)
    {
        // Logique de téléchargement de la facture
        // À implémenter selon votre logique de stockage
    }
}
