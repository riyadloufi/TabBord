<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Abandon extends Model
{
    protected $fillable = ['etudiant_id', 'filiere_id', 'annee_id', 'semestre', 'motif', 'date_retrait'];

    public function etudiant()      { return $this->belongsTo(Etudiant::class); }
    public function filiere()       { return $this->belongsTo(Filiere::class); }
    public function anneeScolaire() { return $this->belongsTo(AnneeScolaire::class, 'annee_id'); }
}
