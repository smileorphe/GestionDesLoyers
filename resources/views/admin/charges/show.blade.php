@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black text-white flex items-center justify-center p-4">
    <div class="w-full max-w-4xl bg-gray-900 shadow-2xl rounded-2xl overflow-hidden">
        <div class="p-8 md:p-12">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl md:text-4xl font-bold">Détails de la Charge</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="font-semibold">Type de Charge:</p>
                <p class="text-gray-300">{{ $charge->type_charge }}</p>
            </div>
            
            <div>
                <p class="font-semibold">Montant:</p>
                <p class="text-gray-300">{{ number_format($charge->montant, 2) }} Franc CFA</p>
            </div>
            
            <div>
                <p class="font-semibold">Date:</p>
                <p class="text-gray-300">
                    @if($charge->date)
                        {{ $charge->date instanceof \Carbon\Carbon ? $charge->date->format('d/m/Y') : $charge->date }}
                    @else
                        Date non disponible
                    @endif
                </p>
            </div>
            
            <div>
                <p class="font-semibold">Loyer Associé:</p>
                <p class="text-gray-300">
                    @if($charge->loyer)
                        {{ $charge->loyer->nom_locataire }} - {{ $charge->loyer->adresse_bien }}
                    @else
                        Aucun loyer associé
                    @endif
                </p>
            </div>
        </div>
        
        </div>
            <div class="flex space-x-4 mt-8">
                <a href="{{ route('admin.charges.edit', $charge->id) }}" class="button">
                    <span class="button__text">Modifier</span>
                    <span class="button__icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" stroke-width="2" stroke-linejoin="round" stroke-linecap="round" stroke="currentColor" height="24" fill="none" class="svg">
                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                        </svg>
                    </span>
                </a>
                
                <form action="{{ route('admin.charges.destroy', $charge->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="noselect" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette charge ?')">
                        <span class="text">Supprimer</span>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                            </svg>
                        </span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
    </div>
</div>

<style>
    .button {
        position: relative;
        width: 150px;
        height: 40px;
        cursor: pointer;
        display: flex;
        align-items: center;
        background: rgb(59, 130, 246);
        border: none;
        border-radius: 5px;
        box-shadow: 1px 1px 3px rgba(0,0,0,0.15);
    }

    .button, .button__icon, .button__text {
        transition: 200ms;
    }

    .button .button__text {
        transform: translateX(35px);
        color: white;
        font-weight: bold;
    }

    .button .button__icon {
        position: absolute;
        border-left: 1px solid rgb(37, 99, 235);
        transform: translateX(110px);
        height: 40px;
        width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .button svg {
        width: 15px;
        fill: #eee;
    }

    .button:hover {
        background: rgb(37, 99, 235);
    }

    .button:hover .button__text {
        color: transparent;
    }

    .button:hover .button__icon {
        width: 150px;
        border-left: none;
        transform: translateX(0);
    }

    .button:focus {
        outline: none;
    }

    .button:active .button__icon svg {
        transform: scale(0.8);
    }

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
@endsection
