<?php
namespace App\Http\Controllers;

use App\Models\{Validation, Filiere, Module, AnneeScolaire};
use Illuminate\Http\Request;

class ValidationController extends Controller
{
    public function index(Request $request)
    {
        $anneeId   = $request->get('annee_id', AnneeScolaire::encours()?->id);
        $filiereId = $request->get('filiere_id');
        $semestre  = $request->get('semestre');
        $moduleId  = $request->get('module_id');

        $query = Validation::with(['etudiant', 'module.filiere', 'anneeScolaire'])
            ->when($anneeId,   fn($q) => $q->where('annee_id', $anneeId))
            ->when($moduleId,  fn($q) => $q->where('module_id', $moduleId))
            ->when($filiereId || $semestre, fn($q) => $q->whereHas('module', fn($q) =>
                $q->when($filiereId, fn($q) => $q->where('filiere_id', $filiereId))
                  ->when($semestre,  fn($q) => $q->where('semestre', $semestre))
            ));

        // Stats agrégées
        $stats = (clone $query)->selectRaw('statut, COUNT(*) as total')
                               ->groupBy('statut')
                               ->pluck('total', 'statut');

        $validations = $query->paginate(30)->withQueryString();

        $filieres = Filiere::where('actif', true)->get();
        $modules  = Module::when($filiereId, fn($q) => $q->where('filiere_id', $filiereId))->get();
        $annees   = AnneeScolaire::orderByDesc('libelle')->get();

        return view('validations.index', compact(
            'validations', 'stats', 'filieres', 'modules',
            'annees', 'anneeId', 'filiereId', 'semestre', 'moduleId'
        ));
    }
}
