<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facture;
use App\Models\Loyer;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FactureController extends Controller
{
    /**
     * Affiche le formulaire de création d'une nouvelle facture
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $locataires = User::where('role', 'user')->orderBy('name')->get();
        $loyers = Loyer::with('bien')->get();
        
        return view('admin.factures.create', compact('locataires', 'loyers'));
    }
    
    /**
     * Enregistre une nouvelle facture dans la base de données
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loyer_id' => 'required|exists:loyers,id',
            'user_id' => 'required|exists:users,id',
            'numero' => 'required|string|max:50|unique:factures,numero',
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date|after_or_equal:date_emission',
            'periode_debut' => 'required|date',
            'periode_fin' => 'required|date|after:periode_debut',
            'montant_ht' => 'required|numeric|min:0',
            'tva' => 'required|numeric|min:0',
            'montant_ttc' => 'required|numeric|min:0',
            'statut' => 'required|in:brouillon,envoyee,payee,en_retard,annulee',
            'notes' => 'nullable|string',
        ]);
        
        try {
            DB::beginTransaction();
            
            $facture = Facture::create($validated);
            
            DB::commit();
            
            return redirect()->route('admin.factures.show', $facture)
                ->with('success', 'La facture a été créée avec succès.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de la création de la facture : ' . $e->getMessage());
            return back()->withInput()->with('error', 'Une erreur est survenue lors de la création de la facture.');
        }
    }
    
    /**
     * Affiche les détails d'une facture
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\View\View
     */
    public function show(Facture $facture)
    {
        $facture->load(['user', 'loyer.bien']);
        return view('admin.factures.show', compact('facture'));
    }
    
    /**
     * Affiche le formulaire de modification d'une facture
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\View\View
     */
    public function edit(Facture $facture)
    {
        $locataires = User::where('role', 'locataire')->get();
        $loyers = Loyer::with('bien')->get();
        
        return view('admin.factures.edit', compact('facture', 'locataires', 'loyers'));
    }
    
    /**
     * Met à jour une facture dans la base de données
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Facture $facture)
    {
        $validated = $request->validate([
            'loyer_id' => 'required|exists:loyers,id',
            'user_id' => 'required|exists:users,id',
            'numero' => 'required|string|max:50|unique:factures,numero,' . $facture->id,
            'date_emission' => 'required|date',
            'date_echeance' => 'required|date|after_or_equal:date_emission',
            'periode_debut' => 'required|date',
            'periode_fin' => 'required|date|after:periode_debut',
            'montant_ht' => 'required|numeric|min:0',
            'tva' => 'required|numeric|min:0',
            'montant_ttc' => 'required|numeric|min:0',
            'statut' => 'required|in:brouillon,envoyee,payee,en_retard,annulee',
            'notes' => 'nullable|string',
        ]);
        
        try {
            DB::beginTransaction();
            
            $facture->update($validated);
            
            DB::commit();
            
            return redirect()->route('admin.factures.show', $facture)
                ->with('success', 'La facture a été mise à jour avec succès.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de la mise à jour de la facture : ' . $e->getMessage());
            return back()->withInput()->with('error', 'Une erreur est survenue lors de la mise à jour de la facture.');
        }
    }
    
    /**
     * Supprime une facture de la base de données
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Facture $facture)
    {
        try {
            DB::beginTransaction();
            
            // Supprimer les messages liés à cette facture
            Message::where('facture_id', $facture->id)->delete();
            
            // Supprimer la facture
            $facture->delete();
            
            DB::commit();
            
            return redirect()->route('admin.factures.index')
                ->with('success', 'La facture a été supprimée avec succès.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Erreur lors de la suppression de la facture : ' . $e->getMessage());
            return back()->with('error', 'Une erreur est survenue lors de la suppression de la facture.');
        }
    }
    
    /**
     * Affiche la liste des factures avec recherche et filtrage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Initialiser la requête avec les relations
        $query = Facture::with(['user', 'loyer']);
        
        // Recherche par numéro de facture, nom du locataire ou email
        if ($search = $request->input('search')) {
            $query->where(function($q) use ($search) {
                $q->where('numero', 'like', "%{$search}%")
                  ->orWhereHas('user', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }
        
        // Filtre par statut
        if ($statut = $request->input('statut')) {
            $query->where('statut', $statut);
        }
        
        // Trier par défaut par date de création décroissante
        $factures = $query->latest()->paginate(10)->withQueryString();
        
        // Récupérer les valeurs des filtres pour les réafficher dans le formulaire
        $filters = $request->only(['search', 'statut']);
            
        return view('admin.factures.index', compact('factures', 'filters'));
    }
    
    /**
     * Envoie une facture comme message à l'utilisateur
     *
     * @param  \App\Models\Facture  $facture
     * @return \Illuminate\Http\RedirectResponse
     */
    public function send(Facture $facture)
    {
        try {
            // Vérifier si l'utilisateur existe
            if (!$facture->user) {
                return redirect()->back()->with('error', 'Utilisateur non trouvé pour cette facture.');
            }
            
            // Créer le message
            Message::create([
                'from_user_id' => Auth::id(),
                'to_user_id' => $facture->user_id,
                'facture_id' => $facture->id,
                'message' => 'Nouvelle facture disponible pour le loyer de ' . 
                             $facture->loyer->adresse . 
                             ' - Période: ' . $facture->periode_debut->format('d/m/Y') . ' au ' . 
                             $facture->periode_fin->format('d/m/Y') . 
                             ' - Montant: ' . number_format($facture->montant_ttc, 2, ',', ' ') . ' FCFA',
                'is_read' => false
            ]);
            
            // Mettre à jour la date d'envoi de la facture
            $facture->update([
                'date_envoi' => now(),
                'statut' => 'envoyee'
            ]);
            
            return redirect()->back()->with('success', 'La facture a été envoyée avec succès à l\'utilisateur.');
            
        } catch (\Exception $e) {
            \Log::error('Erreur lors de l\'envoi de la facture : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de la facture.');
        }
    }
}
