<?php
namespace App\Http\Controllers;

use App\Models\{Etudiant, Filiere, AnneeScolaire};
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $query = Etudiant::with(['inscriptions.filiere', 'inscriptions.anneeScolaire']);

        if ($request->filled('statut'))    $query->where('statut', $request->statut);
        if ($request->filled('type_acces'))$query->where('type_acces', $request->type_acces);
        if ($request->filled('search'))    $query->where(fn($q) =>
            $q->where('nom', 'like', "%{$request->search}%")
              ->orWhere('prenom', 'like', "%{$request->search}%")
              ->orWhere('CNE', 'like', "%{$request->search}%")
        );

        $etudiants = $query->orderBy('nom')->paginate(25)->withQueryString();

        return view('etudiants.index', compact('etudiants'));
    }

    public function show(Etudiant $etudiant)
    {
        $etudiant->load(['inscriptions.filiere', 'inscriptions.anneeScolaire',
                         'validations.module', 'validations.anneeScolaire', 'abandons']);
        return view('etudiants.show', compact('etudiant'));
    }

    // Stats : inscrits à cheval (ex: S1 et S3 en même année)
    public function achevale(Request $request)
    {
        $anneeId = $request->get('annee_id', AnneeScolaire::encours()?->id);

        $achevalePairs = [
            [1, 3], [3, 5], [2, 4], [4, 6]
        ];

        $results = [];
        foreach ($achevalePairs as [$s1, $s2]) {
            $ids1 = Inscription::where('annee_id', $anneeId)->where('semestre', $s1)->pluck('etudiant_id');
            $ids2 = Inscription::where('annee_id', $anneeId)->where('semestre', $s2)->pluck('etudiant_id');
            $communs = $ids1->intersect($ids2);

            $results[] = [
                'label' => "S{$s1} & S{$s2}",
                'count' => $communs->count(),
                'etudiants' => Etudiant::whereIn('id', $communs)->get(),
            ];
        }

        $annees = AnneeScolaire::orderByDesc('libelle')->get();
        return view('etudiants.achevale', compact('results', 'annees', 'anneeId'));
    }
}
