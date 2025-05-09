<?php

namespace App\Http\Controllers;

use App\Loyer;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Afficher la liste des transactions
     */
    public function index()
    {
        $transactions = Transaction::with('loyer')->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Afficher le formulaire de création
     */
    public function create()
    {
        $loyers = Loyer::all();
        return view('transactions.create', compact('loyers'));
    }

    /**
     * Enregistrer une nouvelle transaction
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'loyer_id' => 'required|exists:loyers,id',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'type_paiement' => 'required|in:especes,cheque,virement,autre',
            'statut' => 'required|in:paye,en_retard,partiellement_paye',
            'commentaire' => 'nullable|string'
        ]);

        Transaction::create($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction créée avec succès.');
    }

    /**
     * Afficher les détails d'une transaction
     */
    public function show(Transaction $transaction)
    {
        $transaction->load('loyer');
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Afficher le formulaire d'édition
     */
    public function edit(Transaction $transaction)
    {
        $loyers = Loyer::all();
        return view('transactions.edit', compact('transaction', 'loyers'));
    }

    /**
     * Mettre à jour une transaction
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'loyer_id' => 'required|exists:loyers,id',
            'montant' => 'required|numeric|min:0',
            'date_paiement' => 'required|date',
            'type_paiement' => 'required|in:especes,cheque,virement,autre',
            'statut' => 'required|in:paye,en_retard,partiellement_paye',
            'commentaire' => 'nullable|string'
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction mise à jour avec succès.');
    }

    /**
     * Supprimer une transaction
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transactions.index')
            ->with('success', 'Transaction supprimée avec succès.');
    }
}
