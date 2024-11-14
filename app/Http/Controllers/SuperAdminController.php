<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Atensi;
use App\Models\User;
use Illuminate\Http\Request;

class SuperAdminController extends Controller
{
    public function index()
    {
        $agendas = Agenda::all(); // Make sure you fetch your agendas
        $atensi = Atensi::all(); // Fetch attentions if needed
        $users = User::paginate(10); // Fetch users if needed
    
        return view('super_admin.dashboard', compact('agendas', 'atensi', 'users'));
    }
    
}
