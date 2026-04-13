<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Etudiant, Inscription, Validation, Abandon, Filiere, Module, Enseignant, Local, AnneeScolaire};

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $anneeId = $request->get('annee_id', AnneeScolaire::encours()?->id);
        $filiereId = $request->get('filiere_id');
        $semestre = $request->get('semestre');

        $annees = AnneeScolaire::orderByDesc('libelle')->get();
        $filieres = Filiere::where('actif', true)->get();

        // ── KPIs globaux ──────────────────────────────────────────────────
        $totalInscrits = Inscription::when($anneeId, fn($q) => $q->where('annee_id', $anneeId))
            ->when($filiereId, fn($q) => $q->where('filiere_id', $filiereId))
            ->when($semestre, fn($q) => $q->where('semestre', $semestre))
            ->distinct('etudiant_id')->count();

        $nouveauxS1 = Etudiant::where('type_acces', 'normal')->where('semestre_entree', 1)
            ->whereHas('inscriptions', fn($q) => $q->when($anneeId, fn($q) => $q->where('annee_id', $anneeId)))
            ->count();

        $passerelleS5 = Etudiant::where('type_acces', 'passerelle')
            ->whereHas('inscriptions', fn($q) => $q->when($anneeId, fn($q) => $q->where('annee_id', $anneeId)))
            ->count();

        $abandons = Abandon::when($anneeId, fn($q) => $q->where('annee_id', $anneeId))
            ->when($filiereId, fn($q) => $q->where('filiere_id', $filiereId))
            ->count();

        $diplomes = Etudiant::where('statut', 'diplome')
            ->when($filiereId, fn($q) => $q->whereHas('inscriptions', fn($q) => $q->where('filiere_id', $filiereId)))
            ->count();

        $validations = Validation::when($anneeId, fn($q) => $q->where('annee_id', $anneeId))
            ->when($semestre, fn($q) => $q->whereHas('module', fn($q) => $q->where('semestre', $semestre)))
            ->selectRaw("statut, COUNT(*) as total")
            ->groupBy('statut')
            ->pluck('total', 'statut');

        // ── Graphique : inscrits par filière ──────────────────────────────
        $inscritsByFiliere = Inscription::when($anneeId, fn($q) => $q->where('annee_id', $anneeId))
            ->selectRaw('filiere_id, COUNT(DISTINCT etudiant_id) as total')
            ->groupBy('filiere_id')
            ->with('filiere:id,code')
            ->get()
            ->map(fn($i) => ['label' => $i->filiere->code ?? '?', 'value' => $i->total]);

        // ── Graphique : évolution inscriptions par année ──────────────────
        $evolutionAnnuelle = Inscription::selectRaw('annee_id, COUNT(DISTINCT etudiant_id) as total')
            ->groupBy('annee_id')
            ->with('anneeScolaire:id,libelle')
            ->get()
            ->map(fn($i) => ['label' => $i->anneeScolaire->libelle ?? '?', 'value' => $i->total]);

        // ── Infos ressources ──────────────────────────────────────────────
        $nbLocaux = Local::count();
        $nbOrdinateurs = Local::sum('nbr_ordinateurs');
        $nbEnseignants = Enseignant::where('actif', true)->count();
        $nbFilieres = Filiere::where('actif', true)->count();
        $nbModules = Module::where('actif', true)->count();

        return view('dashboard.index', compact(
            'annees',
            'filieres',
            'anneeId',
            'filiereId',
            'semestre',
            'totalInscrits',
            'nouveauxS1',
            'passerelleS5',
            'abandons',
            'diplomes',
            'validations',
            'inscritsByFiliere',
            'evolutionAnnuelle',
            'nbLocaux',
            'nbOrdinateurs',
            'nbEnseignants',
            'nbFilieres',
            'nbModules'
        ));
    }
}
