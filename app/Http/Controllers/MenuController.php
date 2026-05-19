<?php
namespace App\Http\Controllers;
use App\Models\Menu;

class MenuController extends Controller
{
    public function index()
    {
        // Ambil data menu beserta data restorannya
        $menu = Menu::with('resto')->get(); 
        return view('menu.index', compact('menu'));
    }
}