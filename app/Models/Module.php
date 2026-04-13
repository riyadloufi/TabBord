<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['filiere_id', 'code', 'intitule', 'semestre', 'credits', 'coefficient', 'actif'];
    protected $casts = ['actif' => 'boolean'];

    public function filiere()      { return $this->belongsTo(Filiere::class); }
    public function validations()  { return $this->hasMany(Validation::class); }
    public function enseignants()  { return $this->belongsToMany(Enseignant::class, 'enseignant_module')
                                            ->withPivot('annee_id')->withTimestamps(); }
}
