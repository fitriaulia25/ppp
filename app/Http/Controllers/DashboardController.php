<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda;
use App\Models\Atensi;

class DashboardController extends Controller
{
    public function index()
    {
        $latestAgendas = Agenda::orderBy('tanggal', 'desc')->take(5)->get(); // Call the method to get the latest agendas
        $latestAtensis = Atensi::orderBy('tanggal_waktu', 'desc')->take(5)->get();
        return view('index', compact('latestAgendas', 'latestAtensis'));
        
    }
    // In your DashboardController or wherever you render the dashboard
public function dashboard()
{
    
    
}
}


