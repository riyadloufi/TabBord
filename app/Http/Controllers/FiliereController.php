<?php
namespace App\Http\Controllers;

use App\Models\Filiere;
use Illuminate\Http\Request;

class FiliereController extends Controller
{
    public function index()
    {
        return Filiere::all();
    }

    public function store(Request $request)
    {
        return Filiere::create($request->all());
    }
}
