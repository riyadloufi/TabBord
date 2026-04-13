<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    protected $fillable = ['CNE', 'nom', 'prenom', 'sexe', 'date_naissance',
                           'type_acces', 'semestre_entree', 'statut', 'nationalite'];

    public function inscriptions() { return $this->hasMany(Inscription::class); }
    public function validations()  { return $this->hasMany(Validation::class); }
    public function abandons()     { return $this->hasMany(Abandon::class); }

    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }

    // Scopes utiles pour les stats
    public function scopeActifs($q)      { return $q->where('statut', 'actif'); }
    public function scopeDiplomes($q)    { return $q->where('statut', 'diplome'); }
    public function scopePasserelle($q)  { return $q->where('type_acces', 'passerelle'); }
    public function scopeNouveaux($q)    { return $q->where('semestre_entree', 1)->where('type_acces', 'normal'); }
}
