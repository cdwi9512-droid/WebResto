<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 

class GaleryController extends Controller
{
    public function index()
    {
       
        $photos = [
            "https://i.pinimg.com/1200x/63/21/d0/6321d0df5fb73c71102ec4851af29b4f.jpg",
            "https://i.pinimg.com/736x/f6/5a/a8/f65aa8190ace17bf2292c96efc659fb2.jpg",
            "https://i.pinimg.com/736x/7c/18/a8/7c18a834b82addb7989d6b4837bdd69f.jpg",
            "https://i.pinimg.com/736x/bd/b1/a5/bdb1a5662d60728d2c93d5adbf232446.jpg",
            "https://i.pinimg.com/1200x/db/97/6a/db976ac343259a1beb87c25ecc118e69.jpg",
            "https://i.pinimg.com/736x/08/c7/0d/08c70d473888e35bd1c4cd9d1d2983d7.jpg",
        ];

    
        return view('galery.index', compact('photos'));
    }
}