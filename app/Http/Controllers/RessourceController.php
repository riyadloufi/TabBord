<?php
namespace App\Http\Controllers;

use App\Models\Ressource;
use Illuminate\Http\Request;

class RessourceController extends Controller
{
    public function index()
    {
        return Ressource::all();
    }

    public function store(Request $request)
    {
        return Ressource::create($request->all());
    }
}
