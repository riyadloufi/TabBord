<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Inscription, Validation, Etudiant, AnneeScolaire};
use Barryvdh\DomPDF\Facade\Pdf;

class ExportController extends Controller
{
    public function pdfInscriptions(Request $request)
    {
        $anneeId  = $request->get('annee_id', AnneeScolaire::encours()?->id);
        $annee    = AnneeScolaire::find($anneeId);

        $data = Inscription::where('annee_id', $anneeId)
            ->with(['etudiant', 'filiere'])
            ->get()
            ->groupBy('filiere_id');

        $pdf = Pdf::loadView('exports.inscriptions-pdf', compact('data', 'annee'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download("inscriptions-{$annee->libelle}.pdf");
    }

    public function pdfValidations(Request $request)
    {
        $anneeId = $request->get('annee_id', AnneeScolaire::encours()?->id);
        $annee   = AnneeScolaire::find($anneeId);

        $data = Validation::where('annee_id', $anneeId)
            ->with(['etudiant', 'module.filiere'])
            ->get();

        $stats = [
            'valide'     => $data->where('statut', 'valide')->count(),
            'rattrapage' => $data->where('statut', 'rattrapage')->count(),
            'non_valide' => $data->where('statut', 'non_valide')->count(),
        ];

        $pdf = Pdf::loadView('exports.validations-pdf', compact('data', 'stats', 'annee'))
                  ->setPaper('a4', 'landscape');

        return $pdf->download("validations-{$annee->libelle}.pdf");
    }
}
