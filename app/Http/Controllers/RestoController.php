<?php
namespace App\Http\Controllers;
use App\Models\Resto;
use Illuminate\Http\Request;

class RestoController extends Controller
{
    public function index()
    {
        // Biasanya cuma ada 1 data resto, tapi pakai all() aman saja
        $resto = Resto::first(); 
        return view('resto.index', compact('resto'));
    }
}