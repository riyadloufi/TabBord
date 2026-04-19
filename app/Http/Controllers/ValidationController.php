<?php
namespace App\Http\Controllers;

use App\Models\Validation;
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index()
    {
        return Validation::with(['etudiant','module'])->get();
    }

    public function store(Request $request)
    {
        return Validation::create($request->all());
    }
}
