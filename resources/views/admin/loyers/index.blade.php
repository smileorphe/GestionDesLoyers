@extends('layouts.app')

@section('content')
<div class="w-full h-full p-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-300">Liste des Loyers</h1>
        <a href="{{ route('admin.loyers.create') }}" class="button">
            <span class="button__text" style="font-size: 13px;margin-left: -25px;">Ajouter un Loyer</span>
            <span class="button__icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
                    <line y2="19" y1="5" x2="12" x1="12"></line>
                    <line y2="12" y1="12" x2="19" x1="5"></line>
                </svg>
            </span>
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-black text-white shadow-md rounded-lg overflow-hidden w-full h-[calc(100vh-200px)]">
        <div class="overflow-y-auto h-full">
            <table class="w-full table-auto">
                <thead class="sticky top-0 bg-gray-800 z-10">
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Locataire
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Adresse
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Montant
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-700 text-left text-xs font-semibold text-gray-300 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
            <tbody>
                @forelse($loyers as $loyer)
                    <tr class="hover:bg-gray-800">
                        <td class="px-5 py-5 border-b border-gray-700 bg-black text-sm">
                            <p class="text-white whitespace-no-wrap">
                                {{ $loyer->nom_locataire }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-700 bg-black text-sm">
                            <p class="text-white whitespace-no-wrap">
                                {{ $loyer->adresse_bien }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-700 bg-black text-sm text-white">
                            {{ number_format($loyer->montant_loyer, 2) }} Franc CFA
                        </td>
                        <td class="px-5 py-5 border-b border-gray-700 bg-black text-sm">
                            <span class="
                                @if($loyer->statut == 'actif') text-green-400 
                                @elseif($loyer->statut == 'termine') text-red-400 
                                @else text-yellow-400 
                                @endif
                            ">
                                {{ ucfirst($loyer->statut) }}
                            </span>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-700 bg-black text-sm">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.loyers.show', $loyer->id) }}" class="text-blue-400 hover:text-blue-600">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.loyers.edit', $loyer->id) }}" class="text-yellow-400 hover:text-yellow-600">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.loyers.destroy', $loyer->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="noselect">
                                        <span class="text">Supprimer</span>
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                                <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                                            </svg>
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-5 border-b border-gray-700 bg-black text-sm text-center text-white">
                            Aucun loyer trouvé.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if($loyers->hasPages())
            <div class="px-5 py-5 bg-black border-t border-gray-700 flex flex-col xs:flex-row items-center xs:justify-between">
                {{ $loyers->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .noselect {
        width: 150px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        background: #e62222;
        border: none;
        border-radius: 5px;
        box-shadow: 1px 1px 3px rgba(0,0,0,0.15);
    }

    .noselect, .noselect span {
        transition: 200ms;
    }

    .noselect .text {
        transform: translateX(35px);
        color: white;
        font-weight: bold;
    }

    .noselect .icon {
        position: absolute;
        border-left: 1px solid #c41b1b;
        transform: translateX(110px);
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .noselect svg {
        width: 15px;
        fill: #eee;
    }

    .noselect:hover {
        background: #ff3636;
    }

    .noselect:hover .text {
        color: transparent;
    }

    .noselect:hover .icon {
        width: 150px;
        border-left: none;
        transform: translateX(0);
    }

    .noselect:focus {
        outline: none;
    }

    .noselect:active .icon svg {
        transform: scale(0.8);
    }
</style>

<style>
    .button {
        position: relative;
        width: 180px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        border: 1px solid #34974d;
        background-color: #3aa856;
        text-decoration: none;
        margin-left: auto;
    }

    .button, .button__icon, .button__text {
        transition: all 0.3s;
    }

    .button .button__text {
        transform: translateX(30px);
        color: #fff;
        font-weight: 600;
    }

    .button .button__icon {
        position: absolute;
        transform: translateX(109px);
        height: 100%;
        width: 39px;
        background-color: #34974d;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button .svg {
        width: 30px;
        stroke: #fff;
    }

    .button:hover {
        background: #34974d;
    }

    .button:hover .button__text {
        color: transparent;
    }

    .button:hover .button__icon {
        width: 148px;
        transform: translateX(0);
    }

    .button:active .button__icon {
        background-color: #2e8644;
    }

    .button:active {
        border: 1px solid #2e8644;
    }
</style>
@endsection
