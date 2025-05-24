@extends('layouts.app')

@section('title', 'Détails de la facture - Administration')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-5xl mx-auto">
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <!-- En-tête avec boutons d'action -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Facture #FACT-2023-001</h2>
                        <div class="mt-1 flex items-center">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Payée
                            </span>
                            <span class="ml-2 text-sm text-gray-500">Émise le 01/01/2023</span>
                        </div>
                    </div>
                    <div class="flex space-x-3">
                        <a href="#" class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Télécharger
                        </a>
                        <a href="#" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="-ml-0.5 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Modifier
                        </a>
                    </div>
                </div>
            </div>

            <div class="px-6 py-5 border-b border-gray-200">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Informations du locataire -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Facturé à</h3>
                        <div class="mt-2">
                            <p class="text-base font-medium text-gray-900">Jean Dupont</p>
                            <p class="text-sm text-gray-500">12 Rue des Lilas</p>
                            <p class="text-sm text-gray-500">75001 Paris, France</p>
                            <p class="mt-2 text-sm text-gray-500">jean.dupont@example.com</p>
                            <p class="text-sm text-gray-500">+33 6 12 34 56 78</p>
                        </div>
                    </div>

                    <!-- Détails de la facture -->
                    <div class="md:text-right">
                            <h3 class="text-sm font-medium text-gray-500">Détails de la facture</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-900"><span class="font-medium">Numéro :</span> #FACT-2023-001</p>
                                <p class="text-sm text-gray-900"><span class="font-medium">Date d'émission :</span> 01/01/2023</p>
                                <p class="text-sm text-gray-900"><span class="font-medium">Date d'échéance :</span> 31/01/2023</p>
                                <p class="text-sm text-gray-900"><span class="font-medium">Type :</span> Loyer</p>
                                <p class="mt-2 text-sm font-medium text-gray-900">
                                    <span class="font-medium">Montant total :</span> 750,00 €
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Détails des articles -->
                <div class="px-6 py-5">
                    <h3 class="text-sm font-medium text-gray-900">Détails</h3>
                    <div class="mt-4 overflow-hidden border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Montant HT
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        TVA
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Montant TTC
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Loyer du mois de janvier 2023
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                        625,00 €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                        20%
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 font-medium text-right">
                                        750,00 €
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot class="bg-gray-50">
                                <tr>
                                    <th scope="row" colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-700">
                                        Sous-total HT
                                    </th>
                                    <td class="px-6 py-3 text-right text-sm font-medium text-gray-900">
                                        625,00 €
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-700">
                                        TVA (20%)
                                    </th>
                                    <td class="px-6 py-3 text-right text-sm font-medium text-gray-900">
                                        125,00 €
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row" colspan="3" class="px-6 py-3 text-right text-sm font-medium text-gray-700 border-t border-gray-200">
                                        Total TTC
                                    </th>
                                    <td class="px-6 py-3 text-right text-sm font-bold text-gray-900 border-t border-gray-200">
                                        750,00 €
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <!-- Paiements -->
                <div class="px-6 py-5 border-t border-gray-200">
                    <h3 class="text-sm font-medium text-gray-900 mb-4">Paiements</h3>
                    <div class="overflow-hidden border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Montant
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Méthode
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Référence
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Statut
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        05/01/2023
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        750,00 €
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        Virement bancaire
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        VIR-2023-001
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Réglé
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notes et conditions -->
                <div class="px-6 py-5 border-t border-gray-200 bg-gray-50">
                    <h3 class="text-sm font-medium text-gray-900 mb-2">Notes</h3>
                    <p class="text-sm text-gray-600">
                        Paiement du loyer pour le mois de janvier 2023. Merci pour votre régularité.
                    </p>
                    <div class="mt-4">
                        <h3 class="text-sm font-medium text-gray-900 mb-2">Conditions et mentions</h3>
                        <p class="text-xs text-gray-500">
                            Paiement à effectuer avant la date d'échéance. Tout retard de paiement pourra entraîner des pénalités conformément à la loi en vigueur.
                        </p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('admin.factures.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Retour à la liste
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Télécharger le PDF
                    </a>
                    <a href="#" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18v7a2 2 0 01-2 2H5a2 2 0 01-2-2v-7z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10l-9-7-9 7" />
                        </svg>
                        Envoyer par email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
