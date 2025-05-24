<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Pour l'instant, on retourne simplement la vue
        // Plus tard, nous ajouterons les données nécessaires
        return view('user.index');
    }
    //
}
