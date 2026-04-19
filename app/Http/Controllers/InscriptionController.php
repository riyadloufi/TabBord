<?php
namespace App\Http\Controllers;

use App\Models\Inscription;
use Illuminate\Http\Request;



class InscriptionController extends Controller
{
    public function index()
    {
        return Inscription::with('etudiant')->get();
    }

    public function store(Request $request)
    {
        return Inscription::create($request->all());
    }
}
