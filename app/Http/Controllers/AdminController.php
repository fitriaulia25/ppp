<?php

namespace App\Http\Controllers;

use App\Models\Atensi;
use App\Models\User;
use App\Models\Agenda; // Assuming Agenda is your model
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Retrieve all agendas from the database
        $agendas = Agenda::all();

        $agendaCount = Agenda::count(); // Menghitung jumlah agenda 
        $atensiCount = Atensi::count(); // Menghitung jumlah atensi 
        $userCount = User::count(); // Menghitung jumlah pengguna

        return view('admin.dashboard', compact('agendaCount', 'atensiCount', 'userCount'));
        // Pass the agendas to the view
        return view('admin.dashboard', compact('agendas'));
    }
}
?>