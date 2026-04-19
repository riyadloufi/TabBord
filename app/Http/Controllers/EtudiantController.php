<?php
namespace App\Http\Controllers;

use App\Models\Etudiant;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index()
    {
        return Etudiant::with('filiere')->get();
    }

    public function store(Request $request)
    {
        return Etudiant::create($request->all());
    }

    public function show($id)
    {
        return Etudiant::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $e = Etudiant::findOrFail($id);
        $e->update($request->all());
        return $e;
    }

    public function destroy($id)
    {
        Etudiant::destroy($id);
        return response()->json(['ok']);
    }
}
