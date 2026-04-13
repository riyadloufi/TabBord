<?php
namespace App\Http\Controllers;

use App\Models\{NoteInterne, User};
use Illuminate\Http\Request;

class NoteInterneController extends Controller
{
    public function index()
    {
        $notes = NoteInterne::where('destinataire_id', auth()->id())
                             ->with('expediteur')
                             ->latest()
                             ->get();

        // Marquer toutes comme lues
        NoteInterne::where('destinataire_id', auth()->id())
                   ->where('lu', false)
                   ->update(['lu' => true]);

        return view('notes.index', compact('notes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destinataire_id' => 'required|exists:users,id',
            'contenu'         => 'required|string|min:5',
        ]);

        NoteInterne::create([
            'expediteur_id'   => auth()->id(),
            'destinataire_id' => $request->destinataire_id,
            'contenu'         => $request->contenu,
        ]);

        return back()->with('success', 'Note envoyée avec succès.');
    }
}
