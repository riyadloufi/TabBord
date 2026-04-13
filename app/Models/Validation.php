<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    protected $fillable = ['etudiant_id', 'module_id', 'annee_id',
                           'note_normale', 'note_rattrapage', 'statut'];

    public function etudiant()      { return $this->belongsTo(Etudiant::class); }
    public function module()        { return $this->belongsTo(Module::class); }
    public function anneeScolaire() { return $this->belongsTo(AnneeScolaire::class, 'annee_id'); }

    // Scopes stats
    public function scopeValides($q)    { return $q->where('statut', 'valide'); }
    public function scopeRattrapage($q) { return $q->where('statut', 'rattrapage'); }
    public function scopeNonValides($q) { return $q->where('statut', 'non_valide'); }
}
