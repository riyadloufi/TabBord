<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    protected $fillable = ['etudiant_id', 'filiere_id', 'annee_id', 'semestre', 'type', 'date_inscription'];

    public function etudiant()      { return $this->belongsTo(Etudiant::class); }
    public function filiere()       { return $this->belongsTo(Filiere::class); }
    public function anneeScolaire() { return $this->belongsTo(AnneeScolaire::class, 'annee_id'); }

    // Scope : inscrits à cheval (sur 2 semestres non consécutifs)
    public function scopeAchevale($q) { return $q->where('type', 'achevale'); }
}
