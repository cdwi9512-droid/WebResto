<?php

namespace App\Http\Controllers;

use App\Models\Menu; // WAJIB ADA INI, PEMANGGIL DATA

class MenuController extends Controller
{
    public function index()
    {
        // KIRIM DATA $menu KE VIEW
        $menu = Menu::all(); 
        return view('menu.index', compact('menu'));
    }
}