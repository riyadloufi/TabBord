<?php
namespace App\Http\Controllers;

use App\Models\Enseignant;
use Illuminate\Http\Request;

class EnseignantController extends Controller
{
    public function index()
    {
        return Enseignant::with('modules')->get();
    }

    public function store(Request $request)
    {
        return Enseignant::create($request->all());
    }
}
