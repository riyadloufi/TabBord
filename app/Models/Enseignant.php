<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enseignant extends Model
{
    protected $fillable = ['nom', 'prenom', 'grade', 'specialite', 'annee_recrutement', 'service', 'filiere_id', 'actif'];
    protected $casts = ['actif' => 'boolean'];

    public function filiere()  { return $this->belongsTo(Filiere::class); }
    public function user()     { return $this->hasOne(User::class); }
    public function modules()  { return $this->belongsToMany(Module::class, 'enseignant_module')
                                        ->withPivot('annee_id')->withTimestamps(); }

    public function getFullNameAttribute(): string
    {
        return "{$this->prenom} {$this->nom}";
    }
}
