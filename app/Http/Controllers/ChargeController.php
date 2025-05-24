<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Charge;
use App\Models\Loyer;

class ChargeController extends Controller
{
    /**
     * Afficher la liste des charges
     */
    public function index()
    {
        $charges = Charge::with('loyer')->paginate(10);
        return view('admin.charges.index', compact('charges'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $loyers = Loyer::all();
        return view('admin.charges.create', compact('loyers'));
    }

    /**
     * Enregistrer une nouvelle charge
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loyer_id' => 'required|exists:loyers,id',
            'type_charge' => 'required|string|max:100',
            'montant' => 'required|numeric|min:0',
            'periode_debut' => 'required|date',
            'periode_fin' => 'required|date|after:periode_debut',
            'description' => 'nullable|string'
        ]);

        Charge::create($validated);

        return redirect()->route('charges.index')
            ->with('success', 'Charge créée avec succès.');
    }

    /**
     * Afficher les détails d'une charge
     */
    public function show(Charge $charge)
    {
        $charge->load('loyer');
        return view('admin.charges.show', compact('charge'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Charge $charge)
    {
        $loyers = Loyer::all();
        return view('admin.charges.edit', compact('charge', 'loyers'));
    }

    /**
     * Mettre à jour une charge
     */
    public function update(Request $request, Charge $charge)
    {
        $validated = $request->validate([
            'loyer_id' => 'required|exists:loyers,id',
            'type_charge' => 'required|string|max:100',
            'montant' => 'required|numeric|min:0',
            'periode_debut' => 'required|date',
            'periode_fin' => 'required|date|after:periode_debut',
            'description' => 'nullable|string'
        ]);

        $charge->update($validated);

        return redirect()->route('charges.index')
            ->with('success', 'Charge mise à jour avec succès.');
    }

    /**
     * Supprimer une charge
     */
    public function destroy(Charge $charge)
    {
        $charge->delete();

        return redirect()->route('charges.index')
            ->with('success', 'Charge supprimée avec succès.');
    }
}
